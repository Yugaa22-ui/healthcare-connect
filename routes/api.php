<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Contoh Route yang diproteksi (Hanya bisa diakses jika sudah login/punya token)
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    // Adji & Andika masukkan route CRUD mereka di bawah sini
});