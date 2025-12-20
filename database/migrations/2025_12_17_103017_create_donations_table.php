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
       Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('nama_donatur');
            $table->enum('jenis_donasi', ['uang', 'barang']);

            $table->integer('nominal')->nullable();

            $table->foreignId('need_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->integer('jumlah_barang')->nullable();
            $table->string('bukti_transfer')->nullable();

            $table->enum('status', ['pending', 'sukses', 'ditolak'])
                ->default('pending');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
