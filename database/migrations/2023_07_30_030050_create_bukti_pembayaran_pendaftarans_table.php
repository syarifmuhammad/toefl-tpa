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
        Schema::create('bukti_pembayaran_pendaftarans', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('file');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('attempt_schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_pembayaran_pendaftarans');
    }
};
