<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoriaController;
use App\Http\Controllers\API\ProveedorController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {

    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);

    Route::middleware('auth:api')->group(function () {

        Route::get('profile', [AuthController::class,'profile']);
        Route::post('logout', [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);

    });
});



Route::middleware(['auth:api'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | CATEGORIAS
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,recepcionista')->group(function () {
        Route::get('/categorias', [CategoriaController::class, 'index']);
        Route::get('/categorias/{id}', [CategoriaController::class, 'show']);
    });

    Route::middleware('role:admin')->group(function () {
        Route::post('/categorias', [CategoriaController::class, 'store']);
        Route::put('/categorias/{id}', [CategoriaController::class, 'update']);
        Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | PROVEEDORES
    |--------------------------------------------------------------------------
    */
    
    Route::middleware('role:admin,recepcionista')->group(function () {
        Route::get('/proveedores', [ProveedorController::class, 'index']);
        Route::get('/proveedores/{id}', [ProveedorController::class, 'show']);
    });

    
    Route::middleware('role:admin')->group(function () {
        Route::post('/proveedores', [ProveedorController::class, 'store']);
        Route::put('/proveedores/{id}', [ProveedorController::class, 'update']);
        Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy']);
    });


});

