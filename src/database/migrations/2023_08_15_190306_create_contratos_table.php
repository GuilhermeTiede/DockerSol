<?php

use App\Models\Cliente;
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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cliente::class)->constrained()->onDelete('cascade');
            $table->string('nomeContrato');
            $table->string('numeroContrato');
            $table->string('dataInicio');
            $table->string('dataFim');
            $table->string('valorContrato');
            $table->text('seguroGarantia')->default('Não');
            $table->text('responsabilidadeTecnica')->default('Não');
            $table->text('obersavacao')->nullable();
            $table->boolean('renovado')->nullable();
            $table->string('dataRenovacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
