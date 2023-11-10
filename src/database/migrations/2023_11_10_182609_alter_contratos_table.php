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
        //Fazer um Schema para alterar a tabela contratos, modificando a coluna obersavacao para observacao
        Schema::table('contratos', function (Blueprint $table) {
            $table->renameColumn('obersavacao', 'observacao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Fazer um Schema para alterar a tabela contratos, modificando a coluna observacao para obersavacao
        Schema::table('contratos', function (Blueprint $table) {
            $table->renameColumn('observacao', 'obersavacao');
        });
    }
};
