<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gasto_propuesto', function (Blueprint $table) {
            $table->dropColumn(['votos_positivos', 'votos_negativos']);
        });

        Schema::create('votos_propuesta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')
                ->constrained('usuarios')
                ->onDelete('cascade');
            $table->foreignId('gasto_propuesto_id')
                ->constrained('gasto_propuesto')
                ->onDelete('cascade');
            $table->tinyInteger('voto')->comment('0 = negativo, 1 = positivo');
            $table->unique(['usuario_id', 'gasto_propuesto_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votos_propuesta');

        Schema::table('gasto_propuesto', function (Blueprint $table) {
            $table->json('votos_positivos')->default('[]');
            $table->json('votos_negativos')->default('[]');
        });
    }
};
