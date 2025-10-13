<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FestivalController;
use App\Http\Controllers\Api\OrganizadorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/auth/signup', [AuthController::class, 'signup']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/festivals', [FestivalController::class, 'index']); // Consulta pública

// --- Rotas Protegidas ---
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn(Request $request) => $request->user());

    // CRUD de Organizadores
    Route::post('/organizers', [OrganizadorController::class, 'store']);

    // CRUD de Festivais
    Route::post('/festivals', [FestivalController::class, 'store']);
});