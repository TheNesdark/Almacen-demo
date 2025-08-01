<?php

use App\Http\Controllers\Api\FabricanteController;
use App\Http\Controllers\Api\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas públicas de la API
Route::prefix('v1')->middleware('throttle:60,1')->group(function () {
    // Fabricantes
    Route::apiResource('fabricantes', FabricanteController::class);
    
    // Productos
    Route::apiResource('productos', ProductoController::class);
    
    // Rutas adicionales
    Route::get('fabricantes/{fabricante}/productos', function ($fabricante) {
        $fabricanteModel = \App\Models\Fabricante::findOrFail($fabricante);
        $productos = $fabricanteModel->productos()->paginate(15);
        return \App\Http\Resources\ProductoResource::collection($productos);
    });
});

// Rutas protegidas (requieren autenticación)
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    // Aquí puedes agregar rutas que requieran autenticación
    // Por ejemplo: estadísticas, reportes, etc.
});