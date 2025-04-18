<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('children_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('children_id')->constrained('children')->onDelete('cascade');
            $table->string('description');
            $table->foreignId('meneger_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('children_comments');
    }
};
