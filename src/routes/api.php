<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/users', [UsersController::class, 'index']);
Route::get('/user', [UsersController::class, 'fetch']);
Route::post('/user', [UsersController::class, 'create']);
Route::put('/user', [UsersController::class, 'update']);
Route::delete('/user', [UsersController::class, 'delete']);

Route::get('/tasks', [TasksController::class, 'index']);
// Route::get('/task', [TasksController::class, 'fetch']);
Route::post('/task', [TasksController::class, 'create']);
// Route::put('/task', [TasksController::class, 'update']);
Route::post('/task/assign', [TasksController::class, 'assignTask']);
