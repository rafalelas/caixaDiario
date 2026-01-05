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
            $table->decimal('maquina5', 10, 2)->default(0)->after('maquina4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('caixa_diario', function (Blueprint $table) {
            $table->dropColumn('maquina5');
        });
    }
};
