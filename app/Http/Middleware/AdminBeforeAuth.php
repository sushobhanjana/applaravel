<?php

namespace App\Http\Middleware;

use Closure;

class AdminBeforeAuth
{
    public function handle($request, Closure $next)
    {
        // Perform action;
        if ($request->session()->has('admin_username'))
        {
        	return redirect()->guest('admin_dashboard');
        }
        return $next($request);
    }
}