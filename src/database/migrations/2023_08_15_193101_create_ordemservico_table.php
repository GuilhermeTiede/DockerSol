<?php

use App\Models\Contrato;
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
        Schema::create('ordemservico', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Contrato::class)->constrained()->onDelete('cascade');
            $table->decimal('valorOrdemServico', 10, 2);
            $table->date('dataOrdemServico');
            $table->string('numeroOrdemServico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordemservico');
    }
};
