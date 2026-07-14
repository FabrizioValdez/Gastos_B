<?php

namespace App\DTOs;

use App\Http\Requests\StoreGastoPropuestoRequest;

class CreateGastoPropuestoDTO
{
    public function __construct(
        public readonly int $categoria_id,
        public readonly string $nombre,
        public readonly float $precio_unitario,
        public readonly int $cantidad,
        public readonly int $usuario_id,
    ) {}

    public static function fromRequest(StoreGastoPropuestoRequest $request, int $usuario_id): self
    {
        return new self(
            categoria_id: (int) $request->validated('categoria_id'),
            nombre: $request->validated('nombre'),
            precio_unitario: (float) ($request->validated('precio_unitario') ?? 0.00),
            cantidad: (int) ($request->validated('cantidad') ?? 0),
            usuario_id: $usuario_id,
        );
    }

    public function toArray(): array
    {
        return [
            'categoria_id' => $this->categoria_id,
            'nombre' => $this->nombre,
            'precio_unitario' => $this->precio_unitario,
            'cantidad' => $this->cantidad,
            'usuario_id' => $this->usuario_id,
        ];
    }
}
