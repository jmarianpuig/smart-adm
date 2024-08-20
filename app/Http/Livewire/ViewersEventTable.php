<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Provincia;
use App\Models\Viewer;
use Illuminate\Database\Eloquent\Builder;
use LowerRockLabs\LaravelLivewireTablesAdvancedFilters\NumberRangeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ViewersEventTable extends DataTableComponent
{
    public $data;

    protected $model;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function builder(): Builder
    {
        $this->model = Viewer::query()
        ->whereHas('events', function ($query) {
            $query->where('events.id', $this->data);
        });

        return $this->model;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayout('slide-down')
            ->setEmptyMessage('No hay participantes para este evento');
    }

    public function columns(): array
    {
        return [
            Column::make('Seleccionados', 'id')
                ->format(function ($value, $row, Column $column) {
                    $event = $row->events->first();
                    // Generar el HTML del botón en lugar de incluir el componente hijo
                    $isSelected = $event->pivot->is_selected;
                    $buttonHtml = '<div class="flex items-center">';
                    $buttonHtml .= '<button wire:click="update(' . $event->id . ',' . $row->id . ',' . $isSelected . ')" class="rounded-full w-8 h-8 flex items-center justify-center ' . ($isSelected ? 'bg-green-600' : 'bg-red-600') . '">';
                    $buttonHtml .= '<i class="text-white ' . ($isSelected ? 'fas fa-lg fa-minus' : 'fas fa-lg fa-plus') . '"></i>';
                    $buttonHtml .= '</button>';
                    $buttonHtml .= '<span class="ml-2 ' . ($isSelected ? 'text-green-600' : 'text-red-600') . '">' . ($isSelected ? 'Quitar' : 'Añadir') . '</span>';
                    $buttonHtml .= '</div>';

                    return $buttonHtml;
                })
                ->html(),
            Column::make('Nombre', 'name')
                ->format(
                    fn ($value, $row, Column $column) => view('components.name-viewer-table', ['data' => $row])
                )
                ->sortable()
                ->searchable(),
            Column::make("Género", "gender")
                ->sortable(),
            Column::make("Localidad", "provincia_id")
                ->format(
                    function ($value, $row, Column $column) {
                        return Provincia::where('id', $value)->value('provincia');
                    }
                )
                ->sortable(),
            Column::make("Email", "email")
                ->sortable()
                ->hideIf(true),
            Column::make("teléfono", "phone")
                ->sortable()
                ->hideIf(true),
            Column::make("Edad", "age")
                ->sortable(),
            Column::make("Foto", "image")
                ->format(
                    fn ($value, $row, Column $column) => view('components.image-button-viewer', ['data' => $row])
                )
                ->collapseOnTablet(),
        ];
    }


    public function filters(): array
    {
        return [
            SelectFilter::make('Espectadores', 'is_selected')
                ->options([
                    '' => 'Todos los espectadores',
                    '0' => 'No Selecciónados',
                    '1' => 'Seleccionados'
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value != '') {
                        $builder->whereHas('events', function (Builder $query) use ($value) {
                            $query->where('is_selected', $value);
                        });
                    }
                }),

            NumberRangeFilter::make('Edad (1-100 años)', 'age')
                ->options(
                    [
                        'min' => 1,
                        'max' => 100
                    ]
                )
                ->filter(function (Builder $builder, array $numberRange) {
                    $builder->orderBy('age', 'desc');
                    // dd($numberRange);
                    $builder->where('age', '>=', [$numberRange['min']])
                        ->where('age', '<=', [$numberRange['max']]);
                }),

            SelectFilter::make('Provincia', 'provincia_id')
                ->options(
                    ['' => 'Todas las Provincias'] + Provincia::query()
                        ->orderBy('provincia', 'asc')
                        ->pluck('provincia', 'id')
                        ->toArray()
                )
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('provincia_id', $value);
                }),
        ];
    }

    public function update($eventId, $viewerId, $isSelected)
    {
        // Realizar la actualización en el componente padre
        $viewer = Viewer::find($viewerId);

        // Buscar la fila correspondiente en la tabla pivot event_viewer
        $eventViewer = $viewer->events()
            ->where('event_id', $eventId)
            ->first();

        if ($eventViewer) {
            // Cambiar el valor de is_selected en función de $isSelected
            $eventViewer->pivot->is_selected = !$isSelected;
            $eventViewer->pivot->save();
        }

        // Emitir un evento para notificar a otros componentes de la actualización
        $this->emit('viewerUpdated', $eventId, $viewerId, $isSelected);
    }

    public function handleViewerUpdated($eventId, $viewerId, $isSelected)
    {
        toastr()->success('¡Participante modificado!', 'Éxito');
    }
}
