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
        Schema::create('status_notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nota_id');
            $table->enum('status', ['Pago', 'Pendente']);
            $table->timestamps();

            $table->foreign('nota_id')->references('id')
                ->on('notasfiscais')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_notas');
    }
};
