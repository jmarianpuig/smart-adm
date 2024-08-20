<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct() {
    
        $this->middleware('permission:roles.index', ['only' => ['index']]);
        $this->middleware('permission:roles.show', ['only' => ['show']]);
        $this->middleware('permission:roles.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:roles.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:roles.update', ['only' => ['update']]);

        $this->middleware('permission:roles.destroy', ['only' => ['destroy']]);    
    }

    public function index(): View
    {
        return view('roles.index');
    }

    public function show(Role $role)
    {
        $loggedInUser = Auth::user();

        if ($role->id == 1 && !$loggedInUser->hasRole('Super')) {
            return redirect()->route('roles.index');
        }

        $role = Role::find($role->id);
        return view('roles.show', compact('role'));
    }

    public function create()
    {
        $role = new Role();
        return view('roles.create', compact('role'));
    }

    public function edit(Role $role)
    {
        $loggedInUser = Auth::user();

        if ($role->id == 1 && !$loggedInUser->hasRole('Super')) {
            return redirect()->route('roles.index');
        }
        
        $role = Role::find($role->id);
        return view('roles.edit', compact('role'));
    }

    public function store(Request $role)
    {
        $validator = Validator::make($role->all(), [
            'name' => 'required|string|max:30|unique:roles',
            'description' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            toastr()->error('¡Ya existe un Rol con ese nombre!', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Creo el nuevo rol
            $newRole = Role::create([
                'name' => $role->input('name'),
                'description' => $role->input('description'),
            ]);

            // le asigno el permiso de ver el panel de control
            $newRole->givePermissionTo('dashboard');

            toastr()->success('¡Rol <b>' . $newRole->name . '</b> creado!', 'Éxito');
            return redirect()->route('roles.edit', ['role' => $newRole]);
        } catch (\Throwable $th) {
            Log::error($th);
            toastr()->error('¡No se pudo crear el Rol <b>' . $role->input('name') . '</b>!', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function destroy(Role $role)
    {
        $users = User::role($role->name)->get();

        if ($users->isEmpty()) {
            // Elimino todas las asociaciones entre el rol y sus permisos
            $role->syncPermissions();
            $role->delete();

            toastr()->success('¡El Rol ' . $role->name . ' se eliminó! ', 'Error');
            return redirect()->back();
        }

        toastr()->error('¡No se puede eliminar un Rol con Usuarios! ', 'Error');
        return redirect()->back();
    }
}
