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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionbank_id')->constrained('questionbanks')->onDelete('cascade');
            $table->datetime('tanggal');
            $table->integer('kuota');
            $table->boolean('status');
            $table->integer('biaya');
            $table->datetime('waktu_mulai')->nullable();
            $table->datetime('waktu_berakhir')->nullable();
            $table->timestamps(); // important to include for update_at and include_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
