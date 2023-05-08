<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitasMedicasPostRequest extends FormRequest
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
            'cedula' => 'required',
            'nombres' => 'required',
            'apellidos' => 'required',
            'direccion' => 'required',
            'correo' => 'required',
            'celular' => 'required',
            'fecha_nacimiento' => 'required',
            'edad' => 'required',
            'sexo' => 'required',
            'tratamiento' => 'required',
            'presion' => 'required',
            'frecuencia' => 'required',
            'respiracion' => 'required',
            'temperatura' => 'required',
            'cardiaco' => 'required',
            'pulmonar' => 'required',
            'medicamentos' => 'required'
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
            'cedula.required' => 'Se require la cédula',
            'nombres.required' => 'Se require los nombres',
            'apellidos.required' => 'Se require los apellidos ',
            'direccion.required' => 'Se require la direccion',
            'correo.required' => 'Se require el correo electronico',
            'celular.required' => 'Se require el número de celular',
            'fecha_nacimiento.required' => 'Se require la fecha de nacimiento',
            'edad.required' => 'Se require la edad',
            'sexo.required' => 'Se require el sexo',
            'antecedentes.required' => 'Se require los antecendentes médicos',
            'tratamiento.required' => 'Se require el tratamiento actual',
            'presion.required' => 'Se require la presión arterial',
            'frecuencia.required' => 'Se require la frecuencia cardiaca',
            'respiracion.required' => 'Se require la frecuencia respiratoria',
            'temperatura.required' => 'Se require la temperatura corporal',
            'cardiaco.required' => 'Se require la auscultación cardiaca',
            'pulmonar.required' => 'Se require auscultación pulmonar',
            'medicamentos.required' => 'Se require los medicamentos y tratamientos'
        ];
    }
}
