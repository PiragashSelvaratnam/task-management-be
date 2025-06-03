<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::apiResource('tasks', TaskController::class);

    Route::put('/tasks/{task}/status', [TaskController::class, 'updateStatus']);

    Route::put('/tasks/{task}/assign', [TaskController::class, 'assignTask']);

    Route::get('/users', [UserController::class, 'index']);

});
