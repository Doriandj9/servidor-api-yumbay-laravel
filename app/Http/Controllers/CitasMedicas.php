<?php

namespace App\Http\Controllers;

use App\Models\CitasMedicas as ModelsCitasMedicas;
use Illuminate\Http\Request;

class CitasMedicas extends Controller
{
    public function index($id){

    }


    public function forEspecialiadAndMedico($cedula,$fecha){
        $data = ModelsCitasMedicas::getCitasMedicasForMedico($cedula,$fecha);

        return response()
        ->json([
            'ident' => 1,
            'citas' => $data
        ]);
    }

    public function save(Request $request){

        $controllerPacientes = new Pacientes;
        if(!$controllerPacientes->save($request,false)){
            //throw
        }

        $data = [
           'fecha' => $request->get('fecha'),
           'hora_inicio' => $request->get('fecha') . ' ' . $request->get('hora_inico'),
           'hora_final' => $request->get('fecha') . ' ' . $request->get('hora_final'),
           'pendiente' => true,
           'id_especialidad' => $request->get('especialidad'),
           'cedula_paciente' => $request->get('cedula')
        ];

        try{
            ModelsCitasMedicas::create($data);
            return response()
            ->json([
                'ident' => 1,
                'mensaje' => 'Se reservo su cita médica con exito.'
            ]);
        }catch(\PDOException $e) {
            return response()
            ->json([
                'ident' => 0,
                'mensaje' => $e->getMessage()
            ]);
        }
    }
}
