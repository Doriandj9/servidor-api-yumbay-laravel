<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichasMedicasSignosVitales extends Model
{
    use HasFactory;
    protected $fillable = ['id_signos_vitales','id_fichas_medicas'];

}
