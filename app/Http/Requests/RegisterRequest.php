<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dni'          => 'required|string|max:10|unique:usuarios,dni',
            'nombre'       => 'required|string|max:100',
            'apellido'     => 'required|string|max:100',
            'email'        => 'required|email|unique:usuarios,email',
            'password'     => 'required|min:6',
            'direccion'    => 'nullable|string|max:255',
            'zona'         => 'nullable|in:urbana,rural',
            'telefono'     => 'required|string|max:10',
            'telefono_alt' => 'nullable|string|max:10',
            'rol'          => 'required|in:admin,doctor,recepcionista,cliente',
        ];
    }

    // Custom error messages for validation
    public function messages(): array
    {
        return [
            'dni.required' => 'El DNI es obligatorio.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'dni.max' => 'El DNI no puede superar los 10 caracteres.',
            'dni.string' => 'El DNI debe ser una cadena de texto.',

            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',

            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.max' => 'El apellido no puede superar los 100 caracteres.',
            'apellido.string' => 'El apellido debe ser una cadena de texto.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo válido.',
            'email.unique' => 'Este correo ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.max' => 'El teléfono no puede superar los 10 caracteres.',
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',

            'telefono_alt.max' => 'El teléfono alternativo no puede superar los 10 caracteres.',
            'telefono_alt.string' => 'El teléfono alternativo debe ser una cadena de texto.', 

            'rol.required' => 'Debe seleccionar un rol.',
            'rol.in' => 'El rol seleccionado no es válido.',
        ];
    }
}
