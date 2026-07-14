<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GastoPropuestoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);

        Route::apiResource('usuarios', UsuarioController::class);
        Route::apiResource('gastos-propuestos', GastoPropuestoController::class);
    });

    Route::post('register', [AuthController::class, 'register']);
});
