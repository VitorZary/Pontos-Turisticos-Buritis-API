<?php

use App\Http\Controllers\Api\V1\ImagensController;
use App\Http\Controllers\Api\V1\PontosTuristicosController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/imagens', [ImagensController::class, 'store']);
        Route::post('/imagens/{imagen}', [ImagensController::class, 'update']);
        Route::delete('/imagens/{imagen}', [ImagensController::class, 'destroy']);
    });
    
    Route::apiResource('pontosturisticos', PontosTuristicosController::class);
    Route::get('/imagens', [ImagensController::class, 'index']);
    Route::get('/imagens/{imagen}', [ImagensController::class, 'show']);
    Route::post('/login', [AuthController::class, 'login']);
});