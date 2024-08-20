<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {

        if ($exception instanceof UnauthorizedException) {
            // Redirigir al índice con un mensaje de error opcional
            toastr()->error('¡No tienes permiso para realizar esta acción!', 'Error');
            return redirect()->back()->withInput();
            // return redirect()->route('dashboard')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        return parent::render($request, $exception);
    }
}
