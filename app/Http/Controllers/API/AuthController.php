<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:6',
            'rol' => 'required'
        ]);

        $user = User::create([
            'dni' => $request->dni,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'direccion' => $request->direccion,
            'zona' => $request->zona,
            'telefono' => $request->telefono,
            'telefono_alt' => $request->telefono_alt,
            'rol' => $request->rol
        ]);

        return response()->json([
            'message'=> 'Usuario registrado correctamente', 
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json([
                'error' => 'Credenciales incorrectas'
            ], 401);
        }
        
        return $this->respondWithToken($token);
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => JWTAuth::setToken($token)->toUser()
        ]);
    }
}
