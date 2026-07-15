<?php

namespace App\Http\Controllers;

use App\DTOs\CreateGastoPropuestoDTO;
use App\DTOs\UpdateGastoPropuestoDTO;
use App\Http\Requests\StoreGastoPropuestoRequest;
use App\Http\Requests\UpdateGastoPropuestoRequest;
use App\Models\GastoPropuesto;
use App\Services\GastoPropuestoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GastoPropuestoController extends Controller
{
    public function __construct(
        private readonly GastoPropuestoService $gastoPropuestoService,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->gastoPropuestoService->findAll());
    }

    public function store(StoreGastoPropuestoRequest $request): JsonResponse
    {
        $dto = CreateGastoPropuestoDTO::fromRequest($request, $request->user()->id);

        $gastoPropuesto = $this->gastoPropuestoService->create($dto);

        return response()->json($gastoPropuesto, 201);
    }

    public function show(GastoPropuesto $gastoPropuesto): JsonResponse
    {
        return response()->json($gastoPropuesto);
    }

    public function update(UpdateGastoPropuestoRequest $request, GastoPropuesto $gastoPropuesto): JsonResponse
    {
        // El DTO de actualización se encarga de su propia extracción
        $dto = UpdateGastoPropuestoDTO::fromRequest($request);
        
        $gastoPropuesto = $this->gastoPropuestoService->update($gastoPropuesto, $dto);
        
        return response()->json($gastoPropuesto);
    }

    public function destroy(GastoPropuesto $gastoPropuesto): JsonResponse
    {
        $this->gastoPropuestoService->delete($gastoPropuesto);
        
        return response()->json(null, 204);
    }

    public function toggleVotacion(Request $request, GastoPropuesto $gastoPropuesto): JsonResponse
    {
        if ($request->user()->id !== $gastoPropuesto->usuario_id) {
            return response()->json(['message' => 'Solo el creador del gasto puede cerrar o abrir la votación'], 403);
        }

        $gastoPropuesto->update([
            'votacion_abierta' => !$gastoPropuesto->votacion_abierta,
        ]);

        $gastoPropuesto->load(['categoria', 'votos.usuario']);
        $gastoPropuesto->loadCount(['votosPositivos', 'votosNegativos']);

        return response()->json($gastoPropuesto);
    }
}