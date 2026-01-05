<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LogActivity
{
    // 1. Jalankan request tanpa hambatan
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    // 2. Catat log SETELAH respon dikirim ke User (Postman)
    public function terminate(Request $request, Response $response): void
    {
        try {
            // Cek apakah user terautentikasi (sebelum sesi hancur sepenuhnya)
            $userId = Auth::check() ? Auth::id() : null;

            \App\Models\ActivityLog::create([
                'user_id'     => $userId, 
                'action'      => $request->method() . ' ' . $request->path(),
                'description' => 'Status Respon: ' . $response->getStatusCode(),
                'ip_address'  => $request->ip(),
            ]);
        } catch (\Exception $e) {
            // Abaikan error agar tidak merusak pengalaman user
        }
    }
}