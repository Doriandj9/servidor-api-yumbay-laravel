<?php

namespace App\Http\Controllers;

use App\Http\Requests\EspecialidadesPostRequest;
use App\Models\Especialidades as ModelsEspecialidades;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validato;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Especialidades extends Controller
{
    //

    public function index(){
        try{
            $data = ModelsEspecialidades::orderByDesc('created_at')->get();
            return response()->json(
                [
                    'ident' => 1,
                    'data' => $data
                ]
                );
        }catch(\PDOException $e){
            return response()->json(
                [
                    'ident' => 0,
                    'mensaje' => $e->getMessage()
                ]
                );
        }

    }

    public function add(Request $request){
        $requestValid = new EspecialidadesPostRequest();
        $validator = Validator::make($request->all(),$requestValid->rules(),$requestValid->messages());
        try {
            //code...
            if(!$request->hasFile('imagen')){
                throw new ValidationException($validator);
            }

            if($validator->fails()){
                throw new ValidationException($validator);
            }

            try {
                $nameImg = $request->get('nombre'). '.' . $request->file('imagen')->extension();
                if(!Storage::disk('public')
                ->put($nameImg,file_get_contents($request->file('imagen')->getRealPath())))
                {
                    throw new \PDOException('Error al intentar guardar la imagen');
                }
                ModelsEspecialidades::create(
                    [
                        'nombre' => $request->get('nombre'),
                        'descripcion' => $request->get('descripcion'),
                        'img' => asset('/storage/' . $nameImg)
                    ]
                );
                
                return response()->json([
                    'ident' => 1,
                    'mensaje' => 'Se ingreso correctamente los datos.'
                ]);
            } catch (\PDOException $ep) {
                return response()->json([
                    'ident' => 0,
                    'mensaje' => $ep->getMessage()
                ]);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'ident' => 0,
                'mensaje' => $e->getMessage(),
                'errores' => $e->errors()
            ]);
        }


        return response('',404);

    }
}
