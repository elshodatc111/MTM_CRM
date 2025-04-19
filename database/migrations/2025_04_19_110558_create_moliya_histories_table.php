<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('moliya_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->enum('type', [
                'kassa_chiqim_naqt',
                'kassa_chiqim_pastik',
                'kassa_xarajat_naqt',
                'kassa_xarajat_plastik',
                'moliya_chiqim_pastik',
                'moliya_chiqim_naqt',
                'moliya_xarajat_naqt',
                'moliya_xarajat_plastik',
                'ish_haqi_naqt',
                'ish_haqi_plastik',
            ]);
            $table->enum('status', ['pedding', 'success'])->default('pedding');
            $table->unsignedBigInteger('start_meneger_id');
            $table->text('start_description')->nullable();
            $table->unsignedBigInteger('end_meneger_id')->nullable();
            $table->timestamps();
            $table->foreign('start_meneger_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('end_meneger_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void{
        Schema::dropIfExists('moliya_histories');
    }
};
