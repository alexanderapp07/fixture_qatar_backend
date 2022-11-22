<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfederacionController;
use App\Http\Controllers\EstadisticaController;
use App\Models\Confederacion;

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

Route::apiResource('estadisticas', EstadisticaController::class);
//Route::post('estadisticas', [EstadisticaController::class, 'create']);