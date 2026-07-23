<?php

namespace App\Services;

use App\Models\Comprador;
use Illuminate\Database\Eloquent\Collection;

class CompradorService
{
    /**
     * Obtener todos los compradores con su usuario y los datos clave del gasto.
     */
    public function listarCompradores(): Collection
    {
        // Traemos solo 'id, nombre' del usuario y 'id, nombre, total' del gasto propuesto
        return Comprador::with([
            'usuario:id,nombre',
            'gastoPropuesto:id,nombre,total'
        ])->get(['id', 'usuario_id', 'gasto_propuesto_id']);
    }
    public function listarGastosPorUsuario(int $usuarioId): Collection
    {
        return Comprador::where('usuario_id', $usuarioId)
            ->with(['gastoPropuesto:id,nombre,total']) // Trae los datos del gasto relacionado
            ->get(['id', 'usuario_id', 'gasto_propuesto_id']);
    }

    /**
     * Registrar la relación entre un usuario y un gasto.
     */
    public function registrarComprador(array $data): Comprador
    {
        return Comprador::create([
            'usuario_id'         => $data['usuario_id'],
            'gasto_propuesto_id' => $data['gasto_propuesto_id'],
        ]);
    }
    public function eliminarComprador(int $id): bool
    {
        $comprador = Comprador::find($id);

        if (!$comprador) {
            return false;
        }

        return $comprador->delete();
    }
}
