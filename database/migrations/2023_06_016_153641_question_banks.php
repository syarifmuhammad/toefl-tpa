<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionBanks extends Migration{
    
    public function up(){
        Schema::create('question_banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category', 5);
            $table->text('content')->nullable();
            $table->string('jumlah');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('QuestionBanks');
    }
}