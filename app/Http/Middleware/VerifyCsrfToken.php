<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'admin_authentication',
        'register_business_data',
        'business_authentication',
        'business_forget_password',
        'check_otp',
        'business_reset_password',
        'admin_widgetaccess'
    ];
}
