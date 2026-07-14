<?php

namespace App\DTOs;

use App\Http\Requests\UpdateGastoPropuestoRequest;

class UpdateGastoPropuestoDTO
{
    public function __construct(
        public readonly ?int $categoria_id = null,
        public readonly ?string $nombre = null,
        public readonly ?float $precio_unitario = null,
        public readonly ?int $cantidad = null,
    ) {}

    public static function fromRequest(UpdateGastoPropuestoRequest $request): self
    {
        return new self(
            categoria_id: $request->has('categoria_id') ? (int) $request->validated('categoria_id') : null,
            nombre: $request->validated('nombre'),
            precio_unitario: $request->has('precio_unitario') ? (float) $request->validated('precio_unitario') : null,
            cantidad: $request->has('cantidad') ? (int) $request->validated('cantidad') : null,
        );
    }

    public function toArray(): array
    {
        $data = [
            'categoria_id' => $this->categoria_id,
            'nombre' => $this->nombre,
            'precio_unitario' => $this->precio_unitario,
            'cantidad' => $this->cantidad,
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
