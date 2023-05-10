<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FichasMedicas extends Model
{

    use HasFactory;

    protected $fillable = [
        'cedula','nombres','apellidos','direccion','celular','fecha_nacimiento',
        'email','sexo','edad','estado_civil','fecha_control','hora_finalizacion',
        'unidad_operativa', 'id_especialidad', 'cedula_paciente'
    ];

    public static function getForPaciente($cedula){
        $data = DB::table('pacientes')
        ->join('fichas_medicas','fichas_medicas.cedula_paciente','=','pacientes.cedula')
        ->join('fichas_medicas_signos_vitales','fichas_medicas_signos_vitales.id_fichas_medicas','=','fichas_medicas.id')
        ->join('signos_vitales','signos_vitales.id','=','fichas_medicas_signos_vitales.id_signos_vitales')
        ->join('fichas_medicas_historia_clinicas','fichas_medicas_historia_clinicas.id_fichas_medicas','=','fichas_medicas.id')
        ->join('historia_clinicas','historia_clinicas.id','=','fichas_medicas_historia_clinicas.id_historia_clinica')
        ->join('fichas_medicas_receta_medicas','fichas_medicas_receta_medicas.id_fichas_medicas','=','fichas_medicas.id')
        ->join('receta_medicas','receta_medicas.id','=','fichas_medicas_receta_medicas.id_receta_medica')
        ->where('pacientes.cedula','=',$cedula)
        ->get()
        ;


        return $data;
    }
}
