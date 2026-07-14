<?php

namespace App\DTOs;

use App\Http\Requests\UpdateGastoPropuestoRequest;

class UpdateGastoPropuestoDTO
{
    public function __construct(
        public readonly ?string $categoria = null,
        public readonly ?string $nombre = null,
        public readonly ?float $precio_unitario = null,
        public readonly ?int $cantidad = null,
        public readonly ?int $votos_positivos = null,
        public readonly ?int $votos_negativos = null,
    ) {}

    public static function fromRequest(UpdateGastoPropuestoRequest $request): self
    {
        return new self(
            categoria: $request->validated('categoria'),
            nombre: $request->validated('nombre'),
            precio_unitario: $request->has('precio_unitario') ? (float) $request->validated('precio_unitario') : null,
            cantidad: $request->has('cantidad') ? (int) $request->validated('cantidad') : null,
            votos_positivos: $request->has('votos_positivos') ? (int) $request->validated('votos_positivos') : null,
            votos_negativos: $request->has('votos_negativos') ? (int) $request->validated('votos_negativos') : null,
        );
    }

    public function toArray(): array
    {
        $data = [
            'categoria' => $this->categoria,
            'nombre' => $this->nombre,
            'precio_unitario' => $this->precio_unitario,
            'cantidad' => $this->cantidad,
            'votos_positivos' => $this->votos_positivos,
            'votos_negativos' => $this->votos_negativos,
        ];

        return array_filter($data, fn($value) => $value !== null);
    }

    public function hasChanges(): bool
    {
        return !empty($this->toArray());
    }

    public function hasPrecioOCantidad(): bool
    {
        return $this->precio_unitario !== null || $this->cantidad !== null;
    }
}
