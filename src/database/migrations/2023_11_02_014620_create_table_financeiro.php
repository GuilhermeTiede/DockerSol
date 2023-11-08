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
        Schema::create('financeiros', function (Blueprint $table) {
            $table->id();
            $table->string('mes')->nullable();
            $table->integer('ano')->nullable();
            $table->decimal('faturamento', 10, 2)->nullable();
            $table->decimal('recibemento', 10, 2)->nullable();
            $table->decimal('despesas', 10, 2)->nullable();
            $table->decimal('adm', 10, 2)->nullable();
            $table->decimal('percentual_adm', 10, 2)->nullable();
            $table->decimal('retirada', 10, 2)->nullable();
            $table->decimal('percentual_retirada', 10, 2)->nullable();
            $table->decimal('investimento', 10, 2)->nullable();
            $table->decimal('percentual_investimento', 10, 2)->nullable();
            $table->decimal('impostos_pagos', 10, 2)->nullable();
            $table->decimal('percentual_impostos_pagos', 10, 2)->nullable();
            $table->decimal('impostos_retidos', 10, 2)->nullable();
            $table->decimal('percentual_impostos_retidos', 10, 2)->nullable();
            $table->decimal('soma_percentual_impostos', 10, 2)->nullable();
            $table->decimal('lucro', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financeiros');
    }
};
