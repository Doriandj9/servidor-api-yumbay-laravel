<?php

namespace App\Utils;

use App\Models\CitasMedicas;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\App;

class Reporte {

    public static function reporteInicial($fecha1=null,$fecha2=null,$especialidad)
    {
        $data = null;
        if($fecha1 === '0' && $fecha2 === '0' && $especialidad === '0'){
            $data = CitasMedicas::getDataForReportAll();
        }else{
            $data= CitasMedicas::getDataReportOnly($fecha1,$fecha2,$especialidad);
        }
        $html = file_get_contents(__DIR__. '/../../resources/views/layouts/layout_reporte.html');
        $html = preg_replace('/%title%/','Reporte FUNDACIÓN YUMBAY',$html);
        $trs = '';
        foreach($data as $dato){
            $trs .= "
            <tr>
                <td>$dato->cedula</td>
                <td>$dato->nombres ". preg_split('/ /',$dato->apellidos)[0] ."</td>
                <td>$dato->nombre_especialidad</td>
                <td>$dato->fecha</td>
                <td>$dato->nombres_doctor ". preg_split('/ /',$dato->apellidos_doctor)[0] ."</td>
            </tr>
            ";
        }
        $html = preg_replace('/%tbody%/',$trs,$html);
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $pdf = new Dompdf($options);
        $pdf->setPaper('A4','landscape');
        $pdf->loadHtml($html);
        $pdf->render();
        $date = new \DateTime();
        $time = $date->getTimestamp();
        header('Content-Type: application/pdf');
        header("Content-Disposition: inline; filename=Reporte-$time.pdf");
        // $pdf->stream('reporteComplet.pdf',['compress' => 1]);
        echo $pdf->output(['compress'=>1]);
        exit;
    }
}
