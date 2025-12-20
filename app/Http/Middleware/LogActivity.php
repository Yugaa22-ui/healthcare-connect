<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Hanya catat aktivitas yang merubah data (POST, PUT, DELETE)
        if (in_array($request->method(), ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            \App\Models\ActivityLog::create([
                'user_id'    => auth()->id(), 
                'activity'   => 'User melakukan ' . $request->method() . ' pada ' . $request->path(),
                'method'     => $request->method(),
                'url'        => $request->fullUrl(),
                'ip_address' => $request->ip(),
            ]);
        }

        return $response;
    }
}
