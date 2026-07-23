<?php

namespace App\DTOs;

use App\Http\Requests\UpdateUsuarioRequest;

class UpdateUsuarioDTO
{
    public function __construct(
        public readonly ?string $nombre = null,
        public readonly ?string $password = null,
        public readonly ?float $gasto = null,
        public readonly ?bool $habilitado = null,
    ) {}

    /**
     * Factory Method para el controlador
     */
    public static function fromRequest(UpdateUsuarioRequest $request): self
    {
        return new self(
            nombre: $request->validated('nombre'),
            password: $request->validated('password'),
            // Evaluamos explícitamente la presencia para evitar problemas de tipos
            gasto: $request->has('gasto') ? (float) $request->validated('gasto') : null,
            habilitado: $request->has('habilitado') ? (bool) $request->validated('habilitado') : null,
        );
    }

    /**
     * Retorna solo los campos que no son NULL de forma segura
     */
    public function toArray(): array
    {
        $data = [
            'nombre' => $this->nombre,
            'password' => $this->password, // El modelo se encargará del hash automáticamente
            'gasto' => $this->gasto,
            'habilitado' => $this->habilitado,
        ];

        // Filtramos asegurando que NO elimine los valores 'false' o '0'
        return array_filter($data, fn($value) => $value !== null);
    }

    /**
     * Determina si el DTO contiene alguna actualización
     */
    public function hasChanges(): bool
    {
        return !empty($this->toArray());
    }
}