<?php

namespace App\Http\Controllers;

use App\Models\Especialidades as ModelsEspecialidades;
use Illuminate\Http\Request;


class Especialidades extends Controller
{
    //

    public function index(){
        try{
            $data = ModelsEspecialidades::all();
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

        if($request->hasFile('imagen')){
            return response('',200);
        }

        return response('',404);

    }
}
