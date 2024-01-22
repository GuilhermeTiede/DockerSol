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
            $table->decimal('despesas', 15, 2)->change();
            $table->decimal('recebimento', 15, 2)->change();
            $table->decimal('a_receber_previsao', 15, 2)->change();
            $table->decimal('valor_nf_emitida', 15, 2)->change();
            $table->decimal('lucro', 15, 2)->change();
            $table->decimal('imposto_previsto', 15, 2)->nullable()->change();
            $table->decimal('adm_fixo', 15, 2)->nullable()->change();
            $table->decimal('faturamento_total', 15, 2)->change();
            $table->decimal('margem_lucro', 15, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('painelcontrole', function (Blueprint $table) {
            $table->decimal('despesas', 10, 2)->change();
            $table->decimal('recebimento', 10, 2)->change();
            $table->decimal('a_receber_previsao', 10, 2)->change();
            $table->decimal('valor_nf_emitida', 10, 2)->change();
            $table->decimal('lucro', 10, 2)->change();
            $table->decimal('imposto_previsto', 10, 2)->nullable()->change();
            $table->decimal('adm_fixo', 10, 2)->nullable()->change();
            $table->decimal('faturamento_total', 10, 2)->change();
            $table->decimal('margem_lucro', 10, 2)->change();
        });
    }
};
