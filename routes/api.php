<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\GastoPropuestoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VotoController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);

        Route::apiResource('usuarios', UsuarioController::class);
        Route::apiResource('categorias', CategoriaController::class)->only(['index', 'store']);
        Route::apiResource('gastos-propuestos', GastoPropuestoController::class);
        Route::post('gastos-propuestos/{gastoPropuesto}/votar', [VotoController::class, 'votar']);
    });

    Route::post('register', [AuthController::class, 'register']);
});
