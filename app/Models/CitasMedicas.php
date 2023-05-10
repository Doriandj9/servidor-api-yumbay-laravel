<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CitasMedicas extends Model
{
    use HasFactory;
    protected $fillable = ['fecha','hora','pendiente','id_especialidad','cedula_paciente'];


    public static function getCitasMedicasForMedico($cedula,$fecha,$id_especialidad){
        $data = DB::table('usuarios')
        ->join('usuarios_especialidades','usuarios_especialidades.cedula_user','=','usuarios.cedula')
        ->join('especialidades','especialidades.id','usuarios_especialidades.id_especialidad')
        ->join('citas_medicas','citas_medicas.id_especialidad','=','especialidades.id')
        ->where('usuarios.cedula','=',$cedula)
        ->where('citas_medicas.fecha','=',$fecha)
        ->where('citas_medicas.id_especialidad','=',$id_especialidad)
        ->get(['citas_medicas.hora as horas']);

        return $data;
    }

    public static function getDataForEspecialidadAndDoctor($cedula,$id_especialidad){
        $data = DB::table('usuarios')
        ->join('usuarios_especialidades','usuarios_especialidades.cedula_user','=','usuarios.cedula')
        ->join('especialidades','especialidades.id','usuarios_especialidades.id_especialidad')
        ->join('citas_medicas','citas_medicas.id_especialidad','=','especialidades.id')
        ->join('pacientes','pacientes.cedula','=','citas_medicas.cedula_paciente')
        ->where('usuarios.cedula','=',$cedula)
        ->where('citas_medicas.id_especialidad','=',$id_especialidad)
        ->where('citas_medicas.pendiente','=',true)
        ->get(['citas_medicas.hora as horas',
        'citas_medicas.fecha as fecha',
        'pacientes.nombres as nombres',
        'pacientes.apellidos as apellidos',
        'pacientes.cedula as cedula',
        'citas_medicas.id as id'
    ]);
        return $data;
    }

}
