<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;
    protected $fillable = [
        'cedula','nombres','apellidos','direccion','celular','fecha_nacimiento',
        'email','clave'
    ];
}