<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class SelectMunicipiosController extends Controller
{
    public function index(Request $request) {
        // dd($request);
        $provinciaId = $request->input('provincia');
        $municipios = Municipio::where('provincia_id', $provinciaId)->get();
        return response()->json($municipios);
    }
}
