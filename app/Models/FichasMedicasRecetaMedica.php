<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichasMedicasRecetaMedica extends Model
{
    use HasFactory;
    protected $fillable = ['id_receta_medica','id_fichas_medicas'];

}
