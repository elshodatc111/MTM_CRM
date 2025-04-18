<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('paymarts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('children_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('amount');
            $table->enum('type', ['naqt', 'plastik', 'chegirma']);
            $table->enum('status', ['tulov', 'chegirma', 'qaytarildi']);
            $table->text('discription')->nullable();
            $table->timestamps();
            $table->foreign('children_id')->references('id')->on('children')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void{
        Schema::dropIfExists('paymarts');
    }
};
