<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'loginEnd',
        'registerloginEnd',
        'loginViaOtpEnd',
        'forgot_password',
        'customer/send-otp-for-login',
        'customer/otp-verify',
        'customer/update-account',
    ];
}
