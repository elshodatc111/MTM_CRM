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
        Schema::create('guruh_techers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guruh_id')->constrained('guruhs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('start_date')->nullable();
            $table->text('start_description')->nullable();
            $table->unsignedBigInteger('start_meneger_id')->nullable();
            $table->date('end_date')->nullable();
            $table->text('end_description')->nullable();
            $table->unsignedBigInteger('end_meneger_id')->nullable();
            $table->enum('status', ['true', 'false', 'cancel'])->default('true');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guruh_techers');
    }
};
