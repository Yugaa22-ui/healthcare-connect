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
        // 1. Tangkap ID user DI AWAL sebelum logout diproses
        $userId = Auth::check() ? Auth::id() : null;

        // 2. Jalankan proses logout (atau aksi lainnya)
        $response = $next($request);

        // 3. Catat log setelah proses selesai
        try {
            \App\Models\ActivityLog::create([
                'user_id'     => $userId, 
                'action'      => $request->method() . ' ' . $request->path(),
                'description' => 'Akses sistem oleh ' . ($userId ? 'User ID: '.$userId : 'Guest'),
                'ip_address'  => $request->ip(),
            ]);
        } catch (\Exception $e) {
            // Jika pencatatan log gagal, jangan biarkan aplikasi utama error
            \Log::error('Gagal mencatat log: ' . $e->getMessage());
        }

        return $response;
    }
}