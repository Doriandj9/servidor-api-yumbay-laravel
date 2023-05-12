<?php

namespace App\Http\Controllers;

use App\Utils\Reporte;
use Illuminate\Http\Request;

class Reportes extends Controller
{
    //
    public function reporte($fechaI,$fechaF,$especialidad){
        header('Access-Control-Allow-Origin: *');
        Reporte::reporteInicial($fechaI,$fechaF,$especialidad);
    }
}
