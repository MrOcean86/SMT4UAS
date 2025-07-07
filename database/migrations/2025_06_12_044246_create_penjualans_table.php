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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->unsignedBigInteger('id_makanan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->decimal('total_harga', 10, 2)->nullable();
            $table->foreign('id_makanan')->references('id')->on('makanans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
