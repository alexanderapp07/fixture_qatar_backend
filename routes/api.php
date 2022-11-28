<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfederacionController;
use App\Http\Controllers\EstadisticaController;
use App\Models\Confederacion;
use App\Models\Estadio;
use App\Http\Controllers\EstadioController;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\PerfilController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('confederaciones', ConfederacionController::class);
Route::apiResource('estadios', EstadioController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('entrenadores', EntrenadorController::class);
Route::apiResource('perfiles', PerfilController::class);
Route::get('/calendario', [CalendarioController::class, 'index']);
Route::get('/maximos-goleadores', [EstadisticaController::class, 'maximosGoleadores']);
Route::get('/maximos-asistidores', [EstadisticaController::class, 'maximosAsistidores']);
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);


Route::apiResource('estadisticas', EstadisticaController::class);
//Route::post('estadisticas', [EstadisticaController::class, 'create']);