<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fluxocaixas', function (Blueprint $table) {
            $table->date('data')->nullable();
        });
    }

    public function down()
    {
        Schema::table('fluxocaixas', function (Blueprint $table) {
            $table->dropColumn('data');
        });
    }
};
