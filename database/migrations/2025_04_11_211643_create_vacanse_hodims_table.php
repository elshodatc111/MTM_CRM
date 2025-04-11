<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('vacanse_hodims', function (Blueprint $table) {
            $table->id();    
            $table->string('name');
            $table->string('addres');
            $table->string('phone');
            $table->date('birthday');
            $table->string('worked');
            $table->text('worked_comment')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['oshpaz', 'qarovul', 'bogbon', 'farrosh', 'techer']);
            $table->enum('status', ['new', 'pedding', 'cancel', 'success']);
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('vacanse_hodims');
    }
};
