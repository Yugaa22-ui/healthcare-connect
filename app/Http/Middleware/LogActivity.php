<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LogActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Ambil ID User di awal (antisipasi logout)
        // Gunakan try-catch kecil di sini jika Auth bermasalah
        $userId = null;
        try {
            if (Auth::check()) {
                $userId = Auth::id();
            }
        } catch (\Exception $e) {
            $userId = null;
        }

        // 2. Jalankan request utama
        $response = $next($request);

        // 3. Simpan Log (Hanya jika bukan method GET untuk mengurangi beban DB, optional)
        // Pastikan proses ini tidak menggagalkan response utama
        try {
            // Cek apakah class model ada untuk menghindari 'Class not found'
            if (class_exists('\App\Models\ActivityLog')) {
                \App\Models\ActivityLog::create([
                    'user_id'     => $userId, 
                    'action'      => $request->method() . ' ' . $request->path(),
                    'description' => 'Akses sistem: ' . $request->header('User-Agent'),
                    'ip_address'  => $request->ip(),
                ]);
            }
        } catch (\Exception $e) {
            // Jangan throw error, agar Dika tetap dapat response sukses di Postman
            \Log::warning('Log Activity Gagal: ' . $e->getMessage());
        }

        return $response;
    }
}