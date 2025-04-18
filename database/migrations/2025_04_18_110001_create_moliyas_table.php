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
        Schema::create('moliyas', function (Blueprint $table) {
            $table->id();
            $table->integer('kassa_naqt');
            $table->integer('naqt_chiqim_pedding');
            $table->integer('naqt_xarajat_pedding');
            $table->integer('kassa_plastik');
            $table->integer('plastik_chiqim_pedding');
            $table->integer('plastik_xarajat_pedding');
            $table->integer('balans_naqt');
            $table->integer('balans_plastik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moliyas');
    }
};
