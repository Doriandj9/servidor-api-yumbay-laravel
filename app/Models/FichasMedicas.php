<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichasMedicas extends Model
{

    use HasFactory;

    protected $fillable = [
        'cedula','nombres','apellidos','direccion','celular','fecha_nacimiento',
        'email','sexo','edad','estado_civil','fecha_control','hora_finalizacion',
        'cedula_paciente'
    ];

}
