<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoriaController;
use App\Http\Controllers\API\ProveedorController;
use App\Http\Controllers\API\ProductoController;
use App\Http\Controllers\API\MascotaController;
use App\Http\Controllers\API\CitaController;
use App\Http\Controllers\API\RecetaController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {

    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);

    Route::middleware(['auth:api', 'check.status'])->group(function () {
        Route::get('profile', [AuthController::class,'profile']);
        Route::post('logout', [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);
    });
});

/*
|--------------------------------------------------------------------------
| API PROTEGIDA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api', 'check.status'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | CATEGORIAS
    |--------------------------------------------------------------------------
    */

    Route::prefix('categorias')->group(function () {

        Route::middleware('role:admin,recepcionista')->group(function () {
            Route::get('', [CategoriaController::class, 'index']);
            Route::get('{id}', [CategoriaController::class, 'show']);
        });

        Route::middleware('role:admin')->group(function () {
            Route::post('', [CategoriaController::class, 'store']);
            Route::put('{id}', [CategoriaController::class, 'update']);
            Route::delete('{id}', [CategoriaController::class, 'destroy']);
        });

    });

    /*
    |--------------------------------------------------------------------------
    | PROVEEDORES
    |--------------------------------------------------------------------------
    */

    Route::prefix('proveedores')->group(function () {

        Route::middleware('role:admin,recepcionista')->group(function () {
            Route::get('', [ProveedorController::class, 'index']);
            Route::get('{id}', [ProveedorController::class, 'show']);
        });

        Route::middleware('role:admin')->group(function () {
            Route::post('', [ProveedorController::class, 'store']);
            Route::put('{id}', [ProveedorController::class, 'update']);
            Route::delete('{id}', [ProveedorController::class, 'destroy']);
        });

    });

    /*
    |--------------------------------------------------------------------------
    | PRODUCTOS
    |--------------------------------------------------------------------------
    */

    Route::prefix('productos')->group(function () {

        Route::middleware('role:admin,recepcionista')->group(function () {
            Route::get('', [ProductoController::class, 'index']);
            Route::get('{id}', [ProductoController::class, 'show']);
        });

        Route::middleware('role:admin')->group(function () {
            Route::post('', [ProductoController::class, 'store']);
            Route::put('{id}', [ProductoController::class, 'update']);
            Route::delete('{id}', [ProductoController::class, 'destroy']);
        });

    });

    /*
    |--------------------------------------------------------------------------
    | MASCOTAS
    |--------------------------------------------------------------------------
    */

    Route::prefix('mascotas')->group(function () {

        Route::middleware('role:admin,recepcionista')->group(function () {
            Route::get('', [MascotaController::class, 'index']);
            Route::get('{id}', [MascotaController::class, 'show']);
        });

        Route::middleware('role:admin')->group(function () {
            Route::post('', [MascotaController::class, 'store']);
            Route::put('{id}', [MascotaController::class, 'update']);
            Route::delete('{id}', [MascotaController::class, 'destroy']);
        });

    });

    /*
    |--------------------------------------------------------------------------
    | CITAS
    |--------------------------------------------------------------------------
    */

    Route::prefix('citas')->group(function () {

        Route::middleware('role:admin,recepcionista')->group(function () {
            Route::get('', [CitaController::class, 'index']);
            Route::get('{id}', [CitaController::class, 'show']);
        });

        Route::middleware('role:admin,recepcionista')->group(function () {
            Route::post('', [CitaController::class, 'store']);
            Route::put('{id}', [CitaController::class, 'update']);
            Route::delete('{id}', [CitaController::class, 'destroy']);
        });
    });
    

    /*
    |--------------------------------------------------------------------------
    | RECETAS
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:doctor,admin')->group(function () {
        Route::post('/recetas', [RecetaController::class, 'store']);
    });

});