<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\Usuarios as ModelsUsuarios;
use App\Utils\Autentication;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

    public function insertNewUser(Request $request,$rol){

        $requestS = new UserPostRequest();
        $roles = [
            'medico' => 'Doctor:' . ModelsUsuarios::ADMIN,
            'recepcionista' => 'Recepcionista:'. ModelsUsuarios::RECEPCIONISTA
        ];

        try {
            //code...
           $validator = Validator::make($request->all(),$requestS->rules(),$requestS->messages());
            if($validator->fails()){
                throw new ValidationException($validator);
            }
            try {
                $opRol = preg_split('/:/',$roles[$rol]);
                $rolIn = $opRol[0];
                $permisos = $opRol[1];
                $especialidades =  preg_split('/,/', $request->get('especialidades'));
                $data = [
                    'cedula' => $request->get('cedula'),
                    'nombres' => $request->get('nombres'),
                    'apellidos' => $request->get('apellidos'),
                    'direccion' => $request->get('direccion'),
                    'telefono' => $request->get('telefono'),
                    'celular'=> $request->get('celular'),
                    'correo' => $request->get('correo'),
                    'horario' => $request->get('horario'),
                    'numero_emergencia' =>  $request->get('numero_emergencia'),
                    'rol' => $rolIn,
                    'permisos' => intval($permisos)
                ];
                //create
                //code
                $das = [];
                foreach($especialidades as $es){
                    $dataEs = [
                        'cedula_user' => $request->get('cedula'),
                        'id_especialidad' => intval($es)
                    ];
                    array_push($das, $dataEs);
                }
                
                return response($das);
            } catch (\PDOException $er) {
                //throw $th;
            }
        } catch (ValidationException $e) {
            //throw $th;
            return response()->json([
                    'ident' => 0,
                    'mensaje' => $e->getMessage(),
                    'errores' => $e->errors()   
                ]
                );
        }
    }
}
