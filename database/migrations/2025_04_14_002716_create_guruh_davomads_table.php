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
        Schema::create('guruh_davomads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guruh_id')->constrained('guruhs')->onDelete('cascade');
            $table->unsignedBigInteger('cheldren_id');
            $table->unsignedBigInteger('tarbiyachi_id');
            $table->unsignedBigInteger('katta_tarbiyachi_id');
            $table->date('days');
            $table->enum('status', ['true', 'false', 'pedding'])->default('pedding');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guruh_davomads');
    }
};
