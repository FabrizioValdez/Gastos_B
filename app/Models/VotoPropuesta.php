<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
