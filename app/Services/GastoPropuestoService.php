<?php

namespace App\Services;

use App\DTOs\CreateGastoPropuestoDTO;
use App\DTOs\UpdateGastoPropuestoDTO;
use App\Models\GastoPropuesto;

class GastoPropuestoService
{
    public function create(CreateGastoPropuestoDTO $dto): GastoPropuesto
    {
        $data = $dto->toArray();
        $data['total'] = $dto->precio_unitario * $dto->cantidad;

        return GastoPropuesto::create($data);
    }

    public function update(GastoPropuesto $gastoPropuesto, UpdateGastoPropuestoDTO $dto): GastoPropuesto
    {
        if ($dto->hasChanges()) {
            $data = $dto->toArray();

            if ($dto->hasPrecioOCantidad()) {
                $precio = $dto->precio_unitario ?? $gastoPropuesto->precio_unitario;
                $cantidad = $dto->cantidad ?? $gastoPropuesto->cantidad;
                $data['total'] = $precio * $cantidad;
            }

            $gastoPropuesto->update($data);
        }

        return $gastoPropuesto->fresh();
    }

    public function delete(GastoPropuesto $gastoPropuesto): bool
    {
        return $gastoPropuesto->delete();
    }

    public function findById(int $id): ?GastoPropuesto
    {
        return GastoPropuesto::find($id);
    }

    public function findAll(): \Illuminate\Database\Eloquent\Collection
    {
        return GastoPropuesto::all();
    }
}