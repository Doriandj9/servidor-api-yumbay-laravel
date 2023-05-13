<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pacientes extends Model
{
    use HasFactory;
    protected $fillable = [
        'cedula','nombres','apellidos','direccion','celular','fecha_nacimiento',
        'email','clave'
    ];

    public static function getForDoctorAndEspecialidad($ci_doctor,$id_especialidad){
        $all = DB::table('pacientes')
        ->join('citas_medicas','citas_medicas.cedula_paciente','pacientes.cedula')
        ->orderBy('pacientes.cedula')
        ->get([
            'pacientes.cedula as cedula',
            'pacientes.nombres as nombres',
            'pacientes.apellidos as apellidos',
            'pacientes.celular as celular',
            'citas_medicas.id_especialidad as id_especialidad'
        ]);
        $result = [];
        foreach($all as $only) {
            $id = $only->id_especialidad;
            if(intval($id) === intval($id_especialidad)){
                $insert = true;
                foreach($result  as $init) {
                    if($init->cedula === $only->cedula){
                        $insert = false;
                        break;
                    }
                }
                if($insert){
                    array_push($result, $only);
                    $insert= true;
                }
            }
        }
        return $result;
    }

    
}
