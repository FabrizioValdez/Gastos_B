<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VotoPropuesta extends Model
{
    protected $table = 'votos_propuesta';

    protected $fillable = [
        'usuario_id',
        'gasto_propuesto_id',
        'voto',
    ];

    protected $casts = [
        'voto' => 'integer',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(usuario::class, 'usuario_id');
    }
}
