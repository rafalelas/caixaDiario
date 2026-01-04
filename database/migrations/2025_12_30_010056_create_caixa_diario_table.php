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
        Schema::create('caixa_diario', function (Blueprint $table) {
            $table->id();
            $table->date('data');

            $table->decimal('maquina1', 10, 2)->default(0);
            $table->decimal('maquina2', 10, 2)->default(0);
            $table->decimal('maquina3', 10, 2)->default(0);
            $table->decimal('maquina4', 10, 2)->default(0);

            $table->decimal('dinheiro', 10, 2)->default(0);
            $table->decimal('total_taxas', 10, 2)->default(0);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caixa_diario');
    }
};
