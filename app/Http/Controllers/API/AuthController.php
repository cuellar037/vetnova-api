<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Login: Metod for user authentication and token generation
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if($user && $user->estado === 'Inactivo'){
            return response()->json([
                'error' => 'Usuario inactivo, comuniquese con el administrador'
            ], 403);
        }
        
        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json([
                'error' => 'Credenciales incorrectas'
            ], 401);
        }
        
        return $this->respondWithToken($token);
    }

    // Register: Method for user registration
    public function register(RegisterRequest $request)
    {
        $request->validated();

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
            'rol' => $request->rol,
            'estado' => 'Activo'
        ]);

        return response()->json([
            'message'=> 'Usuario registrado correctamente', 
            'user' => $user
        ]);
    }

    // Profile: Method to get the authenticated user's profile information
    public function profile()
    {
        return response()->json([
            'id' => Auth::user()->id,
            'nombre' => Auth::user()->nombre,
            'apellido' => Auth::user()->apellido,
            'email' => Auth::user()->email,
            'direccion' => Auth::user()->direccion,
            'zona' => Auth::user()->zona,
            'telefono' => Auth::user()->telefono,
            'telefono_alt' => Auth::user()->telefono_alt,
            'rol' => Auth::user()->rol,
            'estado' => Auth::user()->estado,
        ]);
    }

    // Logout: Method for user logout and token invalidation
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Sesion cerrada correctamente']);
    }

    // Refresh: Method to refresh the JWT token
    public function refresh()
    {
        return $this->respondWithToken(
            JWTAuth::parseToken()->refresh()
        );
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
