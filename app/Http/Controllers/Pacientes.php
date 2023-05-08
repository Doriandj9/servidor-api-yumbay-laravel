<?php

namespace App\Http\Controllers;

use App\Models\Pacientes as ModelsPacientes;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class Pacientes extends Controller
{
    //

    public function index(){

    }

    public function save(Request $request, bool $peticion = true ){
        $data = [
            'cedula' => $request->get('cedula'),
            'nombres' => $request->get('nombres'),
            'apellidos' => $request->get('apellidos'),
            'direccion' => $request->get('direccion'),
            'celular' => $request->get('celular'),
            'fecha_nacimiento' => $request->get('fecha_nacimiento'),
            'email' => $request->get('correo'),
            'clave' => '1234'
        ];
        try {
            $paciente =ModelsPacientes::where('cedula',$request->get('cedula'))->first();
            if($paciente){
                return response()
                ->json([
                    'ident' => 1,
                    'mensaje' => 'Se ingreso correctamente los datos'
                ]);
            }else{
                ModelsPacientes::create($data);
            }
            if($peticion){
                return response()
                ->json([
                    'ident' => 1,
                    'mensaje' => 'Se ingreso correctamente los datos'
                ]);
            }
            return true;

        } catch (\PDOException $e) {
            if($peticion){
                return response()
                ->json([
                    'ident' => 0,
                    'mensaje' => $e->getMessage()
                ]);
            }

            return false;
        }
    }


    public function hashPacienteOrInsert($cedula){

        $data = ModelsPacientes::where('cedula',$cedula)->first();
        if(!$data) {
            return response()
            ->json([
                'ident' => 0,
                'mensaje' => 'No existe el paciente'
            ]);
        }

        return response()
        ->json([
            'ident' => 1,
            'paciente' => $data
        ]);
    }

}
