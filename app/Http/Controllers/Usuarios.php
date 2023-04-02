<?php

namespace App\Http\Controllers;

use App\Models\Usuarios as ModelsUsuarios;
use App\Utils\Autentication;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Usuarios extends Controller
{
    //
    private $data;

    public function __construct()
    {
        $this->data = new \stdClass;
    }

    public function index(){
        $usuarios = ModelsUsuarios::all();

        return response()->json([
            'usuarios' => $usuarios
        ]);
    }

    public function validation(Request $request){

        $cedula= $request->input('cedula');
        $clave = $request->input('clave');
        $rol = $request->input('rol');
        try {
            $playload = Autentication::verifyCredential($cedula,$clave,$rol);
            if($playload){

                return response()->json(
                    [
                        'ident' => 1,
                        'body' => $playload
                    ]
                    );
            }
            throw new ModelNotFoundException();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'ident' => 0,
                'mensaje' => 'Datos erroneos, cédula o contraseña incorrectos.'
            ]);
        }

    }
}
