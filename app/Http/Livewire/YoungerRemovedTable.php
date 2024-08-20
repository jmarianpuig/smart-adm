<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Xtra;
use App\Models\Actor;
use App\Models\PantSize;
use App\Models\ShirtSize;
use App\Models\ShoeSize;
use App\Models\Race;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use LowerRockLabs\LaravelLivewireTablesAdvancedFilters\NumberRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class YoungerRemovedTable extends DataTableComponent
{
    protected $model;

    // lo que le paso en el componente
    public string $type;

    // medio segundo de retraso a la sbusquedas pra bajar el numero de peticiones
    public ?int $searchFilterDebounce = 500;

    // cambio la paginación
    // public int $perPage = 25;
    public array $perPageAccepted = [10, 25];

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function builder(): Builder
    {
        if ($this->type === 'Xtra') {
            $this->model = Xtra::query()->with(
                'availability',
                'eye_color',
                'hair_color',
                'imageables',
                'municipio.provincia',
                'pant_size',
                'race',
                'shirt_size',
                'shoe_size',
                'study',
                'user',
                'user.parents'
            )
                ->where('removed', 1)
                ->where(function (Builder $query) {
                    // Calculo la fecha mínima para tener al menos 16 años
                    $fechaMinima = now()->subYears(16)->format('Y-m-d');
                    $query->where('birthdate', '>', $fechaMinima);
                });

            return $this->model;
        } elseif ($this->type === 'Actor') {
            $this->model = Actor::query()->with(
                'availability',
                'eye_color',
                'hair_color',
                'imageables',
                'municipio.provincia',
                'pant_size',
                'race',
                'shirt_size',
                'shoe_size',
                'study',
                'user',
                'user.parents'
            )
                ->where('removed', 1)
                ->where(function (Builder $query) {
                    $fechaMinima = now()->subYears(16)->format('Y-m-d');
                    $query->where('birthdate', '>', $fechaMinima);
                });
            return $this->model;
        } else {
            abort(403);
        }
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayout('slide-down')
            ->setDefaultSort('full_name', 'asc')
            ->setSingleSortingStatus(false)
            ->setEagerLoadAllRelationsEnabled(true)
            ->setEagerLoadAllRelationsStatus(true)
            ->setColumnSelectStatus(false)
            ->setEmptyMessage('Sin datos');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable()
                ->deselected()
                ->hideIf(true),
            Column::make('Book', 'url_book')
                ->format(function ($value, $row, Column $column) {
                    if ($value && mb_strlen($value) >= 10) {
                        return '<a target="_blank" href="' . $value . '" class="rounded-full w-8 h-8 flex items-center justify-center bg-red-600"><i class="text-white fas fa-lg fa-book"></i></a>';
                    }
                })
                ->html()
                ->sortable()
                ->collapseOnTablet(),
            Column::make('Nombre', 'name')
                ->format(
                    fn ($value, $row, Column $column) => view('components.name-table-menor', ['data' => $row])
                )
                ->sortable()
                ->searchable(),
            Column::make('Nombre Completo', 'full_name')
                ->searchable()
                ->hideIf(true),
            Column::make('apellido1', 'first_lname')
                ->searchable()
                ->hideIf(true),
            Column::make('apellido2', 'second_lname')
                ->searchable()
                ->hideIf(true),
            Column::make('slug', 'slug')
                ->searchable()
                ->hideIf(true),
            Column::make('Género', 'gender')
                ->sortable()
                ->searchable()
                ->deselected()
                ->collapseOnTablet(),
            Column::make('Tel.', 'phone')
                ->searchable()
                ->hideIf(true),
            Column::make('Email', 'user.email')
                ->searchable()
                ->hideIf(true),
            Column::make('Tel. Padres', 'user.parents.phone')
                ->searchable()
                ->hideIf(true),
            Column::make('Email Padres', 'user.parents.email')
                ->searchable()
                ->hideIf(true),
            Column::make('Municipio', 'municipio.municipio')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Provincia', 'municipio.provincia.provincia')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Edad', 'birthdate')
                ->format(function ($value, $row, Column $column) {
                    return Carbon::parse($row->birthdate)->age;
                })
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Alt', 'height')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Tatuajes', 'has_tattoos')
                ->format(function ($value, $row, Column $column) {
                    return $value == '1' ? 'Si' : 'No';
                })
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Cam', 'shirt_size.size')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Pant', 'pant_size.size')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Zap', 'shoe_size.size')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Imágenes', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('livewire.photo-modal', ['data' => $row->imageables])
                )
                ->collapseOnTablet(),
            Column::make('Acciones', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('components.action-younger-table', ['data' => $row])
                )
                ->collapseOnTablet(),
            ImageColumn::make('Avatar', 'imageables')
                ->location(
                    fn ($row) => ('https://smartfiguracion.es/public/images/extras/avatars/' . $row->imageables[0]->url)
                )
                ->attributes(fn ($row) => [
                    'class' => 'rounded-full w-8',
                    'alt' => $row->imageables[0]->url . ' Avatar',
                ])
                ->deselected()
                ->hideIf(true),
            Column::make('DNI/NIE', 'dni')
                ->sortable()
                ->searchable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
            Column::make('Nº Seg.Soc.', 'ss')
                ->sortable()
                ->searchable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
            Column::make('Pelos', 'hair_color.color')
                ->sortable()
                ->searchable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
            Column::make('Ojos', 'eye_color.color')
                ->sortable()
                ->searchable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
            Column::make('Raza', 'race.race')
                ->sortable()
                ->searchable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
            Column::make('Estudios', 'study.study')
                ->sortable()
                ->searchable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
            Column::make('Disp', 'availability.availability')
                ->sortable()
                ->searchable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
            BooleanColumn::make('Discap.', 'is_disabled')
                ->sortable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
            BooleanColumn::make('eliminado', 'removed')
                ->sortable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
        ];
    }

    public function filters(): array
    {
        $filters = [
            NumberRangeFilter::make('Edad (0-16 años)', 'age')
                ->config(
                    [
                        'minRange' => 0,
                        'maxRange' => 16
                    ]
                )
                ->filter(function (Builder $builder, array $numberRange) {
                    $builder->orderBy('birthdate', 'desc');
                    $builder->whereRaw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) >= ?', [$numberRange['min']])
                        ->whereRaw('TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) <= ?', [$numberRange['max']]);
                }),

            TextFilter::make('Provincia')
                ->config([
                    'placeholder' => 'Provincia',
                    'maxlength' => '25',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('provincias.provincia', 'like', '%' . $value . '%');
                }),

            TextFilter::make('Municipio')
                ->config([
                    'placeholder' => 'Municipio',
                    'maxlength' => '25',
                ])
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('municipios.municipio', 'like', '%' . $value . '%');
                }),

            SelectFilter::make('Género')
                ->options([
                    '' => 'Todos',
                    'Hombre' => 'Hombre',
                    'Mujer' => 'Mujer',
                    'No Binario' => 'No Binario',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === 'Hombre') {
                        $builder->where('gender', $value);
                    } elseif ($value === 'Mujer') {
                        $builder->where('gender', $value);
                    } elseif ($value === 'No Binario') {
                        $builder->where('gender', $value);
                    }
                }),

            MultiSelectDropdownFilter::make('Tallas Camisa')
                ->options(
                    ShirtSize::query()
                        ->orderBy('id')
                        ->pluck('size', 'id')
                        ->toArray()
                )
                ->setFirstOption('Todas')
                ->filter(function (Builder $builder, array $selectedSizes) {
                    // Ordeno la consulta por 'shirt_sizes.id' de menor a mayor
                    $builder->orderBy('shirt_sizes.id', 'asc');
                    // Obtengo el valor seleccionado del filtro
                    $builder->where(function ($query) use ($selectedSizes) {
                        foreach ($selectedSizes as $selectedSize) {
                            $query->orWhere('shirt_sizes.id', '=', $selectedSize);
                        }
                    });
                }),

            MultiSelectDropdownFilter::make('Tallas Pantalón')
                ->options(
                    PantSize::query()
                        ->orderBy('id')
                        ->pluck('size', 'id')
                        ->toArray()
                )
                ->setFirstOption('Todas')
                ->filter(function (Builder $builder, array $selectedSizes) {
                    // Ordeno la consulta por 'pant_sizes.id' de menor a mayor
                    $builder->orderBy('pant_sizes.id', 'asc');
                    // Obtengo el valor seleccionado del filtro
                    $builder->where(function ($query) use ($selectedSizes) {
                        foreach ($selectedSizes as $selectedSize) {
                            $query->orWhere('pant_sizes.id', '=', $selectedSize);
                        }
                    });
                }),

            MultiSelectDropdownFilter::make('Tallas Zapatos')
                ->options(
                    ShoeSize::query()
                        ->orderBy('id')
                        ->pluck('size', 'id')
                        ->toArray()
                )
                ->setFirstOption('Todas')
                ->filter(function (Builder $builder, array $selectedSizes) {
                    // Ordeno la consulta por 'shoe_sizes.id' de menor a mayor
                    $builder->orderBy('shoe_sizes.id', 'asc');
                    // Obtengo el valor seleccionado del filtro
                    $builder->where(function ($query) use ($selectedSizes) {
                        foreach ($selectedSizes as $selectedSize) {
                            $query->orWhere('shoe_sizes.id', '=', $selectedSize);
                        }
                    });
                }),

            NumberRangeFilter::make('Altura', 'height')
                ->config([
                    'minRange' => '50',
                    'maxRange' => '220',
                ])
                ->filter(function (Builder $builder, array $numberRange) {
                    $builder->orderBy('height', 'asc');
                    $builder->where('height', '>=', [$numberRange['min']])
                        ->where('height', '<=', [$numberRange['max']]);
                }),

            SelectFilter::make('¿Tiene Book?')
                ->options([
                    '' => 'Todos',
                    '1' => 'Sí',
                    '0' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        // Filtar registros con url_book no nulo y con al menos 10 caracteres.
                        $builder->whereNotNull('url_book')
                            ->whereRaw('CHAR_LENGTH(url_book) >= 10');
                    } elseif ($value === '0') {
                        // Filtrar registros con url_book nulo o con menos de 10 caracteres.
                        $builder->where(function ($query) {
                            $query->whereNull('url_book')
                                ->orWhereRaw('CHAR_LENGTH(url_book) < 10');
                        });
                    }
                }),

            SelectFilter::make('Raza')
            ->options(
                Race::query()
                    ->orderBy('id')
                    ->pluck('race', 'id')
                    ->toArray()
            )
            ->filter(function (Builder $builder, string $value) {
                // dd($value);
                    $builder->where('race_id', $value);
                
            }),
        ];

        if ($this->type === 'Actor') {

            $actorFilter = SelectFilter::make('¿Hace Figuración?')
                ->options([
                    '' => 'Todos',
                    '1' => 'Sí',
                    '0' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('is_extra', true);
                    } elseif ($value === '0') {
                        $builder->where('is_extra', false);
                    }
                });

            array_push($filters, $actorFilter);
        }

        return $filters;
    }
}
