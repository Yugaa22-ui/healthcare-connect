<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Contoh Route yang diproteksi (Hanya bisa diakses jika sudah login/punya token)
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('doctors', DoctorController::class);
    // Adji & Andika masukkan route CRUD mereka di bawah sini
});