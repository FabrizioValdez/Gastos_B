<?php

namespace App\Http\Controllers;

use App\DTOs\CreateUsuarioDTO;
use App\DTOs\UpdateUsuarioDTO;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\usuario;
use App\Services\UsuarioService;
use Illuminate\Http\JsonResponse;

class UsuarioController extends Controller
{
    public function __construct(
        private readonly UsuarioService $usuarioService,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->usuarioService->findAll());
    }

    public function store(StoreUsuarioRequest $request): JsonResponse
    {
        // El DTO se construye a sí mismo de forma limpia
        $dto = CreateUsuarioDTO::fromRequest($request);
        
        $usuario = $this->usuarioService->create($dto);
        
        return response()->json($usuario, 201);
    }

    public function show(usuario $usuario): JsonResponse
    {
        return response()->json($usuario);
    }

    public function update(UpdateUsuarioRequest $request, usuario $usuario): JsonResponse
    {
        // El DTO de actualización se encarga de su propia extracción
        $dto = UpdateUsuarioDTO::fromRequest($request);
        
        $usuario = $this->usuarioService->update($usuario, $dto);
        
        return response()->json($usuario);
    }

    public function destroy(usuario $usuario): JsonResponse
    {
        $this->usuarioService->delete($usuario);
        
        return response()->json(null, 204);
    }
}