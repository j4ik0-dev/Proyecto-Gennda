<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $usuario = Usuarios::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => '¡Usuario registrado exitosamente!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $usuario
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $usuario = Usuarios::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return response()->json([
                'message' => 'Las credenciales proporcionadas son incorrectas.'
            ], 401);
        }

        $usuario->tokens()->delete();
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => '¡Inicio de sesión exitoso!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $usuario
        ], 200);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada exitosamente.'
        ], 200);
    }



    public function index()
    {
        
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
