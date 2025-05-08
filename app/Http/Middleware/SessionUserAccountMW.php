<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class SessionUserAccountMW
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('user')) {
            return redirect()->route('login')->withErrors(['login' => 'Session expired. Please log in again.']);
        }

        return $next($request);
    }
}

