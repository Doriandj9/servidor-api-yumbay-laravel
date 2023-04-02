<?php

use App\Http\Controllers\Especialidades;
use App\Http\Controllers\Usuarios;
use Illuminate\Http\Request;
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
Route::get('/especialidades',Especialidades::class . '@index');
