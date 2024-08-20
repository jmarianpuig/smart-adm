<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Coordinator;
use App\Models\MoveToWork;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use LowerRockLabs\LaravelLivewireTablesAdvancedFilters\NumberRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class CoordinatorRemovedTable extends DataTableComponent
{
    protected $model;

    // medio segundo de retraso a la sbusquedas pra bajar el numero de peticiones
    public ?int $searchFilterDebounce = 500;

    // cambio la paginación
    public array $perPageAccepted = [10, 25];

    public function builder(): Builder
    {
        $this->model = Coordinator::query()->where('removed', 1);
        return $this->model;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayout('slide-down')
            ->setDefaultSort('id', 'desc')
            ->setSingleSortingStatus(false)
            ->setEagerLoadAllRelationsEnabled(true)
            ->setEagerLoadAllRelationsStatus(true)
            ->setColumnSelectStatus(false);
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable()
                ->deselected()
                ->hideIf(true),
            Column::make('Nombre', 'name')
                ->format(
                    fn ($value, $row, Column $column) => view('components.name-table', ['data' => $row])
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
            Column::make('Edad', 'birthdate')
                ->format(function ($value, $row, Column $column) {
                    return Carbon::parse($row->birthdate)->age;
                })
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Teléfono', 'phone')
                ->searchable()
                ->hideIf(true),
            Column::make('Email', 'user.email')
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
            BooleanColumn::make('Coche', 'has_car')
                ->sortable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
            BooleanColumn::make('removed', 'removed')
                ->sortable()
                ->collapseOnTablet()
                ->deselected()
                ->hideIf(true),
            Column::make('Disponibilidad', 'move_to_work.distance')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
            Column::make('Experiencia', 'experience')
                ->format(function ($value, $row, Column $column) {
                    return $value == '1' ? 'Si' : 'No';
                })
                ->sortable()
                ->collapseOnTablet()
                ->deselected(),
            Column::make('Img', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('livewire.photo-modal', ['data' => $row->imageables])
                )
                ->collapseOnTablet(),
            Column::make('Docs', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('components.action-docs-table', ['data' => $row->fileables])
                )
                ->collapseOnTablet(),
            Column::make('Acciones', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('components.action-table', ['data' => $row])
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
        ];
    }
    
    public function filters(): array
    {
        $filters = [
            NumberRangeFilter::make('Edad (0-100 años)', 'age')
                ->config(
                    [
                        'minRange' => 0,
                        'maxRange' => 100
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



            MultiSelectDropdownFilter::make('Disponibilidad')
                ->options(
                    MoveToWork::query()
                        ->orderBy('id')
                        ->pluck('distance', 'id')
                        ->toArray()
                )
                ->setFirstOption('Todas')
                ->filter(function (Builder $builder, array $selectedSizes) {
                    // Ordeno la consulta por 'shoe_sizes.id' de menor a mayor
                    $builder->orderBy('move_to_works.id', 'asc');
                    // Obtengo el valor seleccionado del filtro
                    $builder->where(function ($query) use ($selectedSizes) {
                        foreach ($selectedSizes as $selectedSize) {
                            $query->orWhere('move_to_works.id', '=', $selectedSize);
                        }
                    });
                }),

            SelectFilter::make('¿Experiencia?')
                ->options([
                    '' => 'Todos',
                    '1' => 'Sí',
                    '0' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('experience', true);
                    } elseif ($value === '0') {
                        $builder->where('experience', false);
                    }
                }),

            SelectFilter::make('Tiene Coche?')
                ->options([
                    '' => 'Todos',
                    '1' => 'Sí',
                    '0' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('has_car', true);
                    } elseif ($value === '0') {
                        $builder->where('has_car', false);
                    }
                }),
        ];

        return $filters;
    }
}
