<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reimburses', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nrp');
            $table->string('jabatan');
            $table->string('jenis_sertifikat');
            $table->string('no_sertifikat')->unique();
            $table->date('tanggal_pengajuan');
            $table->string('status');
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reimburses');
    }
};
