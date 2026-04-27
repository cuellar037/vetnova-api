<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecetaRequest extends FormRequest
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
            'cita_id' => 'required|exists:citas,id',
            'observaciones' => 'nullable|string',
            'detalles' => 'required|array|min:1',
            'detalles.*.tipo' => 'required|in:medicamento,examen,procedimiento',
            'detalles.*.producto_id' => 'nullable|exists:productos,id',
            'detalles.*.descripcion' => 'nullable|string',
            'detalles.*.cantidad' => 'nullable|integer|min:1',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $cita = \App\Models\Cita::find($this->cita_id);

            if ($cita && $cita->receta) {
                $validator->errors()->add('cita_id', 'Esta cita ya tiene una receta.');
            }

            if ($cita && $cita->estado !== 'finalizada') {
                $validator->errors()->add('cita_id', 'La cita debe estar finalizada.');
            }

            foreach ($this->detalles as $i => $detalle) {

                if ($detalle['tipo'] === 'medicamento' && empty($detalle['producto_id'])) {
                    $validator->errors()->add("detalles.$i.producto_id", 'Requerido para medicamento.');
                }

                if (in_array($detalle['tipo'], ['examen','procedimiento']) && empty($detalle['descripcion'])) {
                    $validator->errors()->add("detalles.$i.descripcion", 'Requerido para este tipo.');
                }
            }
        });
    }
}
