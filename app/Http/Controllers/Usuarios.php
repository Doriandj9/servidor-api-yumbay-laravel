<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Models\Usuarios as ModelsUsuarios;
use App\Models\UsuariosEspecialidades;
use App\Utils\Autentication;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            $validator = null;
            if($rol === 'recepcionista'){
                $validator = Validator::make($request->all(),$requestS->rules2(),$requestS->messages());

            }else{
                $validator = Validator::make($request->all(),$requestS->rules(),$requestS->messages());

                if(!$request->hasFile('imagen')){
                    throw new ValidationException($validator);
                }
            }

            if($validator->fails()){
                throw new ValidationException($validator);
            }

            try {
                $opRol = preg_split('/:/',$roles[$rol]);
                $rolIn = $opRol[0];
                $permisos = $opRol[1];
                $data = null;
                $especialidades = null;
                $nameImg = $request->get('cedula'). '.' . $request->file('imagen')->extension();
                if($rol === 'recepcionista'){
                    $data = [
                        'cedula' => $request->get('cedula'),
                        'nombres' => $request->get('nombres'),
                        'apellidos' => $request->get('apellidos'),
                        'direccion' => $request->get('direccion'),
                        'telefono' => $request->get('telefono'),
                        'titulo' => $request->get('titulo'),
                        'celular'=> $request->get('celular'),
                        'email' => $request->get('correo'),
                        'imagen' => $nameImg,
                        'horario' => 'LUNES/VIERNES',
                        'contacto_emergencia' =>  'ninguno',
                        'clave' => password_hash($request->get('cedula'),PASSWORD_DEFAULT),
                        'rol' => $rolIn,
                        'permisos' => ModelsUsuarios::RECEPCIONISTA
                    ];
                }else{
                    $especialidades =  preg_split('/,/', $request->get('especialidades'));
                    $data = [
                        'cedula' => $request->get('cedula'),
                        'nombres' => $request->get('nombres'),
                        'apellidos' => $request->get('apellidos'),
                        'direccion' => $request->get('direccion'),
                        'telefono' => $request->get('telefono'),
                        'celular'=> $request->get('celular'),
                        'email' => $request->get('correo'),
                        'titulo' => $request->get('Doctor'),
                        'horario' => $request->get('dias') . '|' . $request->get('hora_ingreso')
                        . '-' . $request->get('hora_salida'),
                        'contacto_emergencia' =>  $request->get('numero_emergencia'),
                        'clave' => password_hash($request->get('cedula'),PASSWORD_DEFAULT),
                        'imagen' => $nameImg,
                        'rol' => $rolIn,
                        'permisos' => ModelsUsuarios::DOCTOR
                    ];
                }
                if(!Storage::disk('public')
                ->put($nameImg,file_get_contents($request->file('imagen')->getRealPath())))
                {
                    throw new \PDOException('Error al intentar guardar la imagen');
                }
                //create
                ModelsUsuarios::create($data);
                //code
                if($rol === 'medico'){
                    foreach($especialidades as $es){
                        $dataEs = [
                            'cedula_user' => $request->get('cedula'),
                            'id_especialidad' => intval($es)
                        ];
                        UsuariosEspecialidades::create($dataEs);
                    }
                }

                return response()
                ->json([
                    'ident' => 1,
                    'mensaje' => 'Se ingreso correctamente los datos.'
                ],201);
            } catch (\PDOException $er) {
                return response()
                ->json([
                    'ident' => 0,
                    'mensaje' => $er->getMessage(),
                    'atributos' => $er->errorInfo
                ]);
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

    public function getUserMedicos(){
        $medicos = ModelsUsuarios::where('permisos',ModelsUsuarios::DOCTOR)->get();
        return response()->json([
            'ident' => 1,
            'data' => $medicos
        ]);
    }
    public function getUserMedicosForEspecialdiad($id){
        $medicos = ModelsUsuarios::allMedicosForEspecialidad($id);
        return response()->json([
            'ident' => 1,
            'data' => $medicos
        ]);
    }
}
