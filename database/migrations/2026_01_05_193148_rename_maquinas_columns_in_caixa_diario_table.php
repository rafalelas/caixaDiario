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
        Schema::table('caixa_diario', function (Blueprint $table) {
            $table->renameColumn('maquina1', 'Stone1');
            $table->renameColumn('maquina2', 'Stone2');
            $table->renameColumn('maquina3', 'Cielo1');
            $table->renameColumn('maquina4', 'Cielo2');
            $table->renameColumn('maquina5', 'MercadoPago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('caixa_diario', function (Blueprint $table) {
            $table->renameColumn('Stone1', 'maquina1');
            $table->renameColumn('Stone2', 'maquina2');
            $table->renameColumn('Cielo1', 'maquina3');
            $table->renameColumn('Cielo2', 'maquina4');
            $table->renameColumn('MercadoPago', 'maquina5');
        });
    }
};
