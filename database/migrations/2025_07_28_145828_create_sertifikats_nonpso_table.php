<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sertifikats_nonpso', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->nullable();
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
            $table->date('on_review_date')->nullable();
            $table->date('lnd_date')->nullable();
            $table->date('akuntansi_date')->nullable();
            $table->date('treasury_date')->nullable();
            $table->date('cleared_date')->nullable();
            $table->string('status_progres_reimburse')->nullable();
            $table->string('bendera')->nullable();
            $table->string('tipe')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikats_nonpso');
    }
};