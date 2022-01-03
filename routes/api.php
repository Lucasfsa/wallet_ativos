<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('categorias', \App\Http\Controllers\Api\CategoriaController::class)->only(['index'])->middleware('auth:sanctum');

Route::apiResource('ativos', \App\Http\Controllers\Api\AtivoController::class)->middleware('auth:sanctum');

Route::get('ativos/relatorios/geral', [\App\Http\Controllers\Api\AtivoController::class, 'porHistorico'])->middleware('auth:sanctum')->name('ativos.relatorios.geral');
Route::get('ativos/relatorios/categoria/{id}', [\App\Http\Controllers\Api\AtivoController::class, 'porCategoria'])->middleware('auth:sanctum')->name('ativos.relatorios.categoria');
Route::get('ativos/relatorios/ticker/{id}', [\App\Http\Controllers\Api\AtivoController::class, 'porTicker'])->middleware('auth:sanctum')->name('ativos.relatorios.ticker');
Route::get('ativos/relatorios/carteira', [\App\Http\Controllers\Api\AtivoController::class, 'distribuicaoCarteira'])->middleware('auth:sanctum')->name('ativos.relatorios.carteira');
Route::get('ativos/relatorios/carteira-diaria/{id}', [\App\Http\Controllers\Api\AtivoController::class, 'ditribuicaoDiaria'])->middleware('auth:sanctum')->name('ativos.relatorios.diaria');


Route::prefix('auth')->group(function()
    {
        Route::post('login',[\App\Http\Controllers\Auth\Api\LoginController::class, 'login'])->name('login');
        Route::post('logout',[\App\Http\Controllers\Auth\Api\LoginController::class, 'logout'])->middleware('auth:sanctum')->name('login.logout');
        Route::post('register',[\App\Http\Controllers\Auth\Api\RegisterController::class, 'register'])->name('register');

    });

