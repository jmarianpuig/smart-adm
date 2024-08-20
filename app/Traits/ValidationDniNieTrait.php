<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

trait ValidationDniNieTrait
{
    // validación para formulario de padres
    public function validateDniNie(Request $request, MessageBag $validationErrors)
    {
        $dni_nie = $request->input('dni');

        if ($dni_nie) {
            if (preg_match('/^[0-9]{8}[A-HJ-NP-TV-Z]$/', $dni_nie)) {
                if (!$this->validarDigitoControlDNI($dni_nie)) {
                    $validationErrors->add('dni', 'El DNI no es válido');
                }
            } elseif (preg_match('/[XYZ][0-9]{7}[A-HJ-NP-TV-Z]/', $dni_nie)) {
                if (!$this->validarDigitoControlNIE($dni_nie)) {
                    $validationErrors->add('dni', 'El NIE no es válido');
                }
            } else {
                $validationErrors->add('dni', 'El número DNI/NIE no es válido');
            }
        }
    }

    //validacion update dni/nie
    public function validateDniNieUpdate($dni_nie)
    {
        if (preg_match('/^[0-9]{8}[A-HJ-NP-TV-Z]$/', $dni_nie)) {
            // Es un DNI
            if (!$this->validarDigitoControlDNI($dni_nie)) {
                return redirect()->back()->withErrors(['dni' => 'El dígito de control del DNI no es válido'])->withInput();
            }
        } elseif (preg_match('/[XYZ][0-9]{7}[A-HJ-NP-TV-Z]/', $dni_nie)) {
            // Es un NIE
            if (!$this->validarDigitoControlNIE($dni_nie)) {
                return redirect()->back()->withErrors(['dni' => 'El dígito de control del NIE no es válido'])->withInput();
            }
        } else {
            // No es ni un DNI ni un NIE válido
            return redirect()->back()->withErrors(['dni' => 'El número DNI/NIE ingresado no es válido'])->withInput();
        }
    }

    // mñetodos adiccionales
    private function validarDigitoControlDNI($dni_nie)
    {
        $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $numero = substr($dni_nie, 0, -1);
        $letra = strtoupper(substr($dni_nie, -1));

        $indice = $numero % 23;
        $digito_control = $letras[$indice];

        return $digito_control === $letra;
    }

    private function validarDigitoControlNIE($dni_nie)
    {
        $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $letra_inicial = strtoupper(substr($dni_nie, 0, 1));
        $numero = substr($dni_nie, 1, -1);
        $letra = strtoupper(substr($dni_nie, -1));
        $nie_numero = $letra_inicial === 'X' ? '0' . $numero : ($letra_inicial === 'Y' ? '1' . $numero : ($letra_inicial === 'Z' ? '2' . $numero : $dni_nie));

        $indice = intval($nie_numero) % 23;
        $digito_control = $letras[$indice];

        return $digito_control === $letra;
    }
}
