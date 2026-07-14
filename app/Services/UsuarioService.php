<?php
namespace App\Services;
use App\DTOs\CreateUsuarioDTO;
use App\DTOs\UpdateUsuarioDTO;
use App\Models\usuario;
class UsuarioService
{
    public function create(CreateUsuarioDTO $dto): usuario
    {
        return usuario::create($dto->toArray());
    }
    public function update(usuario $usuario, UpdateUsuarioDTO $dto): usuario
    {
        if ($dto->hasChanges()) {
            $usuario->update($dto->toArray());
        }
        return $usuario->fresh();
    }
    public function delete(usuario $usuario): bool
    {
        return $usuario->delete();
    }
    public function findById(int $id): ?usuario
    {
        return usuario::find($id);
    }
    public function findAll(): \Illuminate\Database\Eloquent\Collection
    {
        return usuario::all();
    }
}