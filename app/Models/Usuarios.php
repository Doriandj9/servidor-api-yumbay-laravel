<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    public const ADMIN = 16;
    public const RECEPCIONISTA= 1;
    public const DOCTOR = 4;

    protected $fillable = [
        'cedula','nombres','apellidos','direccion','celular',
        'telefono','email','titulo','horario','contacto_emergencia',
        'clave','permisos'
    ];
}
