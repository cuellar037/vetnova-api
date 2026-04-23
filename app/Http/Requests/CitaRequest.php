<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
use app\Models\Mascota;

class CitaRequest extends FormRequest
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
            'cliente_id' => 'required|exists:usuarios,id',
            'mascota_id' => 'required|exists:mascotas,id',
            'doctor_id' => [
                'required', 
                Rule::exists('usuarios', 'id')->where(function($q){
                    $q->where('rol', 'doctor');
                }),
            ],
            'motivo' => 'required|string|max:255',
            'fecha_cita' => 'required|date', 
            'hora_cita' => 'required|date_format:H:i',
            'estado' => 'nullable|in:pendiente,agendada,cancelada,finalizada',

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){
            $hora = $this->hora_cita;
            
            // Validar que la hora esté en intervalos de 30 minutos
            if(!in_array(substr($hora, 3, 2), ['00', '30'])){
                $validator->errors()->add('hora_cita', 'La hora de la cita debe ser intervalos de 30 minutos.');
            }

            //Validar Citas Duplicadas
            $existe = \App\Models\Cita::where('doctor_id', $this->doctor_id)
                ->where('fecha_cita', $this->fecha_cita)
                ->where('hora_cita', $this->hora_cita)
                ->exists();

            if($existe){
                $validator->errors()->add('hora_cita', 'Ya existe una cita programada para esa hora.');
            }

        });
    }
}
 