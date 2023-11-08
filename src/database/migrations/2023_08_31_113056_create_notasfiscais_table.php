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
        Schema::create('notasfiscais', function (Blueprint $table) {
            $table->id();
            $table->string('numeroNf');
            $table->date('dataEmissao');
            $table->date('dataPrevisaoPagamento');
            $table->string('mes');
            $table->string('exercicio');
            $table->float('valorTotal');
            $table->float('valorIss');
            $table->float('valorPis');
            $table->float('valorCofins');
            $table->float('valorInss');
            $table->float('valorIr');
            $table->float('valorCsll');
            $table->text('descricao');

            $table->string('cnpj_prestador');
//            $table->foreign('cnpj_prestador')->references('cnpj')->on('empresas');
            $table->string('nome_prestador');

            $table->string('cnpj_tomador')->nullable();
            $table->string('nome_tomador')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notasfiscais');
    }
};
