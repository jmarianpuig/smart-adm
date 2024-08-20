<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoordinatorUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'first_lname' => 'required|string|max:30',
            'second_lname' => 'nullable|string|max:30',
            'birthdate' => 'required|date|before:' . now()->subYears(16)->format('Y-m-d') . '|before_or_equal:today',
            'ss' => 'nullable|digits:12',
            'dni' => 'required',        
            'phone' => 'required|digits:9',
            'adress' => 'required|min:5|max:80',
            'zip_code' => 'required|numeric|between:1000,52999',
            'provincia' => 'required|numeric',
            'municipio' => 'required|numeric',
            'has_car' => 'required',
            'experience' => 'required',
            'move_to_work_id' => 'required',
            'img1' => 'mimes:jpeg,jpg|max:2048',
            'file1' => 'mimes:pdf|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'Máximo de 30 caracteres.',
            'first_lname.required' => 'El apellido 1 es obligatorio.',
            'first_lname.max' => 'Máximo de 30 caracteres.',
            'second_lname.max' => 'Máximo de 30 caracteres.',
            'birthdate.required' => 'la fecha de nacimiento es obligatoria',
            'birthdate.before' => 'Error en la fecha de nacimiento',
            'birthdate.before_or_equal' => 'Fecha incorrecta.',
            'ss.digits' => 'Introduzca solo los numeros, sin espacios ni guiones.',
            'ss.max' => 'No puede tener mas de :max caracteres.',
            'ss.min' => 'No puede tener menos de :min caracteres.',
            'provincia.required' => 'Seleccione una provincia.',
            'municipio.required' => 'Seleccione un municipio.',
            'adress.min' => 'Mínimo de 5 caracteres.',
            'adress.max' => 'Máximo de 80 caracteres.',
            'zip_code.between' => 'El Código Postal no es válido.',
            'zip_code.max' => 'El Código Postal no es válido.',
            'experience.required' => 'Selecione experiencia',
            'has_car.required' => 'Selecione vehículo',
            'move_to_work_id.required' => 'Seleciona desplazamiento',
            'img1.mimes' => 'Imagen no soportada. Solo JPG/JPEG',
            'img1.max' => 'El tamaño maximo permitido es de 2Mb',
            'file1.mimes' => 'Formato no soportado. Solo PDF',
            'file1.max' => 'El tamaño maximo permitido es de 2Mb',
            'dni.required' => 'Falta el DNI/NIE'
        ];
    }
}
