<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoordinatorUpdateRequest;
use App\Models\Coordinator;
use App\Models\WebUser;
use App\Traits\HandleFilesUserTrait;
use App\Traits\HandleImagesUserTrait;
use App\Traits\ValidationDniNieTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class CoordinatorController extends Controller
{
    use ValidationDniNieTrait, HandleImagesUserTrait, HandleFilesUserTrait;

    protected WebUser $webUser;
    protected Coordinator $coordinator;

    public function __construct(WebUser $webUser, Coordinator $coordinator)
    {
        $this->webUser = $webUser;
        $this->coordinator = $coordinator;

        $this->middleware('permission:coordinators.index', ['only' => ['index']]);
        $this->middleware('permission:coordinators.show', ['only' => ['show']]);
        $this->middleware('permission:coordinators.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:coordinators.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:coordinators.update', ['only' => ['update']]);
        $this->middleware('permission:coordinators.remove', ['only' => ['removeCoordinatorFromList']]);
        $this->middleware('permission:coordinators.restore', ['only' => ['restoreCoordinatorToList']]);

        $this->middleware('permission:coordinators.destroy', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        return view('coordinators.index');
    }

    public function show(Coordinator $data): View
    {
        return view('coordinators.show', compact('data'));
    }

    public function edit(Coordinator $data): View
    {
        return view('coordinators.edit', compact('data'));
    }

    public function update(CoordinatorUpdateRequest $request, $coordinatorId)
    {
                // Busco el primer coordi que tenga 'user_id' igual a $userId
        $coordinator = $this->coordinator::where('id', $coordinatorId)->first();

        // Busco el primer User que tenga 'id' igual a $userId
        $webUser = $this->webUser::where('id', $request->user_id)->first();

        try {
            if ($webUser && $coordinator && ($webUser->id == $coordinator->user_id)) {

               // Validación del DNI/NIE si cambia
               if ($coordinator->dni != $request->dni) {

                // valido que es un dni/nie correcto
                $dni = $request->dni;
                $this->validateDniNieUpdate($dni);

                // Verifico que el nuevo DNI/NIE no exista ya en las tabla 'coordinators'
                if ($this->dniExists($request)) {
                    return redirect()->back()->withErrors(['dni' => 'El DNI/NIE ya existe en otra cuenta'])->withInput();
                }

                // intento actualizar el dni
                $this->updateNewDni($request, $coordinator);
            }
                // Actualización del modelo User
                $this->updateUser($request, $webUser);

                // Actualización del modelo coordinator
                $this->updateCoordinator($request, $coordinator);

                // tratamientos de las imágenes
                $this->handleImages($request, $coordinator);

                // trartamientos de archivos
                $this->handlefiles($request, $coordinator);

                // todo es ok, devuelvo con mensaje de exito
                toastr()->success('¡Datos Actualizados!', 'Éxito');
                return redirect()->route('coordinators.show', $coordinator->slug);
            } else {
                // no hay coincidencias en los id de la peticion, lo envio fuera de la app
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return Redirect::to('/');
            }
        } catch (\Exception $e) {
            Log::error('Error en el proceso de registro: ' . $e->getMessage());
            toastr()->error('¡Algunos datos no se han podido actualizar, revíselos!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    private function dniExists($request)
    {
        $dniExistsInCoordinators = Coordinator::where('dni', $request->dni)->exists();

        return $dniExistsInCoordinators;
    }

    
    private function updateNewDni($request, Coordinator $coordinator)
    {
        try {
            $coordinator->update([
                "dni" => $request->dni,
            ]);
        } catch (\Exception $e) {
            Log::error('Error con el dni: ' . $e->getMessage());
            toastr()->error('¡Revise el DNI!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    private function updateUser($request, $webUser)
    {
        // nombre completo
        $full_name = $request->input('name') . ' ' . $request->input('first_lname') . ' ' . $request->input('second_lname');

        // actualizo usuario
        try {
            $webUser->update([
                "name" => $request->input('name'),
                "first_lname" => $request->input('first_lname'),
                "second_lname" => $request->input('second_lname'),
                "full_name" => $full_name
            ]);
        } catch (\Exception $e) {
            Log::error('Error en el proceso de registro: ' . $e->getMessage());
            toastr()->error('¡Algunos datos no se han podido actualizar, revise los datos!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    private function updateCoordinator(CoordinatorUpdateRequest $request, $coordinator)
    {
        // nombre completo
        $full_name = $request->input('name') . ' ' . $request->input('first_lname') . ' ' . $request->input('second_lname');

        // pruebo a actulizar el modelo coordinator
        try {
            $coordinator->update([
                "name" => $request->input('name'),
                "first_lname" => $request->input('first_lname'),
                "second_lname" => $request->input('second_lname'),
                "full_name" => $full_name,
                "birthdate" => $request->input('birthdate'),
                "ss" => $request->input('ss'),
                "phone" => $request->input('phone'),
                "adress" => $request->input('adress'),
                "zip_code" => $request->input('zip_code'),
                "municipio_id" => $request->input('municipio'),
                'experience' => $request->input('experience'),
                'has_car' => $request->input('has_car'),
                'move_to_work_id' => $request->input('move_to_work_id')
            ]);
        } catch (\Exception $e) {
            Log::error('Error en el proceso de registro: ' . $e->getMessage());
            toastr()->error('¡Algunos datos no se han podido actualizar, revise los datos!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    protected function removeCoordinatorFromList(Coordinator $data)
    {
        try {
            $data->update([
                "removed" => true
            ]);
            
            toastr()->success('¡' . $data->full_name . ' fue eliminado de la lista!', 'Éxito');
            return redirect()->route('coordinators.index');
        } catch (\Exception $e) {
            Log::error('Error en el proceso de eliminar del listado: ' . $e->getMessage());
            toastr()->error('¡No se ha podido eliminar al Coordinador ' . $data->full_name . '!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    protected function restoreCoordinatorToList(Coordinator $data)
    {
        try {
            $data->update([
                "removed" => false
            ]);

            toastr()->success('¡' . $data->full_name . ' fue añadido a la lista!', 'Éxito');
            return redirect()->route('coordinators.index');
        } catch (\Exception $e) {
            Log::error('Error en el proceso de añadir al listado: ' . $e->getMessage());
            toastr()->error('¡No se ha podido añadir al Coordinador ' . $data->full_name . '!', 'Error');
            return redirect()->back()->withInput();
        }
    }
}
