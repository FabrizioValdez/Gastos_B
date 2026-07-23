<?php

namespace App\Http\Controllers;

use App\Services\CompradorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompradorController extends Controller
{
    protected CompradorService $compradorService;

    // Inyectamos el servicio en el constructor
    public function __construct(CompradorService $compradorService)
    {
        $this->compradorService = $compradorService;
    }

    /**
     * Muestra la lista de usuarios y sus gastos relacionados.
     */
    public function index(): JsonResponse
    {
        $compradores = $this->compradorService->listarCompradores();

        return response()->json([
            'status' => 'success',
            'data'   => $compradores
        ], 200);
    }
    public function porUsuario(int $usuarioId): JsonResponse
    {
        $gastos = $this->compradorService->listarGastosPorUsuario($usuarioId);

        if ($gastos->isEmpty()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Este usuario no tiene gastos asociados todavía',
                'data'    => []
            ], 200);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $gastos
        ], 200);
    }

    /**
     * Almacena una nueva relación usuario-gasto.
     */
    public function store(Request $request): JsonResponse
    {
        // Validamos que los IDs existan en sus respectivas tablas
        $validated = $request->validate([
            'usuario_id'         => 'required|exists:usuarios,id',
            'gasto_propuesto_id' => 'required|exists:gasto_propuesto,id',
        ]);

        $comprador = $this->compradorService->registrarComprador($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Usuario asociado al gasto correctamente',
            'data'    => $comprador
        ], 201);
    }
    public function destroy(int $id): JsonResponse
    {
        $eliminado = $this->compradorService->eliminarComprador($id);

        if (!$eliminado) {
            return response()->json([
                'status'  => 'error',
                'message' => 'La relación no existe o ya fue eliminada'
            ], 404);
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Usuario desvinculado del gasto correctamente'
        ], 200);
    }
}
