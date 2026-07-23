<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GastoPropuesto extends Model
{
    protected $table = 'gasto_propuesto';

    protected $fillable = [
        'categoria_id',
        'nombre',
        'precio_unitario',
        'cantidad',
        'total',
        'usuario_id',
        'votacion_abierta',
    ];

    protected $casts = [
        'precio_unitario' => 'float',
        'cantidad' => 'float',
        'total' => 'float',
        'votacion_abierta' => 'boolean',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function votos()
    {
        return $this->hasMany(VotoPropuesta::class, 'gasto_propuesto_id');
    }

    public function votosPositivos()
    {
        return $this->hasMany(VotoPropuesta::class, 'gasto_propuesto_id')->where('voto', 1);
    }

    public function votosNegativos()
    {
        return $this->hasMany(VotoPropuesta::class, 'gasto_propuesto_id')->where('voto', 0);
    }
    public function compradores()
    {
        return $this->hasMany(Comprador::class, 'gasto_propuesto_id');
    }
}
