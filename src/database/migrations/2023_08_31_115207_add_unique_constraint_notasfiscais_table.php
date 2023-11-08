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
        Schema::table('notasfiscais', function (Blueprint $table) {
            $table->foreign('cnpj_prestador')->references('cnpj')->on('empresas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notasfiscais', function (Blueprint $table) {
            $table->dropForeign('notasfiscais_cnpj_prestador_foreign');
        });
    }
};
