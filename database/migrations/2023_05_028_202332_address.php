<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Address extends Migration{
    
    public function up(){
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('village');
            $table->string('sub_district');
            $table->string('district');
            $table->string('province');
            $table->string('postal_code');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('address');
    }
}