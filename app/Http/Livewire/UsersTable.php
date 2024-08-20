<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

class UsersTable extends DataTableComponent
{
    protected $model;

    protected $listeners = [
        'userRestored' => 'handleUserRestored',
        'userForceDeleted' => 'handleUserForceDeleted'
    ];


    public function builder(): Builder
    {
        $user = User::find(auth()->user()->id);
        if($user->hasRole('Super')){
            $this->model = User::query()
                            ->where('removed', 0);
        } else {
            $this->model = User::query()
                            ->where('removed', 0)
                            ->where('id', '!=', '1');
        }

        return $this->model;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayout('slide-down')
            ->setEmptyMessage('No hay usuarios para mostrar');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->deselected(),
            Column::make('Nombre/Email/Tfno', 'name')
                ->format(
                    fn ($value, $row, Column $column) => view('components.user-name-table', ['data' => $row])
                )
                ->sortable()
                ->searchable(),
            Column::make('apellido1', 'first_lname')
                ->searchable()
                ->hideIf(true),
            Column::make('apellido2', 'second_lname')
                ->searchable()
                ->hideIf(true),
            Column::make('nombre completo', 'full_name')
                ->searchable()
                ->hideIf(true),
            Column::make('Teléfono', 'phone')
                ->searchable()
                ->hideIf(true),
            Column::make('Email', 'email')
                ->searchable()
                ->hideIf(true),
            Column::make('removed')
                ->searchable()
                ->hideIf(true),
            Column::make("Fecha Alta", "created_at")
                ->format(
                    function ($value, $row, Column $column) {
                        return date('d/m/Y H:i', strtotime($value));
                    }
                )
                ->sortable(),
            Column::make("Roles", 'id')
                ->format(
                    function ($value, $row, Column $column) {
                        $roles = $row->roles->pluck('name')->implode(', ');
                        return view('livewire.role-pill', ['role' => $roles]);
                    }
                )
                ->searchable()
                ->sortable(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {

                        return view('components.action-user', ['user' => $row]);

                })
                ->html()
                ->collapseOnTablet(),
        ];
    }

    public function restoreRecord($id)
    {
        // Restauro el usuario borrado
        try {
            $user = User::withTrashed()->find($id);
            $user->restore();
            $userName = $user->fullName; // Obtngo el nombre del usurio

            // Emito un evento para notificar
            $this->emit('userRestored', $userName);
        } catch (\Throwable $th) {
            toastr()->error('¡El Usuario <b>' . $userName . '</b> no se pudo recuperar!', 'Error');
        }
    }

    public function handleUserRestored($userName)
    {
        toastr()->success('¡El usuario <b>' . $userName . '</b> fue restaurado!', 'Éxito');
    }

    public function forceDeleteRecord($id)
    {
        // Elimino definitivamente el usuario borrado
        try {
            $user = User::onlyTrashed()->find($id);
            $user->forceDelete();
            $userName = $user->fullName; // Obtngo el nombre del usurio

            // Emito un evento para notificar
            $this->emit('userForceDeleted', $userName);
        } catch (\Throwable $th) {
            toastr()->error('¡El usuario <b>' . $userName . '</b> no se pudo eliminar definitivamente!', 'Error');
        }
    }

    public function handleUserForceDeleted($userName)
    {
        toastr()->success('¡El usuario <b>' . $userName . '</b> fue eliminado definitivamente!', 'Éxito');
    }
}
