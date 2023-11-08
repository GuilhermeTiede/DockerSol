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
        Schema::table('contasapagar', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ordemServico')->nullable();
            $table->unsignedBigInteger('id_fontePagadora')->nullable();


             $table->foreign('id_ordemServico')->references('id')->on('ordemservicos');
             $table->foreign('id_fontePagadora')->references('id')->on('fontepagadoras');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contas_a_pagar', function (Blueprint $table) {

            $table->dropColumn('id_ordemServico');
            $table->dropColumn('id_fontePagadora');

             $table->dropForeign(['id_ordemServico']);
             $table->dropForeign(['id_fontePagadora']);
        });
    }
};
