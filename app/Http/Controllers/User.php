<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;

class User extends Controller
{  
    private $viewData;
    public function __construct()
    {
        $this->viewData = new \stdClass;
    }
    public function index() {
        $title = 'Tienda Online | Usuarios | Home';
        $this->viewData->title = $title;
        // Usuarios::create(
        //     [
        //         'cedula' => '0250186665',
        //         'nombres' => 'Dorian Josue',
        //         'apellidos' => 'Armijos Gadvay',
        //         'direccion' => 'San Miguel',
        //         'celular' => '0989960587',
        //         'email' => 'dorian@admin.es',
        //         'titulo' => 'Ing. Software',
        //         'horario' => 'Lunes, Martes',
        //         'contacto_emergencia' => '0985562587',
        //         'clave' => password_hash('12345',PASSWORD_DEFAULT),
        //         'permisos' => 16
        //     ]
        // );
        $this->viewData->users = Usuarios::all();
        return view('users.home')->with('viewData',$this->viewData);
    }

    public function findOne($id){
        $user = Usuarios::findOrFail($id);
        $title = 'Tienda Online | Usuario ';
        $this->viewData->title = $title;
        $this->viewData->user = $user;
        return view('users.user')->with('viewData', $this->viewData);
    }
}
