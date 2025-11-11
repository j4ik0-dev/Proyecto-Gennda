<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\API\UsuariosController;
use App\Http\Controllers\API\CategoriaController; // <-- Asegúrate que esté importado
use App\Http\Controllers\API\EventoController;    // <-- Asegúrate que esté importado
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rutas públicas de Autenticación
Route::post('/login', [UsuariosController::class, 'login']);
Route::post('/register', [UsuariosController::class, 'register']);


// Rutas protegidas (requieren token)
Route::middleware('auth:sanctum')->group(function () {
    
    // Rutas de Usuario
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [UsuariosController::class, 'logout']);
    Route::post('/perfil/foto', [UsuariosController::class, 'updatePhoto']); // Para la foto
    Route::put('/perfil', [UsuariosController::class, 'updateProfile']); // Para nombre, email, balance

    // Rutas de Categorías
    Route::apiResource('categorias', CategoriaController::class);

    // Rutas de Eventos
    Route::apiResource('eventos', EventoController::class);

});

