<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class RolesTable extends DataTableComponent
{
    protected $model;

    public function builder(): Builder
    {
        $user = User::find(auth()->user()->id);
        if($user->hasRole('Super')){
            $this->model = Role::query();
        } else {
            $this->model = Role::query()->where('name', '!=', 'Super');
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
                ->hideIf(true),
            Column::make('Rol', 'name')
                ->sortable()
                ->searchable(),
            Column::make("Fecha Creación", "created_at")
                ->format(
                    function ($value, $row, Column $column) {
                        return date('d/m/Y H:i', strtotime($value));
                    }
                )
                ->sortable()
                ->collapseOnTablet(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('components.action-role', ['role' => $row]);
                })
                ->html()
                ->collapseOnTablet(),
        ];
    }
}
