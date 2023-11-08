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
        Schema::create('atestadostecnicos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Contrato::class)->constrained('contratos')->onDelete('cascade');
            $table->enum('tipo', ['civil', 'tecnico', 'ambiental']);
            $table->string('nomeResponsavel');
            $table->string('numeroArt');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atestadostecnicos');
    }
};
