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
        Schema::table('status_notas', function (Blueprint $table) {
            // Adicionar novas colunas
            $table->unsignedBigInteger('contrato_id')->nullable();
            $table->unsignedBigInteger('ordemservico_id')->nullable();
            $table->unsignedBigInteger('fontepagadora_id')->nullable();
            $table->date('data')->nullable();

            // Adicionar as chaves estrangeiras
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->foreign('ordemservico_id')->references('id')->on('ordemservicos');
            $table->foreign('fontepagadora_id')->references('id')->on('fontepagadoras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_notas', function (Blueprint $table) {
            // Remover as chaves estrangeiras
            $table->dropForeign(['contrato_id']);
            $table->dropForeign(['ordemservico_id']);
            $table->dropForeign(['fontepagadora_id']);

            // Remover as colunas adicionadas
            $table->dropColumn('contrato_id');
            $table->dropColumn('ordemservico_id');
            $table->dropColumn('fontepagadora_id');
            $table->dropColumn('data');
        });
    }
};
