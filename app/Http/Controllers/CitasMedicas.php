<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pacientes as ControllersPacientes;
use App\Models\CitasMedicas as ModelsCitasMedicas;
use App\Models\Pacientes;
use Illuminate\Http\Request;

class CitasMedicas extends Controller
{
    public function index($id){

    }


    public function forEspecialiadAndMedico($cedula,$fecha,$especialidad){
        $data = ModelsCitasMedicas::getCitasMedicasForMedico($cedula,$fecha,intval($especialidad));

        return response()
        ->json([
            'ident' => 1,
            'citas' => $data
        ]);
    }

    public function save(Request $request){

        $controllerPacientes = new ControllersPacientes;
        $paciente = Pacientes::where('cedula',$request->get('cedula'))->first();

        if(!$paciente && !$controllerPacientes->save($request,false)){
            //throw
            return response()
            ->json([
                'ident' => 0,
                'mensaje' => 'Error al ingresar los datos, intentelo más tarde.'
            ]);
        }
        $data = [
           'fecha' => $request->get('fecha'),
           'hora' =>$request->get('horas'),
           'pendiente' => true,
           'id_especialidad' => intval($request->get('especialidad')),
           'cedula_paciente' => $request->get('cedula')
        ];
        try{
            ModelsCitasMedicas::create($data);
            return response()
            ->json([
                'ident' => 1,
                'mensaje' => 'Se reservo su cita médica con exito.',
            ]);
        }catch(\PDOException $e) {
            return response()
            ->json([
                'ident' => 0,
                'mensaje' => $e->getMessage()
            ]);
        }
    }

    public function getForEspecialidad($cedula,$especialidad){
        try{
            $data = ModelsCitasMedicas::getDataForEspecialidadAndDoctor($cedula,intval($especialidad));
            return response()
            ->json([
                'ident' => 1,
                'data' => $data,
            ]);
        }catch(\PDOException $e){
            return response()
            ->json([
                'ident' => 0,
                'mensaje' => $e->getMessage(),
            ]);
        }
    }
}
