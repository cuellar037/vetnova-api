<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoriaRequest extends FormRequest
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
            'nombre'        => 'required|string|max:255',
            'descripcion'   => 'nullable|string',
        ];
    }

    public function messages():array
    {
        return [
            'nombre.required'       => 'El nombre es obligatorio.',
            'nombre.string'         => 'El nombre debe ser una cadena de texto.',
            'nombre.max'            => 'El nombre no puede exceder los 255 caracteres.',
            'descripcion.string'    => 'La descripción debe ser una cadena de texto.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'success' => false,
                    'message' => 'Error de validación en Categoría.',
                    'errors' => $validator->errors()
                ], 422
            )
        );
    }
}
