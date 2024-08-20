<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Traits\AttributeHelpersTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use AttributeHelpersTrait;

    public function __construct() {
        
        $this->middleware('permission:users.index', ['only' => ['index']]);
        $this->middleware('permission:users.show', ['only' => ['show']]);
        $this->middleware('permission:users.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:users.update', ['only' => ['update']]);
        $this->middleware('permission:users.remove', ['only' => ['removeUserFromList']]);
        $this->middleware('permission:users.restore', ['only' => ['restoreUserToList']]);

        $this->middleware('permission:users.destroy', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('users.index');
    }

    public function show(User $user)
    {
        $loggedInUser = Auth::user();

        if ($user->id == 1 && !$loggedInUser->hasRole('Super')) {
            return redirect()->route('users.index');
        }

        return view('users.show', compact('user'));
    }


    public function create()
    {
        $loggedInUser = Auth::user();

        if ($loggedInUser->hasRole('Super')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'Super')->get();
        }

        return view('users.create', compact('roles'));
    }


    public function edit(User $user)
    {

        $user = User::find($user->id);
        $loggedInUser = Auth::user();
        $userRoleId = $user->roles->first()->id ?? null;

        if ($loggedInUser->hasRole('Super')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'super')->get();
        }

        return view('users.edit', compact('user', 'roles', 'userRoleId'));
    }

    public function store(UserRequest $request)
    {
        $full_name = $request->input('name') . ' ' . $request->input('first_lname') . ' ' . $request->input('second_lname');

        // Pruebo a crear el usuario y asignarle el rol
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'first_lname' => $request->input('first_lname'),
                'second_lname' => $request->input('second_lname'),
                'full_name' => $full_name,
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make($request->input('password')),
                'created_by' => $request->input('created_by'),
                'created_by_id' => $request->input('created_by_id'),
            ]);
            $role = Role::findById($request->role)->name;
            $user->syncRoles($role);
        } catch (\Exception $e) {
            Log::error($e);
            toastr()->error('¡Vaya! ¡Algo salió mal!<br>' . $e->getMessage() . '');
            return redirect()->route('users.index');
        }

        // vuelvo a la vista principal si se crea correctamente
        toastr()->success('¡Usuario ' . $request->name . ' creado!', '¡Éxito!');
        return redirect()->route('users.index');
    }


    public function update(Request $request, User $user)
    {
        // email original
        $originalEmail = $user->email;

        // nuevo email
        $newEmail = $request->input('email');

        // password original
        $originalPass = $user->password;

        // nuevo password
        $newPass = $request->input('password');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'first_lname' => 'required|string|max:30',
            'second_lname' => 'nullable|string|max:30',
            'full_name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|integer|digits:9',
            'password' => 'nullable|string|min:8|max:15',
            'created_by' => 'required|string',
            'created_by_id' => 'required|integer',
            'role' => 'required|integer',
        ]);

        // compruebo si han cambiado y si es asi agrego la nueva regla de validacion
        if ($originalEmail != $newEmail) {
            $validator->addRules(['email' => 'unique:users']);
        }

        if ($originalPass != $newPass && $newPass) {
            $validator->addRules(['password' => 'required']);
        } else {
            $request->offsetUnset('password');
        }

        // Validar los datos antes de intentar actualizar
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                toastr()->error($error);
            }
            return redirect()->back()->withInput();
        }

        // Pruebo a actualizar el usuario
        try {
            // Si hay nueva contraseña, hashearla
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $role = Role::findById($request->role)->name;
            // Actualizar los demás campos
            $user->update($request->except('password'));
            $user->syncRoles($role);
        } catch (\Exception $e) {
            Log::error($e);
            toastr()->error('¡Vaya! ¡Algo salió mal!<br>' . $e->getMessage() . '');
            toastr()->error('El usuario no se ha actualizado correctamente.');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Vuelvo a la vista principal si se actualiza correctamente
        toastr()->success('¡Usuario ' . $request->name . ' actualizado!', '¡Éxito!');
        return redirect()->route('users.index');
    }

    protected function removeUserFromList(User $user)
    {
        try {
            $user->update([
                "removed" => true
            ]);

            toastr()->success('¡' . $user->getFullNameAttribute() . ' fue eliminado de la lista!', 'Éxito');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Log::error('Error en el proceso de eliminar del listado: ' . $e->getMessage());
            toastr()->error('¡No se ha podido eliminar al Actor ' . $user->getFullNameAttribute() . '!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    protected function restoreUserToList(User $user)
    {
        try {
            $user->update([
                "removed" => false
            ]);

            toastr()->success('¡' . $user->getFullNameAttribute() . ' fue añadido a la lista!', 'Éxito');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Log::error('Error en el proceso de añadir al listado: ' . $e->getMessage());
            toastr()->error('¡No se ha podido añadir al Actor ' . $user->getFullNameAttribute() . '!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            toastr()->success('¡Usuario <b>' . $user->fullName . '</b> Eliminado!', 'Éxito');
            return redirect()->route('users.index');
        } catch (\Exception $e) {
            toastr()->error('¡Ocurrió un error al eliminar el usuario!', 'Error');
            return redirect()->route('users.index');
        }
    }
}
