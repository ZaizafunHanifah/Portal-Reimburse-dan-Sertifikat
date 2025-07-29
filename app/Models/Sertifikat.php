<?php

// 1. Model: app/Models/Sertifikat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'sertifikats'; // pastikan nama tabel sesuai
    protected $fillable = [
        'nama',
        'nrp',
        'nik',
        'jabatan',
        'kapal',
        'pemilik',
        'kelompok',
        'no_ktp',
        'jenis_sertifikat',
        'nomor_sertifikat',
        'tanggal_pengajuan',
        'terbit',
        'expired',
        'on_review_date',
        'lnd_date',
        'akuntansi_date',
        'treasury_date',
        'cleared_date',
        'status_progres_reimburse',
        'bendera',
        'tipe',
        'pelabuhan',
    ];


}