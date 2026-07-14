<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $usuario = usuario::where('nombre', $request->input('nombre'))->first();

        if (! $usuario || ! Hash::check($request->input('password'), $usuario->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $token = $usuario->createToken('auth-token')->plainTextToken;

        return response()->json([
            'usuario' => $usuario,
            'token' => $token,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada']);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => 'required|string|unique:usuarios,nombre',
            'password' => 'required|string',
        ]);

        $usuario = usuario::create([
            'nombre' => $request->input('nombre'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json($usuario, 201);
    }
}
