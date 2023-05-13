<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
    use HasFactory;
    protected $fillable = [
        'talla','peso','temperatura','frecuencia_respiratoria','frecuencia_cardiaca',
        'presion_arterial','auscultacion_cardiaca','auscultacion_pulmonar','otros_hallazgos'
    ];
}
