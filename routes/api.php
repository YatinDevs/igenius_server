<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']); // ADD THIS

// Protected routes
Route::middleware('auth.cookie')->group(function () {
    // Auth routes
    Route::get('/check-auth', [AuthController::class, 'checkAuth']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user', [AuthController::class, 'user']);
    
    // Admin routes (admin only)
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::post('/create-admin', [AuthController::class, 'createAdminUser']);
        Route::get('/users', [AdminController::class, 'getUsers']);
        Route::get('/users/{id}', [AdminController::class, 'getUser']);

        Route::post('/users', [AdminController::class, 'createUser']);
        Route::put('/users/{id}', [AdminController::class, 'updateUser']);
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser']);
         Route::get('/stats', [AdminController::class, 'getStats']);
       
    });
});