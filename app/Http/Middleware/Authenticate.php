<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    // Override the redirectTo method to return null for API requests
    public function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            return null; // No redirigir, solo devolver un error JSON
        }
        return null; // No redirigir, solo devolver un error JSON
    }
}
