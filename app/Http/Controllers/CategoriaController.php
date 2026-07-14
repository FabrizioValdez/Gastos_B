<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Categoria::orderBy('nombre')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:50', 'unique:categorias,nombre'],
        ]);

        $categoria = Categoria::create(['nombre' => $request->nombre]);

        return response()->json($categoria, 201);
    }
}
