<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GastoPropuesto extends Model
{
    protected $table = 'gasto_propuesto';

    protected $fillable = [
        'categoria',
        'nombre',
        'precio_unitario',
        'cantidad',
        'total',
        'votos_positivos',
        'votos_negativos',
        'usuario_id',
    ];

    protected $casts = [
        'precio_unitario' => 'float',
        'cantidad' => 'float',
        'total' => 'float',
        'votos_positivos' => 'integer',
        'votos_negativos' => 'integer',
    ];
}
