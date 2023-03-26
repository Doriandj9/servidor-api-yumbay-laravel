<?php

namespace App\Utils;

use App\Models\Usuarios;

class Autentication {


    public static function verifyCredential(string $cedula, string $clave){
        $user = Usuarios::where('cedula','=',strtolower(trim($cedula)))->firstOrFail();

        if($user && password_verify($clave,$user->clave)){
            return true;
        }

        return false;
    }
}