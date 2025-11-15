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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan', 'selainnya']);
            $table->bigInteger('nomor_identitas');
            $table->date('check_in');
            $table->integer('durasi_menginap');
            $table->boolean('sarapan');
            $table->decimal('total_bayar', 15, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
