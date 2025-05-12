<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware('auth:sanctum')->group(function () {
    // Leave Requests routes (only accessible by authenticated users)
    Route::get('/leave-requests', [LeaveRequestController::class, 'index']);
    Route::post('/leave-requests', [LeaveRequestController::class, 'store']);
    Route::get('/leave-requests/{id}', [LeaveRequestController::class, 'show']);
    Route::put('/leave-requests/{id}', [LeaveRequestController::class, 'update']);
    Route::delete('/leave-requests/{id}', [LeaveRequestController::class, 'destroy']);
    Route::patch('/leave-requests/{id}/status', [LeaveRequestController::class, 'updateStatus']);
    
    // Users route (accessible by authenticated users)
    Route::get('/users', [UserController::class, 'index']);
});

// Registration route (public access)
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);

// User route (to get user info for authenticated users)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
