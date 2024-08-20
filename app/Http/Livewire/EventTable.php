<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Event;
use App\Models\Provincia;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class EventTable extends DataTableComponent
{
    protected $model;

    protected $listeners = [
        'eventRestored' => 'handleEventRestored',
        'eventForceDeleted' => 'handleEventForceDeleted'
    ];

    public function builder(): Builder
    {
        $this->model = Event::query()->with('user')->where('removed', 0);
        return $this->model;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayout('slide-down')
            ->setEmptyMessage('No hay eventos para mostrar');
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable()
                ->sortable()
                ->collapseOnTablet()
                ->hideIf(true),
            Column::make("Evento", "name")
                ->searchable()
                ->sortable(),
            Column::make("Lugar", "place")
                ->searchable()
                ->sortable()
                ->collapseOnTablet(),
            Column::make("Fecha Evento", "event_date")
                ->format(
                    function ($value, $row, Column $column) {
                        return date('d/m/Y H:i', strtotime($value));
                    }
                )
                ->searchable()
                ->sortable()
                ->collapseOnTablet(),
            Column::make("Descripción", "description")
                ->format(function ($value) {
                    if (strlen($value) >= 30) {
                        $shortText = substr($value, 0, 30) . '...';
                        $value = $shortText;
                    }
                    return $value;
                })
                ->searchable()
                ->sortable()
                ->collapseOnTablet(),
            Column::make("Estado", "status")
                ->format(function ($value) {
                    switch ($value) {
                        case 0:
                            return 'En Preparación';
                        case 1:
                            return 'Finalizado';
                        default:
                            return 'Suspendido/Aplazado';
                    }
                })
                ->searchable()
                ->sortable()
                ->collapseOnTablet(),
            Column::make("Creado por", "user_id")
                ->format(
                    fn ($value, $row, Column $column) => $row->user->full_name
                )
                ->searchable()
                ->sortable()
                ->collapseOnTablet(),
            // Column::make('Acciones', 'removed')
            //     ->format(function ($value, $row, Column $column) {
            //         if ($value == '0') {
            //             return view('components.action-event', ['data' => $row]);
            //         } else {
            //             return '<div class="flex space-x-1"><a href="#" class="rounded-full w-8 h-8 bg-blue-600 flex items-center justify-center" wire:click="restoreRecord(' . $row->id . ')"><i class="text-white fas fa-lg fa-refresh"></i></a>' .
            //                 '<a href="#" class="rounded-full w-8 h-8 bg-red-600 flex items-center justify-center" wire:click="forceDeleteRecord(' . $row->id . ')"><i class="text-white fas fa-lg fa-skull-crossbones"></i></a></div>';
            //         }
            //     })
            //     ->html()
            //     ->collapseOnTablet(),
            Column::make('Acciones', 'id')
                ->format(
                    fn ($value, $row, Column $column) => view('components.action-event', ['data' => $row])
                )
                ->collapseOnTablet(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Localidad')
                ->options(
                    ['' => 'Localidades'] + Provincia::query()
                        ->orderBy('provincia', 'asc')
                        ->pluck('provincia', 'provincia')
                        ->toArray()
                )
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('place', $value);
                }),

            TextFilter::make('Nombre')
                ->config([
                    'placeholder' => 'Nombre del evento',
                    'maxlehgth' => '25'
                ])
                ->filter(function ($builder, string $value) {
                    $builder->where('name', 'like', '%' . $value . '%');
                }),

            SelectFilter::make('Estado')
                ->options([
                    '' => 'Todos los estados',
                    '0' => 'En Preparación',
                    '1' => 'Finalizado',
                    '2' => 'Suspendido/Aplazado',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value !== '') {
                        return $builder->where('status', $value);
                    }
                }),

            // SelectFilter::make('Evento creado por')
            //     ->options(
            //         ['' => 'Usuario'] + User::query()
            //             ->select('name', 'first_lname', 'second_lname')
            //             ->orderBy('name', 'asc')
            //             ->get()
            //             ->map(function ($user) {
            //                 return [
            //                     'value' => $user->fullName,
            //                     'label' => $user->fullName,
            //                 ];
            //             })
            //             ->pluck('label', 'value')
            //             ->toArray()
            //     )
            //     ->filter(function (Builder $builder, string $value) {
            //         $builder->where('created_by', $value);
            //     }),

            // SelectFilter::make('Eventos Creados')
            // ->options([
            //     'active' => 'Actuales',
            //     'deleted' => 'Eliminados',
            //     'all' => 'Todos'
            // ])
            // ->filter(function (Builder $builder, $value) {
            //     if ($value == 'active') {
            //         $builder->whereNull('deleted_at');
            //     } elseif ($value == 'deleted') {
            //         $builder->whereNotNull('deleted_at');
            //     }
            // })
            // ->setFilterDefaultValue('active')

        ];
    }

    // solftdelete evento
    public function restoreRecord($id)
    {
        // Restauro el evento borrado
        try {
            $event = Event::withTrashed()->find($id); // Obtengo el evento eliminado
            $event->restore(); // Restauro el evento
            $eventName = $event->name; // Obtngo el nombre del evento

            // Emito un evento para notificar
            $this->emit('eventRestored', $eventName);
        } catch (\Throwable $th) {
            toastr()->error('¡El evento no se pudo recuperar!', 'Error');
        }
    }

    public function handleEventRestored($eventName)
    {
        toastr()->success('¡Evento ' . $eventName . ' restaurado!', 'Éxito');
    }

    // Eliminar evento definitivamente
    public function forceDeleteRecord($id)
    {
        // Elimino definitivamente el evento borrado
        try {
            $event = Event::onlyTrashed()->find($id);
            $event->forceDelete();
            $eventName = $event->name;

            // Emito un evento para notificar
            $this->emit('eventForceDeleted', $eventName);
        } catch (\Throwable $th) {
            toastr()->error('¡El evento <b>' . $eventName . '</b> no se pudo eliminar definitivamente!', 'Error');
        }
    }

    public function handleEventForceDeleted($eventName)
    {
        toastr()->success('¡El evento <b>' . $eventName . '</b> fue eliminado definitivamente!', 'Éxito');
    }
}
