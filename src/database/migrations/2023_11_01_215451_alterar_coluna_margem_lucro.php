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
        Schema::table('painelcontrole', function (Blueprint $table) {
            $table->decimal('margem_lucro', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('painelcontrole', function (Blueprint $table) {
            $table->decimal('margem_lucro', 5, 2)->change();
        });
    }
};
