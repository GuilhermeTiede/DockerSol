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
        Schema::create('documentoscontratos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Contrato::class)->constrained()->onDelete('cascade');
            $table->string('nomeDocumento');
            $table->string('dataDocumento');
            $table->string('dataVencimento')->nullable();
            $table->string('tipoDocumento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentoscontratos');
    }
};
