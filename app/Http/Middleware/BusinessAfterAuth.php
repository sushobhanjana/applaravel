<?php

namespace App\Http\Middleware;

use Closure;

class BusinessAfterAuth
{
    public function handle($request, Closure $next)
    {
        // Perform action;
        $company_url=$request->session()->get('company_url');
        if (!$request->session()->has('company_email'))
        {

        	return redirect()->guest('business/');
        }
        return $next($request);
    }
}