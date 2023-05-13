<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    use HasFactory;

    protected $fillable = [
        'hora','motivo_consulta','antecedentes_medicos','tratamiento_actual','alergias',
        'habitos_toxicos','otros_antecedentes'
    ];
}
