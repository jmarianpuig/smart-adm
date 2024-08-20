<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActorUpdateRequest extends FormRequest
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
            'alias' => 'nullable|min:5|max:80',
            'ss' => 'nullable|digits:12',
            'phone' => 'required|digits:9',
            'adress' => 'required|min:5|max:80',
            'zip_code' => 'required|numeric|between:1000,52999',
            'provincia' => 'required|numeric',
            'municipio' => 'required|numeric',
            'height' => 'required|numeric|between:50,220',
            'pant_size' => 'required',
            'shirt_size' => 'required',
            'shoe_size' => 'required',
            'eye_color' => 'required',
            'hair_color' => 'required',
            'study' => 'required',
            'race' => 'required',
            'has_car' => 'required',
            'is_disabled' => 'required',
            'is_retired' => 'required',
            'has_tattoos' => 'required',
            'availability' => 'required',
            'img1' => 'mimes:jpeg,jpg|max:2048',
            'img2' => 'mimes:jpeg,jpg|max:2048',
            'is_extra' => 'required',
            'url_book' => 'nullable|max:100',
            'skills' => 'nullable|max:200',
            'dni' => 'required'        
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
            'alias.max' => 'Máximo de 80 caracteres.',
            'alias.min' => 'Mínimo de 5 caracteres.',
            'ss.digits' => 'Introduzca solo los numeros, sin espacios ni guiones.',
            'ss.max' => 'No puede tener mas de :max caracteres.',
            'ss.min' => 'No puede tener menos de :min caracteres.',
            'is_retired' => 'Selecione una opción para la jubilación',
            'provincia.required' => 'Seleccione una provincia.',
            'municipio.required' => 'Seleccione un municipio.',
            'adress.min' => 'Mínimo de 5 caracteres.',
            'adress.max' => 'Máximo de 80 caracteres.',
            'zip_code.between' => 'El Código Postal no es válido.',
            'zip_code.max' => 'El Código Postal no es válido.',
            'height.between' => 'Altura entre 50-220 cm.',
            'pant_size.required' => 'Seleccione una talla.',
            'shirt_size.required' => 'Seleccione una talla.',
            'shoe_size.required' => 'Seleccione una talla.',
            'eye_color.required' => 'Seleccione un color.',
            'study.required' => 'Seleccione nivel de estudios.',
            'race.required' => 'Seleccione una raza.',
            'skills.max' => 'Máximo de 250 carácteres.',
            'url_book.max' => 'Máximo de 100 carácteres.',
            'url_book.url' => 'La url introducida no es correcta.',
            'availability.required' => 'Seleccione la disponibilidad.',
            'is_extra.required' => 'Selecciona una opción',
            'img1.mimes' => 'Imagen no soportada. Solo JPG/JPEG',
            'img2.mimes' => 'Imagen no soportada. Solo JPG/JPEG',
            'img1.max' => 'El tamaño maximo permitido es de 2Mb.',
            'img2.max' => 'El tamaño maximo permitido es de 2Mb.',
            'skills.max' => 'El tamaño maximo permitido es de 200 caracteres.',
            'dni.required' => 'Falta el DNI/NIE'
        ];
    }
}
