<?php

use App\Http\Controllers\CitasMedicas;
use App\Http\Controllers\Especialidades;
use App\Http\Controllers\FichasMedicas;
use App\Http\Controllers\Pacientes;
use App\Http\Controllers\Reportes;
use App\Http\Controllers\Usuarios;
use Illuminate\Support\Facades\Artisan;
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
Route::get('/citas/medico/{cedula}/{fecha}/{especialidad}',CitasMedicas::class . '@forEspecialiadAndMedico');
Route::get('/info/paciente/{cedula}',Pacientes::class . '@hashPacienteOrInsert');
Route::post('/cita-medica/save',CitasMedicas::class . '@save');
Route::get('/agenda/cita-medica/{cedula}/{especialidad}',CitasMedicas::class . '@getForEspecialidad');
Route::post('/ficha-medica/save',FichasMedicas::class . '@save');
Route::get('/citas-medicas/estado/{id}',CitasMedicas::class . '@updateState');
Route::get('/doctor/{doctor}/pacientes/especialidad/{id}',Pacientes::class . '@getForEspecialidad');
Route::get('/doctor/fichas/medicas/{cedula}',FichasMedicas::class . '@getForPaciente');
Route::get('/citas-medicas/agendadas/{cedula}',CitasMedicas::class . '@getForPaciente');
Route::get('/reportes/{fechaI}/{fechaF}/{especialidad}',Reportes::class .'@reporte');
