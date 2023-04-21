<?php

use App\Http\Controllers\Especialidades;
use App\Http\Controllers\Usuarios;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/aut',Usuarios::class . '@index')->name('aut');
Route::post('/aut',Usuarios::class . '@validation');
Route::post('/add/user/{rol}',Usuarios::class . '@insertNewUser');
Route::get('/especialidades',Especialidades::class . '@index');
Route::post('/add/especialidades',Especialidades::class . '@add');
Route::get('/users/medicos',Usuarios::class . '@getUserMedicos');
Route::get('/users/medicos/especialidad/{id}',Usuarios::class . '@getUserMedicosForEspecialdiad');
