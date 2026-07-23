<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Importación recomendada

class Comprador extends Model
{
    protected $table = 'usuario_comprador';
    
    protected $fillable = [
        'usuario_id',
        'gasto_propuesto_id',
    ];

    public function usuario(): BelongsTo
    {
        // Cambiado de Usuario::class a usuario::class para que coincida con tu modelo
        return $this->belongsTo(usuario::class, 'usuario_id');
    }

    public function gastoPropuesto(): BelongsTo
    {
        return $this->belongsTo(GastoPropuesto::class, 'gasto_propuesto_id');
    }
}