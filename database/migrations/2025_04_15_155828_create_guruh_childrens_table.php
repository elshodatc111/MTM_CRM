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
        Schema::create('guruh_childrens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guruh_id')->constrained('guruhs')->onDelete('cascade');
            $table->foreignId('children_id')->constrained('children')->onDelete('cascade');
            $table->date('start_date');
            $table->string('start_description');
            $table->foreignId('start_user_id')->constrained('users')->onDelete('cascade');
            $table->date('end_date');
            $table->string('end_description');
            $table->foreignId('end_user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['true', 'false'])->default('true');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guruh_childrens');
    }
};
