<?php
namespace App\Utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class TokenJWT {
    private const HASH = 'HS512';
    private const CLAVE = '0000000.CLINICA-YUMBAY';

    public static function encode($playload){
        return JWT::encode($playload,self::CLAVE,self::HASH);
    }
    public static function getKey() {

        return new Key(self::CLAVE,self::HASH);
    }
    public static function decode($token){
        return JWT::decode($token,self::getKey());
    }
}
