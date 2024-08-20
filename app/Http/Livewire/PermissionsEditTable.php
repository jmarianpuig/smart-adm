<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsEditTable extends DataTableComponent
{
    public $role;

    protected $model;

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function builder(): Builder
    {
        $this->model = Permission::query();
        
        return $this->model;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFilterLayout('slide-down')
            ->setEmptyMessage('No hay permisos para este rol');
    }

    public function columns(): array
    {
        return [
            Column::make('Nombre', 'description')
                ->sortable()
                ->searchable()
                ->sortable(),
            Column::make('Permisos', 'id')
                ->format(function ($value, $row, Column $column) {
                    $isSelected = $row->roles->contains('id', $this->role);
                    if ($isSelected) {
                        $marked = '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 text-green-500 @else" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>';
                        return $marked;
                    } else {
                        $marked = '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>';
                        return $marked;
                    };
                })
                ->html(),
            // Column::make('Tiene Permisos', 'id')
            //     ->format(function ($value, $row, Column $column) {
            //         $isSelected = $row->roles->contains('id', $this->role);
            //         if ($isSelected) {
            //             $marked = '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 text-green-500 @else" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            //                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            //             </svg>';
            //             return $marked;
            //         };
            //     })
            //     ->html(),
            // Column::make('Sin permisos', 'id')
            //     ->format(function ($value, $row, Column $column) {
            //         $isSelected = $row->roles->contains('id', $this->role);
            //         if (!$isSelected) {
            //             $notMarked = '<svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            //                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            //             </svg>';
            //             return $notMarked;
            //         };
            //     })
            //     ->html(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    $role = $row->roles->first();
                    
                    $isSelected = $row->roles->contains('id', $this->role);
                    
                    $buttonHtml = '<div class="flex items-center">';
                    $buttonHtml .= '<button wire:click="update(' . $this->role . ',' . $row->id . ')" class="rounded px-2 py-1 flex items-center justify-center ' . ($isSelected ? 'bg-red-600' : 'bg-green-600') . '">';
                    $buttonHtml .= '<small class="text-white ">' . ($isSelected ? 'QUITAR' : 'AÑADIR') . '</small>';
                    $buttonHtml .= '</button>';
                    $buttonHtml .= '</div>';

                    return $buttonHtml;
                })
                ->html(),
        ];
    }

    protected $listeners = [
        'eventRevokePermission' => 'handleRevokePermission',
        'eventGivePermission' => 'handleGivePermission'
    ];

    public function update($roleId, $permissionId)
    {
        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);
        // dd($roleId, $permissionId );
        try {
            if ($role && $permission) {
                if ($role->hasPermissionTo($permission->name)) {
                    // Obtener todos los roles que tienen el permiso
                    $rolesWithPermission = Role::whereHas('permissions', function ($query) use ($permission) {
                        $query->where('name', $permission->name);
                    })->get();
                
                    // Excluir el rol actual
                    $otherRoles = $rolesWithPermission->filter(function ($otherRole) use ($role) {
                        return $otherRole->id !== $role->id;
                    });
                
                    // Verificar si hay otros roles que tengan el permiso
                    if ($otherRoles->isEmpty()) {
                        toastr()->error('¡El permiso <b>' . $permission->description . '</b> no se puede eliminar porque ningún otro rol lo tiene!', 'Error');
                    } else {
                        $role->revokePermissionTo($permission->name);
                        // Emitir un evento para notificar
                        $this->emit('eventRevokePermission', $permission->description, $role->name);
                    }
              
                } else {
                    $role->givePermissionTo($permission->name);
                    // Emito un evento para notificar
                    $this->emit('eventGivePermission', $permission->description, $role->name);
                }
            }
        } catch (\Throwable $th) {
            toastr()->error('¡El permiso <b>' . $permission->description . '</b> no se pudo cambiar!', 'Error');
        }
    }
    

    public function handleRevokePermission($permission, $rol)
    {
        toastr()->success('¡El permiso <b>' . $permission . ' </b>al rol<b> ' . $rol . '</b> fue quitado!', 'Éxito');
    }

    public function handleGivePermission($permission, $rol)
    {
        toastr()->success('¡El permiso <b>' . $permission . ' </b>al rol<b> ' . $rol . '</b> fue añadido!', 'Éxito');
    }
}
