<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'cedula' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'direccion' => 'required',
            'telefono' => 'nullable',
            'celular'=> 'nullable',
            'correo' => 'required|email',
            'especialidades' => 'required',
            'horario' => 'required',
            'numero_emergencia' => 'required'
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
            'cedula.required' => 'Se requiere el número de cédula.',
            'nombres.required' => 'Se requiere los nombres.',
            'apellidos.required' => 'Se requiere los apellidos.',
            'direccion.required' => 'Se requiere la dirección.',
            'correo.required' => 'Se require un correo electronico.',
            'correo.email' => 'El correo electronico no es valido.',
            'especialidades.required' => 'Se requiere especialidades',
            'horario.required' => 'Se require un horario',
            'numero_emergencia.required' => 'Se requiere el número de emergencia',
        ];
    }

    
}
