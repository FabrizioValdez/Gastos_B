<?php

namespace App\DTOs;

use App\Http\Requests\StoreGastoPropuestoRequest;

class CreateGastoPropuestoDTO
{
    public function __construct(
        public readonly string $categoria,
        public readonly string $nombre,
        public readonly float $precio_unitario,
        public readonly int $cantidad,
        public readonly int $votos_positivos,
        public readonly int $votos_negativos,
        public readonly int $usuario_id,
    ) {}

    public static function fromRequest(StoreGastoPropuestoRequest $request, int $usuario_id): self
    {
        return new self(
            categoria: $request->validated('categoria'),
            nombre: $request->validated('nombre'),
            precio_unitario: (float) ($request->validated('precio_unitario') ?? 0.00),
            cantidad: (int) ($request->validated('cantidad') ?? 0),
            votos_positivos: (int) ($request->validated('votos_positivos') ?? 0),
            votos_negativos: (int) ($request->validated('votos_negativos') ?? 0),
            usuario_id: $usuario_id,
        );
    }

    public function toArray(): array
    {
        return [
            'categoria' => $this->categoria,
            'nombre' => $this->nombre,
            'precio_unitario' => $this->precio_unitario,
            'cantidad' => $this->cantidad,
            'votos_positivos' => $this->votos_positivos,
            'votos_negativos' => $this->votos_negativos,
            'usuario_id' => $this->usuario_id,
        ];
    }
}
