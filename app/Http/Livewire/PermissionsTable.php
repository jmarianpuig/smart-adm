<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTable extends DataTableComponent
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
            ->setDefaultSort('id', 'asc')
            ->setSingleSortingStatus(false)
            ->setEagerLoadAllRelationsEnabled(true)
            ->setEagerLoadAllRelationsStatus(true)
            ->setColumnSelectStatus(false)
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
            // Column::make('Sin permiso', 'id')
            //     ->format(function ($value, $row, Column $column) {
            //         $role = $row->roles->first();

            //         $isSelected = $row->roles->contains('id', $this->role);
            //         $buttonHtml = '<div class="flex items-center">';
            //         $buttonHtml .= '<button wire:click="update(' . $role->id . ',' . $row->id . ',' . $isSelected . ')" class="rounded-full w-8 h-8 flex items-center justify-center ' . ($isSelected ? 'bg-green-600' : 'bg-red-600') . '">';
            //         $buttonHtml .= '<i class="text-white ' . ($isSelected ? 'fas fa-lg fa-minus' : 'fas fa-lg fa-plus') . '"></i>';
            //         $buttonHtml .= '</button>';
            //         $buttonHtml .= '<span class="ml-2 ' . ($isSelected ? 'text-green-600' : 'text-red-600') . '">' . ($isSelected ? 'Quitar' : 'Añadir') . '</span>';
            //         $buttonHtml .= '</div>';

            //         return $buttonHtml;
            //     })
            //     ->html(),
        ];
    }
}
