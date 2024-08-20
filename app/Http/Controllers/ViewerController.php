<?php

namespace App\Http\Controllers;

use App\Models\Viewer;
use Illuminate\Http\Request;

class ViewerController extends Controller
{
    public function __construct() {
        $this->middleware('permission:viewers.update', ['only' => ['update']]);
    }

    public function update(Request $request)
    {
        $viewerId = $request->input('viewer_id');
        $eventId = $request->input('event_id');
        $viewer = Viewer::find($viewerId);

        $is_selected = $viewer->events()->where('event_id', $eventId)->value('is_selected');

        if ($is_selected == 1) {
            $is_selected = 0;
        } else {
            $is_selected = 1;
        }

        $viewer->events()->updateExistingPivot($eventId, ['is_selected' => $is_selected]);
        toastr()->success('¡Participante modificado!');
        return redirect()->back();

    }


}
