<?php

use App\Models\Categoria;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gasto_propuesto', function (Blueprint $table) {
            $table->foreignId('categoria_id')
                ->nullable()
                ->after('id')
                ->constrained('categorias')
                ->onDelete('set null');
            $table->dropColumn('categoria');
        });
    }

    public function down(): void
    {
        Schema::table('gasto_propuesto', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
            $table->string('categoria', 50);
        });
    }
};
