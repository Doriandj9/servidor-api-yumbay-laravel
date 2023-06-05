<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CitasMedicas extends Model
{
    use HasFactory;
    protected $fillable = ['fecha','hora','pendiente','id_especialidad','cedula_paciente','cedula_doctor'];


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
        $data = DB::table('pacientes')
        ->join('citas_medicas','citas_medicas.cedula_paciente','=','pacientes.cedula')
        ->where('citas_medicas.cedula_doctor','=',$cedula)
        ->where('citas_medicas.id_especialidad','=',$id_especialidad)
        ->where('citas_medicas.pendiente','=',true)
        ->orderBy('citas_medicas.fecha')
        ->get(['citas_medicas.hora as horas',
        'citas_medicas.fecha as fecha',
        'pacientes.nombres as nombres',
        'pacientes.apellidos as apellidos',
        'pacientes.cedula as cedula',
        'citas_medicas.id as id'
    ]);
        return $data;
    }

    public static function getOnlyPerson($cedula){
        $data = DB::table('citas_medicas')
        ->join('especialidades','especialidades.id','citas_medicas.id_especialidad')
        ->join('pacientes','pacientes.cedula','=','citas_medicas.cedula_paciente')
        ->where('cedula_paciente',$cedula)
        ->where('pendiente',true)
        ->orderByDesc('especialidades.created_at')
        ->get([
            'pacientes.nombres as nombres',
            'pacientes.apellidos as apellidos',
            'pacientes.cedula as cedula',
            'fecha','hora',
            'citas_medicas.id as id',
            'especialidades.nombre as nombre'
        ]);

        return $data;
    }
    public static function getDataForReportAll(){
        $data = DB::table('usuarios')
        ->join('usuarios_especialidades','usuarios_especialidades.cedula_user','=','usuarios.cedula')
        ->join('especialidades','especialidades.id','usuarios_especialidades.id_especialidad')
        ->join('citas_medicas','citas_medicas.id_especialidad','=','especialidades.id')
        ->join('pacientes','pacientes.cedula','=','citas_medicas.cedula_paciente')
        ->get([
        'pacientes.nombres as nombres',
        'pacientes.apellidos as apellidos',
        'pacientes.cedula as cedula',
        'usuarios.nombres as nombres_doctor',
        'usuarios.apellidos as apellidos_doctor',
        'especialidades.nombre as nombre_especialidad',
        'citas_medicas.fecha as fecha'
    ]);

    return $data;

    }

    public static function getDataReportOnly($fecha1=null,$fecha2=null,$especialidad=null){

            $data = DB::table('usuarios')
            ->join('usuarios_especialidades','usuarios_especialidades.cedula_user','=','usuarios.cedula')
            ->join('especialidades','especialidades.id','usuarios_especialidades.id_especialidad')
            ->join('citas_medicas','citas_medicas.id_especialidad','=','especialidades.id')
            ->join('pacientes','pacientes.cedula','=','citas_medicas.cedula_paciente');

            if($especialidad !== '0' && $especialidad !== null){
                $data = $data->where('especialidades.id','=', intval($especialidad));
            }
            if($fecha1 !== '0' && $fecha2 !== '0'){
                $data = $data->whereBetween('fecha',[$fecha1,$fecha2]);
            }
            $data = $data
            ->get([
                'pacientes.nombres as nombres',
                'pacientes.apellidos as apellidos',
                'pacientes.cedula as cedula',
                'usuarios.nombres as nombres_doctor',
                'usuarios.apellidos as apellidos_doctor',
                'especialidades.nombre as nombre_especialidad',
                'citas_medicas.fecha as fecha'
            ]);


    return $data;
    }

}

