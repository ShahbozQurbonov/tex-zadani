<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('user', [AuthController::class, 'getUser']);
Route::middleware('auth:api')->put('user', [AuthController::class, 'updateUser']);

Route::middleware('auth:api')->group(function () {
    Route::get('chats', [ChatController::class, 'index']);
    Route::post('chats', [ChatController::class, 'create']);
    Route::get('chats/{id}', [ChatController::class, 'show']);
    
    Route::get('chats/{id}/messages', [MessageController::class, 'index']);
    Route::post('chats/{id}/messages', [MessageController::class, 'store']);
});
