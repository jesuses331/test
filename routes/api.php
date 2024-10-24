<?php

use App\Http\Controllers\TareaController;
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

Route::post('/tareas', [TareaController::class, 'store']);
Route::get('/tareas', [TareaController::class, 'index']);
Route::get('/tareas/{id}', [TareaController::class, 'show']);
Route::put('/tareas/{id}', [TareaController::class, 'update']);

Route::delete('/tareas/{id}', [TareaController::class, 'destroy']);
