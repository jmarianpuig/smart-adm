<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Xtra;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario está marcado como eliminado
        if ($user->removed) {
            Auth::logout(); // Cerrar sesión si está marcado como eliminado
            toastr()->error('Tu cuenta ha sido desactivada o eliminada.');
            return redirect()->route('login');
        }

        $actors = Actor::all();
        $extras = Xtra::all();

        return view('dashboard', compact('actors', 'extras'));
    }
}
