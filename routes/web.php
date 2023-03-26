<?php

use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $viewData = [];
    $viewData['title'] = 'Tienda Onlinde | Inicio';
    return view('welcome')->with('viewData',$viewData);
})->name('inicio');

// Route::get('user/home',User::class . '@index')->name('user.home');
// Route::get('user/home/{id}',User::class . '@findOne')->name('user.one');
