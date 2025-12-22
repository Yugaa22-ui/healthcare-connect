<?php

use App\Http\Controllers\Api\AuthController; // Tambahkan 'Api\' di sini
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AppointmentController;

// Endpoint Publik (Bisa diakses tanpa login)
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Endpoint Terproteksi (Wajib Login & Pakai Bearer Token)
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    // Resource dari Adji
    Route::apiResource('doctors', DoctorController::class);
    Route::apiResource('schedules', ScheduleController::class);
    
    // Resource dari Dika (Developer B) - Tambahkan ini nanti
    Route::apiResource('users', UserController::class);
    Route::post('appointments', [AppointmentController::class, 'store']); // Untuk Booking
    Route::get('appointments', [AppointmentController::class, 'index']);   // Untuk Lihat Daftar
    // Route::apiResource('appointments', AppointmentController::class);
});