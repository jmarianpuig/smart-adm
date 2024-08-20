<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => ['required', 'unique:users', 'string', 'email', 'max:50', 'regex:/^.+@.+$/i'],
            'phone' => 'required|integer|digits:9',
            'password' => 'required|string|min:8|max:15',
            'created_by' => 'required|string',
            'created_by_id' => 'required|integer',
            'role' => 'required|integer'
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
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'Debe tener entre 8 y 15 caracteres.',
            'password.max' => 'Debe tener entre 8 y 15 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Por favor ingresa un email válido.',
            'email.unique' => 'El email ya está registrado.',
            'phone.min' => 'Introduce un teléfono válido.',
            'phone.max' => 'Introduce un teléfono válido.',
            'phone.digits' => 'El teléfono no es válido.',
            'phone.required' => 'El teléfono es obligatorio.',
            'role.required' => 'El rol es obligatorio.',
        ];
    }
}
