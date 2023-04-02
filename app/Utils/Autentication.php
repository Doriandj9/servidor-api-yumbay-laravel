<?php

namespace App\Utils;

use App\Models\Usuarios;

class Autentication {


    public static function verifyCredential(string $cedula, string $clave, string $rol){
        $user = Usuarios::where('cedula','=',strtolower(trim($cedula)))->firstOrFail();

        if($user && password_verify($clave,$user->clave)){
           list($key,$valor) = preg_split('/:/',$rol);
           if($key === 'user' &&
           $user->permisos & intval($valor)
           ){
            $user->especialidad = '';
            return [
                'permisos' => intval($valor),
                'playload' => $user,
                'token' => TokenJWT::encode([$user])
            ];
           }else {
            $dataEs = Usuarios::allWhitEspecialidades($user->cedula);
            if(count($dataEs) <= 0){
                return false;
            }
            return [
                'permisos' => intval($valor),
                'playload' => $user,
                'token' => TokenJWT::encode([$user])
            ];
           }
        }

        return false;
    }
}
