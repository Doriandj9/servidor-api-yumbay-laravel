<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspecialidadesPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

        /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
            'dias' => 'required',
            'hora_ingreso' => 'required',
            'hora_salida' => 'required'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'Se require un nombre de especialidad',
            'descripcion.required' => 'Se requiere una descripción de la especialidad',
            'imagen.required' => 'Se require una imagen',
            'dias.required' => 'Se require los días laborables',
            'hora_ingreso.required' => 'Se require la hora de ingresos',
            'hora_salida.required' => 'Se require la hora de salida'
        ];
    }
}
