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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nim_or_nik', 16)->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('profile_picture');
            $table->string('phone');
            // $table->unsignedBigInteger('address_id')->nullable();
            // $table->foreign('address_id')->references('id')->on('address');
            // $table->foreignId('address_id')
            //     ->constrained()
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
            // $table->string('address_id')->default('0');
            $table->boolean('is_admin')->default('0');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
