<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuestionBanks extends Migration{
    
    public function up(){
        Schema::create('QuestionBanks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type', 5);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('QuestionBanks');
    }
}