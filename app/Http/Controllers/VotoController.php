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

        $gastoPropuesto->loadCount(['votosPositivos', 'votosNegativos']);

        return response()->json($gastoPropuesto);
    }
}
