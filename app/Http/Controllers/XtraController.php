<?php

namespace App\Http\Controllers;

use App\Http\Requests\XtraUpdateRequest;
use App\Models\Actor;
use App\Models\Xtra;
use App\Models\WebUser;
use App\Traits\HandleImagesUserTrait;
use App\Traits\ValidationDniNieTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class XtraController extends Controller
{

    use ValidationDniNieTrait, HandleImagesUserTrait;

    protected WebUser $webUser;
    protected Xtra $extra;

    public function __construct(WebUser $webUser, Xtra $extra)
    {
        $this->webUser = $webUser;
        $this->extra = $extra;

        $this->middleware('permission:extras.index', ['only' => ['index']]);
        $this->middleware('permission:extras.show', ['only' => ['show']]);
        $this->middleware('permission:extras.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:extras.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:extras.update', ['only' => ['update']]);
        $this->middleware('permission:extras.remove', ['only' => ['removeXtraFromList']]);
        $this->middleware('permission:extras.restore', ['only' => ['restoreXtraToList']]);

        $this->middleware('permission:actors.destroy', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $modelType= 'Xtra';
        return view('extras.index', compact('modelType'));
    }

    public function show(Xtra $data): View
    {
        return view('extras.show', compact('data'));
    }

    public function edit(Xtra $data): View
    {
        return view('extras.edit', compact('data'));
    }

    public function update(XtraUpdateRequest $request, $extraId)
    {
        // Busco el primer Xtra que tenga 'user_id' igual a $extraId
        $extra = $this->extra::where('id', $extraId)->first();

        // Busco el primer User que tenga 'id' igual a $userId
        $webUser = $this->webUser::where('id', $request->user_id)->first();
        // valido el formulario
        try {
            if ($webUser && $extra && ($webUser->id == $extra->user_id)) {
                
                // Validación del DNI/NIE si cambia
                if ($extra->dni != $request->dni) {
                    
                    // valido que es un dni/nie correcto
                    $dni = $request->dni;
                    $this->validateDniNieUpdate($dni);
                    
                    // Verifico que el nuevo DNI/NIE no exista ya en las tablas 'actors' y 'xtras'
                    if ($this->dniExists($request)) {
                        return redirect()->back()->withErrors(['dni' => 'El DNI/NIE ya existe en otra cuenta'])->withInput();
                    }
                    
                    // intento actualizar el dni
                    $this->updateNewDni($request, $extra);
                }
                
                // Actualización del modelo User
                $this->updateUser($request, $webUser);
                
                // Actualización del modelo Xtra
                $this->updateExtra($request, $extra);
                
                // tratamientos de las imágenes
                $this->handleImages($request, $extra);

                // todo es ok, devuelvo con mensaje de exito
                toastr()->success('¡Datos Actualizados!', 'Éxito');
                return redirect()->route('extras.show', $extra->slug);
            } else {
                // no hay coincidencias en los id de la peticion, lo envio fuera de la app
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return Redirect::to('/');
            }
        } catch (\Exception $e) {
            Log::error('Error en el proceso de registro: ' . $e->getMessage());
            toastr()->error('¡Algunos datos no se han podido actualizar, revise los datos!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    private function dniExists($request)
    {
        $dniExistsInActors = Actor::where('dni', $request->dni)->exists();
        $dniExistsInExtras = Xtra::where('dni', $request->dni)->exists();

        return $dniExistsInActors || $dniExistsInExtras;
    }

    private function updateNewDni($request, Xtra $extra)
    {
        try {
            $extra->update([
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

    private function updateExtra(XtraUpdateRequest $request, $extra)
    {
        $full_name = $request->input('name') . ' ' . $request->input('first_lname') . ' ' . $request->input('second_lname');
        
        // pruebo a actulizar el modelo xtra
        try {
            $extra->update([
                "name" => $request->input('name'),
                "first_lname" => $request->input('first_lname'),
                "second_lname" => $request->input('second_lname'),
                "full_name" => $full_name,
                "birthdate" => $request->input('birthdate'),
                "alias" => $request->input('alias'),
                "ss" => $request->input('ss'),
                "is_retired" => $request->input('is_retired'),
                "phone" => $request->input('phone'),
                "adress" => $request->input('adress'),
                "zip_code" => $request->input('zip_code'),
                "municipio_id" => $request->input('municipio'),
                "height" => $request->input('height'),
                "shirt_size_id" => $request->input('shirt_size'),
                "pant_size_id" => $request->input('pant_size'),
                "shoe_size_id" => $request->input('shoe_size'),
                "study_id" => $request->input('study'),
                "eye_color_id" => $request->input('eye_color'),
                "hair_color_id" => $request->input('hair_color'),
                "race_id" => $request->input('race'),
                "availability_id" => $request->input('availability'),
                "has_car" => $request->input('has_car'),
                "is_disabled" => $request->input('is_disabled'),
                "has_tattoos" => $request->input('has_tattoos'),
                "skills" => $request->input('skills'),
                "url_book" => $request->input('url_book'),
            ]);
        } catch (\Exception $e) {
            Log::error('Error en el proceso de registro: ' . $e->getMessage());
            toastr()->error('¡Algunos datos no se han podido actualizar, revise los datos!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    protected function removeXtraFromList(Xtra $data)
    {
        try {
            $data->update([
                "removed" => true
            ]);
            
            toastr()->success('¡' . $data->full_name . ' fue eliminado de la lista!', 'Éxito');
            return redirect()->route('extras.index');
        } catch (\Exception $e) {
            Log::error('Error en el proceso de eliminar del listado: ' . $e->getMessage());
            toastr()->error('¡No se ha podido eliminar al Xtra ' . $data->full_name . '!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    protected function restoreXtraToList(Xtra $data)
    {
        try {
            $data->update([
                "removed" => false
            ]);

            toastr()->success('¡' . $data->full_name . ' fue añadido a la lista!', 'Éxito');
            return redirect()->route('extras.index');
        } catch (\Exception $e) {
            Log::error('Error en el proceso de añadir al listado: ' . $e->getMessage());
            toastr()->error('¡No se ha podido añadir al Figurante ' . $data->full_name . '!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    // sin uso actualmente a espera de decidir quien podrá hacerlo
    private function destroy(Xtra $data)
    {
        // falta añadir funcionalidad para eliminar las imágenes relacionadas en la carpeta
        try {
            $data->delete();
            $data->imageables()
                ->where('imageable_type', 'App\Models\Xtra')
                ->delete();
    
            toastr()->success('¡El extra ' . $data->name . ' se eliminó! ', '¡Éxito!');
            return redirect()->route('extras.index');
        } catch (\Exception $e) {
            Log::error('Error en el proceso de borrado: ' . $e->getMessage());
            toastr()->error('¡No se ha podido eliminar al Figurante ' . $data->full_name . '!', 'Error');
            return redirect()->back()->withInput();
        }
    }

}
