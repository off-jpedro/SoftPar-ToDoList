<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\SubTarefaController;

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

//Router Tarefas

Route::get('/tarefas', [TarefaController::class, 'index']);

Route::prefix('/tarefas')->group(function () {  
    Route::post('store', [TarefaController::class, 'store']);
    Route::put('/{id}', [TarefaController::class, 'update']);
    Route::delete('/{id}', [TarefaController::class, 'destroy']);  
});

//Router SubTarefas

Route::get('/subtarefas', [SubTarefaController::class, 'index']);

Route::prefix('/subtarefas')->group(function () {  
    Route::post('store', [SubTarefaController::class, 'store']);
    Route::put('/{id}', [SubTarefaController::class, 'update']);
    Route::delete('/{id}', [SubTarefaController::class, 'destroy']);  
});
