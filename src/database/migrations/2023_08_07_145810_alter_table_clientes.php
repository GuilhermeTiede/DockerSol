<?php

use App\Models\Empresa;
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
        Schema::table('clientes', function (Blueprint $table) {
            $table->foreignIdFor(Empresa::class)->references('id')->on('empresas')->onDelete('CASCADE');
        });
        //Adiciona para mim nessa tabela mais colunas de dados de clientes

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clientes', function (Blueprint $table){
           $table->dropConstrainedForeignIdFor(Empresa::class);
        });
    }
};
