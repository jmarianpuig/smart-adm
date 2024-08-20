<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenorExtraUpdateRequest extends FormRequest
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
            'birthdate' => 'required|date|after:' . now()->subYears(16)->format('Y-m-d') . '|before_or_equal:today',
            'alias' => 'nullable|min:5|max:80',
            'ss' => 'nullable|digits:12',
            'phone' => 'nullable|digits:9',
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
            'has_car' => 'nullable',
            'is_disabled' => 'required',
            'is_retired' => 'nullable',
            'has_tattoos' => 'nullable',
            'availability' => 'required',
            'img1' => 'mimes:jpeg,jpg|max:2048',
            'img2' => 'mimes:jpeg,jpg|max:2048',
            'is_extra' => 'nullable',
            'url_book' => 'nullable|url|max:100',
            'dni' => 'required',
            'parents_name' => 'required|string|max:30',
            'parents_first_lname' => 'required|string|max:30',
            'parents_second_lname' => 'nullable|string|max:30',
            'parents_dni' => 'required|string|max:9',
            'parents_email' => ['required', 'string', 'email', 'max:50', 'regex:/^.+@.+$/i'],
            'parents_phone' => 'required|digits:9',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'Máximo de 20 caracteres.',
            'first_lname.required' => 'El apellido es obligatorio.',
            'first_lname.max' => 'Máximo de 20 caracteres.',
            'second_lname.max' => 'Máximo de 20 caracteres.',
            'alias.max' => 'Máximo de 80 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'Debe tener entre 8 y 15 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Por favor ingresa un email válido.',
            'email.unique' => 'El email ya está registrado.',
            'phone.min' => 'Introduce un teléfono válido.',
            'phone.max' => 'Introduce un teléfono válido.',
            'phone.digits' => 'El telefono no es válido.',
            'dni.required' => 'El DNI/NIE es obligatorio.',
            'dni.unique' => 'El DNI/NIE ya esta registrado.',
            'ss.digits' => 'Introduzca solo los numeros.',
            'ss.max' => 'No puede tener mas de :max caracteres.',
            'ss.min' => 'No puede tener menos de :min caracteres.',
            'provincia_id.required' => 'Seleccione una provincia.',
            'municipio_id.required' => 'Seleccione un municipio.',
            'adress.required' => 'La dirección es obligatoria.',
            'adress.min' => 'Mínimo de 5 caracteres.',
            'adress.max' => 'Máximo de 80 caracteres.',
            'zipCode.required' => 'El Código Postal es obligatorio.',
            'zipCode.between' => 'El Código Postal no válido.',
            'birthdate.required' => 'la fecha de nacimiento es obligatoria',
            'birthdate.after' => 'Error en la fecha. Tienes mas de 16 años.',
            'birthdate.before_or_equal' => 'La fecha de nacimiento no puede ser posterior a la actual.',
            'height.between' => 'La altura tiene que estar entre 50-220 cm.',
            'pant_size.required' => 'Seleccione una talla.',
            'shirt_size.required' => 'Seleccione una talla.',
            'shoe_size.required' => 'Seleccione una talla.',
            'eye_color.required' => 'Seleccione un color.',
            'study.required' => 'Seleccione nivel de estudios.',
            'race.required' => 'Seleccione una raza.',
            'url.max' => 'Máximo de 100 carácteres.',
            'url.url' => 'La url no es válida.',
            'availability.required' => 'Seleccione la disponibilidad.',
            'img1.required' => 'Es obligatorio imagen .JPG .JPEG (2Mb max).',
            'img2.required' => 'Es obligatorio imagen .JPG .JPEG (2Mb max).',
            'parents.name.required' => 'El nombre es obligatorio.',
            'parents.name.max' => 'Máximo de 30 caracteres.',
            'parents.first_lname.required' => 'El apellido 1 es obligatorio.',
            'parents.first_lname.max' => 'Máximo de 30 caracteres.',
            'parents.second_lname.max' => 'Máximo de 30 caracteres.',
            'parents.email.required' => 'El email es obligatorio.',
            'parents.email.email' => 'Por favor ingresa un email válido.',
            'parents.phone.min' => 'Introduce un teléfono válido.',
            'parents.phone.max' => 'Introduce un teléfono válido.',
            'parents.phone.digits' => 'El telefono no es válido.',
            'parents.dni.required' => 'El DNI/NIE es obligatorio.',
        ];
    }
}
