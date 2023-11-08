<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('painelcontrole', function (Blueprint $table) {
                $table->id();
                $table->string('contrato');
                $table->decimal('despesas', 10, 2);
                $table->decimal('recebimento', 10, 2);
                $table->decimal('a_receber_previsao', 10, 2);
                $table->decimal('valor_nf_emitida', 10, 2);
                $table->decimal('lucro', 10, 2);
                $table->decimal('imposto_previsto', 10, 2);
                $table->decimal('adm_fixo', 10, 2);
                $table->decimal('faturamento_total', 10, 2);
                $table->decimal('margem_lucro', 5, 2);
                $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('painelcontrole');
    }
};
