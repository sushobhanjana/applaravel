<?php

namespace App\Http\Middleware;

use Closure;

class BusinessBeforeAuth
{
    public function handle($request, Closure $next)
    {
        // Perform action;
        if ($request->session()->has('company_email'))
        {
        	return redirect()->guest('business_dashboard');
        }
        return $next($request);
    }
}