<?php

use App\Http\Controllers\Api\V1\ImagensController;
use App\Http\Controllers\Api\V1\PontosTuristicosController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    
    Route::middleware(['auth:sanctum', 'ability:user'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/imagens', [ImagensController::class, 'store']);
        Route::post('/imagens/{imagen}', [ImagensController::class, 'update']);
        Route::delete('/imagens/{imagen}', [ImagensController::class, 'destroy']);
        Route::get('/imagens', [ImagensController::class, 'index']);
        Route::get('/imagens/{imagen}', [ImagensController::class, 'show']);
    });
    Route::apiResource('users', UserController::class)->middleware(['auth:sanctum', 'ability:admin']);
    Route::apiResource('pontosturisticos', PontosTuristicosController::class);
    Route::post('/login', [AuthController::class, 'login']);
});