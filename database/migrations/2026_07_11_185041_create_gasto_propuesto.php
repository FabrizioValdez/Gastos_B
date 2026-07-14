<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gasto_propuesto', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->string('nombre');
            $table->decimal('precio_unitario', 10, 2);
            $table->integer('cantidad');
            $table->decimal('total', 10, 2);
            $table->tinyInteger('votos_positivos');
            $table->tinyInteger('votos_negativos');
            $table->foreignId('usuario_id')
            ->constrained('usuarios')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gasto_propuesto');
    }
};
