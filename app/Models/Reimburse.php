<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimburse extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nrp',
        'jabatan',
        'jenis_sertifikat',
        'no_sertifikat',
        'tanggal_pengajuan',
        'status',
        'on_review_date',
        'lnd_date',
        'akuntansi_date',
        'treasury_date',
        'cleared_date',
    ];
}


