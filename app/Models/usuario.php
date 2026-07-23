<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class usuario extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'password',
        'gasto',
        'habilitado',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed', // <-- ¡Magia! Laravel se encarga del bcrypt automáticamente
        'gasto' => 'float',
        'habilitado' => 'boolean',
    ];
    /**
     * Relación con la tabla intermedia de compradores.
     */
    public function gastosComprados(): HasMany
    {
        // Apuntamos a 'usuario' (minúscula) porque así se llama tu clase
        return $this->hasMany(Comprador::class, 'usuario_id');
    }
}
