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
        Schema::table('painelcontrole', function (Blueprint $table) {
            // Torna a coluna adm_fixo nullable
            $table->decimal('adm_fixo', 10, 2)->nullable()->change();

            // Torna a coluna imposto_previsto nullable
            $table->decimal('imposto_previsto', 10, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
