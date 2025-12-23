<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class LogActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Gunakan path lengkap agar tidak ada error 'Undefined Class'
        \App\Models\ActivityLog::create([
            // Jika belum login (saat proses login), user_id diisi NULL
            'user_id'     => Auth::check() ? Auth::id() : null, 
            'action'      => $request->method() . ' ' . $request->path(),
            'description' => 'Akses dari IP: ' . $request->ip(),
            'ip_address'  => $request->ip(),
        ]);

        return $response;
    }
}