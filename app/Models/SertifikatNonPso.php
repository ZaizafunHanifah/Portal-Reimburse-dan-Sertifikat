<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SertifikatNonPso extends Model
{
    protected $table = 'sertifikat_non_psos';
    protected $fillable = [
        'nama', 
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
        'bendera', 
        'tipe', 
        'pelabuhan',
    ];
}