<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles: Super Admin, Admin, Supervisor, Coordinador, Invitado
        $superAdmin = Role::create(['name' => 'Super']);
        $admin = Role::create(['name' => 'Administrador']);
        $supervisor = Role::create(['name' => 'Supervisor']);
        $coordinador = Role::create(['name' => 'Coordinador']);
        $invitado = Role::create(['name' => 'Invitado']);

        // Permisos

        Permission::create(['name' => 'dashboard', 'description' => 'Ver Panel'])->syncRoles([$admin, $supervisor, $coordinador, $invitado]);
        // CRUD Usuarios
        Permission::create(['name' => 'users.index', 'description' => 'Ver Usuarios'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'users.show', 'description' => 'Ver detalles Usuarios'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'users.edit', 'description' => 'Editar Usuarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'users.create', 'description' => 'Crear Usuarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'users.update', 'description' => 'Actualizar Usuarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'users.remove', 'description' => 'Quitar Usuarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'users.restore', 'description' => 'Restaurar Usuarios'])->syncRoles([$admin]);
        Permission::create(['name' => 'users.destroy', 'description' => 'Eliminar Usuarios'])->syncRoles([$admin]);
        // CRUD Roles
        Permission::create(['name' => 'roles.index', 'description' => 'Ver Roles'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'roles.show', 'description' => 'Ver detalles Roles'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'roles.edit', 'description' => 'Editar Roles'])->syncRoles([$admin]);
        Permission::create(['name' => 'roles.create', 'description' => 'Crear Roles'])->syncRoles([$admin]);
        Permission::create(['name' => 'roles.update', 'description' => 'Actualizar Roles'])->syncRoles([$admin]);
        Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar Roles'])->syncRoles([$admin]);
        // CRUD Permisos
        Permission::create(['name' => 'permissions.index', 'description' => 'Ver Permisos'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'permissions.show', 'description' => 'Ver detalles Permisos'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'permissions.edit', 'description' => 'Editar Permisos'])->syncRoles([$admin]);
        Permission::create(['name' => 'permissions.create', 'description' => 'Crear Permisos'])->syncRoles([$admin]);
        Permission::create(['name' => 'permissions.update', 'description' => 'Actualizar Permisos'])->syncRoles([$admin]);
        Permission::create(['name' => 'permissions.destroy', 'description' => 'Eliminar Permisos'])->syncRoles([$admin]);
        // CRUD Extras
        Permission::create(['name' => 'extras.index', 'description' => 'Ver Figurantes'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'extras.show', 'description' => 'Ver detalles Figurantes'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'extras.edit', 'description' => 'Editar Figurantes'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'extras.create', 'description' => 'Crear Figurantes'])->syncRoles([$admin]);
        Permission::create(['name' => 'extras.update', 'description' => 'Actualizar Figurantes'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'extras.remove', 'description' => 'Quitar Figurantes'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'extras.restore', 'description' => 'Restaurar Figurantes'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'extras.destroy', 'description' => 'Eliminar Figurantes'])->syncRoles([$admin]);
        // CRUD Extras Menores
        Permission::create(['name' => 'youngers.extras.index', 'description' => 'Ver Figurantes Menores'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'youngers.extras.show', 'description' => 'Ver detalles Figurantes Menores'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'youngers.extras.edit', 'description' => 'Editar Figurantes Menores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'youngers.extras.create', 'description' => 'Crear Figurantes Menores'])->syncRoles([$admin]);
        Permission::create(['name' => 'youngers.extras.update', 'description' => 'Actualizar Figurantes Menores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'youngers.extras.remove', 'description' => 'Quitar Figurantes Menores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'youngers.extras.restore', 'description' => 'Restaurar Figurantes Menores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'youngers.extras.destroy', 'description' => 'Eliminar Figurantes Menores'])->syncRoles([$admin]);
        // CRUD Actores
        Permission::create(['name' => 'actors.index', 'description' => 'Ver Actores'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'actors.show', 'description' => 'Ver detalles Actores'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'actors.edit', 'description' => 'Editar Actores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'actors.create', 'description' => 'Crear Actores'])->syncRoles([$admin]);
        Permission::create(['name' => 'actors.update', 'description' => 'Actualizar Actores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'actors.remove', 'description' => 'Quitar Actores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'actors.restore', 'description' => 'Restaurar Actores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'actors.destroy', 'description' => 'Eliminar Actores'])->syncRoles([$admin]);
        // CRUD Actores Menores
        Permission::create(['name' => 'youngers.actors.index', 'description' => 'Ver Actores Menores'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'youngers.actors.show', 'description' => 'Ver detalles Actores Menores'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'youngers.actors.edit', 'description' => 'Editar Actores Menores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'youngers.actors.create', 'description' => 'Crear Actores Menores'])->syncRoles([$admin]);
        Permission::create(['name' => 'youngers.actors.update', 'description' => 'Actualizar Actores Menores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'youngers.actors.remove', 'description' => 'Quitar Actores Menores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'youngers.actors.restore', 'description' => 'Restaurar Actores Menores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'youngers.actors.destroy', 'description' => 'Eliminar Actores Menores'])->syncRoles([$admin]);
        // CRUD Coordinadores
        Permission::create(['name' => 'coordinators.index', 'description' => 'Ver Coordinadores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'coordinators.show', 'description' => 'Ver detalles Coordinadores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'coordinators.edit', 'description' => 'Editar Coordinadores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'coordinators.create', 'description' => 'Crear Coordinadores'])->syncRoles([$admin]);
        Permission::create(['name' => 'coordinators.update', 'description' => 'Actualizar Coordinadores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'coordinators.remove', 'description' => 'Quitar Coordinadores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'coordinators.restore', 'description' => 'Restaurar Coordinadores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'coordinators.destroy', 'description' => 'Eliminar Coordinadores'])->syncRoles([$admin]);
        // CRUD Eventos TV
        Permission::create(['name' => 'events.index', 'description' => 'Ver Eventos'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'events.show', 'description' => 'Ver detalles Eventos'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'events.edit', 'description' => 'Editar Eventos'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'events.create', 'description' => 'Crear Eventos'])->syncRoles([$admin]);
        Permission::create(['name' => 'events.update', 'description' => 'Actualizar Eventos'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'events.destroy', 'description' => 'Eliminar Eventos'])->syncRoles([$admin]);
        // Vista y listado Espectadores TV
        Permission::create(['name' => 'viewers.index', 'description' => 'Ver Espectadores'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'viewers.show', 'description' => 'Ver detalles Espectadores'])->syncRoles([$admin, $supervisor, $coordinador]);
        // Pdf y Excel
        Permission::create(['name' => 'exports.excel', 'description' => 'Exportar Excel'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'exports.pdf', 'description' => 'Exportar PDF'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'exportsYounger.excel', 'description' => 'Exportar Excel Menores'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'exportsYounger.pdf', 'description' => 'Exportar PDF Menores'])->syncRoles([$admin, $supervisor, $coordinador]);
        Permission::create(['name' => 'exportsCoordinator.excel', 'description' => 'Exportar Excel Coordinadores'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'exportsCoordinator.pdf', 'description' => 'Exportar PDF Coordinadores'])->syncRoles([$admin, $supervisor]);
        // Migraciones entre actores y extras
        Permission::create(['name' => 'migrate.extraToActor', 'description' => 'Extra a Actor'])->syncRoles([$admin]);
        Permission::create(['name' => 'migrate.actorToExtra', 'description' => 'Actor a Extra'])->syncRoles([$admin]);
        // Vistas de eliminados
        Permission::create(['name' => 'deleted.extras', 'description' => 'Ver Extras eliminados'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'deleted.youngers.extras', 'description' => 'Ver Extras Menores eliminados'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'deleted.actors', 'description' => 'Ver Actores eliminados'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'deleted.youngers.actors', 'description' => 'Ver Actores Menores eliminados'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'deleted.coordinators', 'description' => 'Ver Coordinadores eliminados'])->syncRoles([$admin, $supervisor]);
        Permission::create(['name' => 'deleted.users', 'description' => 'Ver Usuarios eliminados'])->syncRoles([$admin, $supervisor]);
    }
}
