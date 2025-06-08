<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->age <= 18) {
            return response('Maaf, kamu belum cukup umur untuk mengakses halaman ini 😢', 403);
        }

        return $next($request);
    }
}
