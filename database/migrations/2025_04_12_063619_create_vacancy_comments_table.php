<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('vacancy_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vacancy_id');
            $table->text('comment');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('vacancy_id')->references('id')->on('vacanse_hodims')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('vacancy_comments');
    }
};
