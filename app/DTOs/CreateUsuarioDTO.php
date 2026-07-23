<?php

namespace App\DTOs;

use App\Http\Requests\StoreUsuarioRequest;

class CreateUsuarioDTO
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $password,
        public readonly float $gasto,
        public readonly bool $habilitado,
    ) {}

    public static function fromRequest(StoreUsuarioRequest $request): self
    {
        return new self(
            nombre: $request->validated('nombre'),
            password: $request->validated('password'),
            gasto: (float) ($request->validated('gasto') ?? 0.00),
            habilitado: (bool) ($request->validated('habilitado') ?? true),
        );
    }

    public function toArray(): array
    {
        return [
            'nombre' => $this->nombre,
            'password' => $this->password, // Ya no aplicamos bcrypt aquí
            'gasto' => $this->gasto,
            'habilitado' => $this->habilitado,
        ];
    }
}