<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PegawaiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Update jika NRP sudah ada, insert jika tidak
        return Pegawai::updateOrCreate(
            ['nrp' => $row['nrp']],
            [
                'nama' => $row['nama'] ?? '',
                'jabatan' => $row['jabatan'] ?? '',
                'nama_kapal' => $row['nama_kapal'] ?? '',
            ]
        );
    }
}