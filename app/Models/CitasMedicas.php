<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CitasMedicas extends Model
{
    use HasFactory;
    protected $fillable = ['fecha','hora_inicio','hora_final','pendiente'];


    public static function getCitasMedicasForMedico($cedula,$fecha){
        $data = DB::table('usuarios')
        ->join('usuarios_especialidades','usuarios_especialidades.cedula_user','=','usuarios.cedula')
        ->join('especialidades','especialidades.id','usuarios_especialidades.id_especialidad')
        ->join('citas_medicas','citas_medicas.id_especialidad','=','especialidades.id')
        ->where('usuarios.cedula','=',$cedula)
        ->where('fecha','=',$fecha)
        ->get();

        return $data;
    }
}
