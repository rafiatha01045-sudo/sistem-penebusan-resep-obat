<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class KasirMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && (Auth::user()->role === 'kasir' || Auth::user()->role === 'admin')) {
            return $next($request);
        }
        
        return abort(403, 'Unauthorized access.');
    }
}
