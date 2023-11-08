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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_motorista')->constrained('motoristas')->onDelete('cascade');
            $table->string('placa', 7)->unique();
            $table->string('renavam', 11)->unique();
            $table->string('chassi', 17)->unique();
            $table->string('modelo')->nullable();
            $table->string('marca')->nullable();
            $table->string('ano')->nullable();
            $table->string('cor')->nullable();
            $table->string('tipoCombustivel')->nullable();
            $table->string('tipoVeiculo')->nullable();
            $table->string('categoriaVeiculo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
