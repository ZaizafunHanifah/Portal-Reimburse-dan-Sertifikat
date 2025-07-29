<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nrp');
            $table->string('jabatan')->nullable();
            $table->string('kapal')->nullable();
            $table->string('pemilik')->nullable();
            $table->string('kelompok')->nullable();
            $table->string('no_ktp')->nullable();

            $table->string('jenis_sertifikat')->nullable();
            $table->string('nomor_sertifikat')->nullable();
            $table->date('tanggal_pengajuan')->nullable();
            $table->date('terbit')->nullable();
            $table->date('expired')->nullable();

            // Tanggal status reimburse
            $table->date('on_review_date')->nullable();
            $table->date('lnd_date')->nullable();
            $table->date('akuntansi_date')->nullable();
            $table->date('treasury_date')->nullable();
            $table->date('cleared_date')->nullable();

            // Status reimburse
            $table->enum('status_progres_reimburse', [
                'On Review',
                'Diajukan ke LND',
                'Diajukan ke Akuntansi',
                'Diajukan ke Treasury',
                'Cleared'
            ])->default('On Review');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
