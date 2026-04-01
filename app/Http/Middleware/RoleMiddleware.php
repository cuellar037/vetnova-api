<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if(!$user){
            return response()->json([
                'message' => 'No Autenticado'
            ], 401);
        }

        if(!in_array($user->rol, $roles)){
            return response()->json([
                'message' => 'No tiene permisos de acceso'
            ], 403);
        }

        return $next($request);
    }
}
