<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Provincia;
use App\Models\Viewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Log;
use Spatie\SimpleExcel\SimpleExcelWriter;

class EventController extends Controller
{
    public function __construct() {
        $this->middleware('permission:events.index', ['only' => ['index']]);
        $this->middleware('permission:events.show', ['only' => ['show']]);
        $this->middleware('permission:events.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:events.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:events.update', ['only' => ['update']]);
        $this->middleware('permission:events.remove', ['only' => ['removeActorFromList']]);
        $this->middleware('permission:events.restore', ['only' => ['restoreActorToList']]);

        $this->middleware('permission:events.destroy', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        // $event = Event::with('user')->all();
        // dd($event);
        return view('events.index');
    }


    public function create(): View
    {
        $provincias = Provincia::pluck('id', 'provincia');
        return view('events.create', compact('provincias'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $provincia = Provincia::findOrFail($request->place)->provincia;

        $validator = Validator::make($request->only(['name', 'description', 'event_date', 'status', 'created_by', 'user_id']), [
            'name' => 'required|string|max:30',
            'description' => 'required|string|max:100',
            'event_date' => 'required|date|after_or_equal:now',
            'status' => 'required|integer',
            'created_by' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            toastr()->error('¡Vaya! ¡Algo salió mal!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'place' => $provincia,
            'event_date' => $request->event_date,
            'status' => $request->status,
            'created_by' => $request->created_by,
            'user_id' => $request->user_id
        ]);

        toastr()->success('¡Evento ' . $request->name . ' Actualizado!', 'Éxito');
        return redirect()->route('events.index');
    }


    public function edit(Event $data): View
    {

        $provincias = Provincia::pluck('id', 'provincia');
        return view('events.edit',  compact('data', 'provincias'));
    }


    public function update(Request $request)
    {
        $oldEvent = Event::where('id', $request->id)->value('place');
        $provincia = $request->place;

        if ($oldEvent != $provincia) {
            $newProvincia = Provincia::where('id', $provincia)->value('provincia');
            $provincia = $newProvincia;
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:30',
            'description' => 'required|string|max:100',
            'place' => 'required|string',
            'event_date' => 'required|date|after_or_equal:now',
            'status' => 'required|integer',
            'created_by' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            toastr()->error('¡Vaya! ¡Algo salió mal!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Event::where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'place' => $provincia,
            'event_date' => $request->event_date,
            'status' => $request->status,
            'created_by' => $request->created_by,
            'user_id' => $request->user_id
        ]);

        toastr()->success('¡Evento ' . $request->name . ' Actualizado!', 'Éxito');

        return redirect()->route('events.index');
    }

    public function show(Event $data): View
    {
        return view('events.show', compact('data'));
    }


    protected function removeEventFromList(Event $data)
    {
        try {
            $data->update([
                "removed" => true
            ]);
            
            toastr()->success('¡' . $data->name . ' fue eliminado de la lista!', 'Éxito');
            return redirect()->route('events.index');
        } catch (\Exception $e) {
            Log::error('Error en el proceso de eliminar del listado: ' . $e->getMessage());
            toastr()->error('¡No se ha podido eliminar el Evento ' . $data->name . '!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    protected function restoreEventToList(Event $data)
    {
        try {
            $data->update([
                "removed" => false
            ]);

            toastr()->success('¡' . $data->name . ' fue añadido a la lista!', 'Éxito');
            return redirect()->route('events.index');
        } catch (\Exception $e) {
            Log::error('Error en el proceso de añadir al listado: ' . $e->getMessage());
            toastr()->error('¡No se ha podido añadir el Evento ' . $data->name . '!', 'Error');
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Event $data)
    {
        try {
            $data->delete();
            toastr()->success('¡Evento Eliminado!', 'Éxito');
            return redirect()->route('events.index');
        } catch (\Exception $e) {
            toastr()->error('¡Ocurrió un error al eliminar el Evento!', 'Error');
            return redirect()->route('events.index');
        }
    }
}
