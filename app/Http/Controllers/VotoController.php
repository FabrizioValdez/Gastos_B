<?php

namespace App\Http\Controllers;

use App\Models\GastoPropuesto;
use App\Models\VotoPropuesta;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VotoController extends Controller
{
    public function votar(Request $request, GastoPropuesto $gastoPropuesto): JsonResponse
    {
        if (!$gastoPropuesto->votacion_abierta) {
            return response()->json(['message' => 'La votación está cerrada para este gasto'], 403);
        }

        $request->validate([
            'voto' => ['required', 'integer', 'in:0,1'],
        ]);

        $user = $request->user();

        $votoExistente = VotoPropuesta::where('usuario_id', $user->id)
            ->where('gasto_propuesto_id', $gastoPropuesto->id)
            ->first();

        if ($votoExistente) {
            if ((int) $votoExistente->voto === (int) $request->voto) {
                $votoExistente->delete();
            } else {
                $votoExistente->update(['voto' => $request->voto]);
            }
        } else {
            VotoPropuesta::create([
                'usuario_id' => $user->id,
                'gasto_propuesto_id' => $gastoPropuesto->id,
                'voto' => $request->voto,
            ]);
        }

        $gastoPropuesto->load(['categoria', 'votos.usuario']);
        $gastoPropuesto->loadCount(['votosPositivos', 'votosNegativos']);

        return response()->json($gastoPropuesto);
    }
}
