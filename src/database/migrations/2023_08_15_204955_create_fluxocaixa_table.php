<?php

use App\Models\FontePagadora;
use App\Models\OrdemServico;
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
        Schema::create('fluxocaixas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ordemServico')->constrained('ordemservicos')->onDelete('cascade');
            $table->foreignId('id_fontePagadora')->constrained('fontepagadoras')->onDelete('cascade');
            $table->enum('tipo', ['entrada', 'saida']);
            $table->decimal('valor', 10, 2);
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fluxocaixa');
    }
};
