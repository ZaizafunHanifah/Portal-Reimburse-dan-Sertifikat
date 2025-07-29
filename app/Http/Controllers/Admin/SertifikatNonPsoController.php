<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SertifikatNonPso;
use Illuminate\Support\Facades\DB;

class SertifikatNonPsoController extends Controller
{
    public function index(Request $request)
    {
        $query = SertifikatNonPso::query();

        // Filter pencarian Nama/NIK (case-insensitive)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($search) . '%'])
                  ->orWhereRaw('LOWER(nik) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        // Filter status expire
        if ($request->filled('status')) {
            $status = $request->status;
            $query->where(function($q) use ($status) {
                if ($status === 'Active') {
                    $q->whereDate('expired', '>', now());
                } elseif ($status === 'Will Expire') {
                    $q->whereDate('expired', '>', now())
                      ->whereDate('expired', '<=', now()->copy()->addMonths(3));
                } elseif ($status === 'Expired') {
                    $q->whereDate('expired', '<', now());
                } elseif ($status === 'Not Available') {
                    $q->whereNull('expired');
                }
            });
        }

        $now = now()->format('Y-m-d');
        $threeMonthsLater = now()->copy()->addMonths(3)->format('Y-m-d');

        $query->orderByRaw("
            CASE
                WHEN expired IS NULL THEN 3
                WHEN expired < ? THEN 0
                WHEN expired > ? AND expired <= ? THEN 1
                WHEN expired > ? THEN 2
                ELSE 4
            END
        ", [$now, $now, $threeMonthsLater, $threeMonthsLater])
        ->orderByDesc('id');

        $sertifikats = $query->paginate(15);

        return view('admin.nonpso-dashboard', compact('sertifikats'));
    }

    // Tampilkan form create
    public function create()
    {
        return view('admin.create-nonpso');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:50', // Tidak unik lagi
            'jabatan' => 'nullable|string|max:100',
            'kapal' => 'nullable|string|max:100',
            'pemilik' => 'nullable|string|max:100',
            'kelompok' => 'nullable|string|max:100',
            'no_ktp' => 'nullable|string|max:100',
            'jenis_sertifikat' => 'nullable|string|max:100',
            'nomor_sertifikat' => 'nullable|string|max:100',
            'tanggal_pengajuan' => 'nullable|date',
            'terbit' => 'nullable|date',
            'expired' => 'nullable|date',
            'bendera' => 'nullable|string|max:100',
            'tipe' => 'nullable|string|max:100',
            'pelabuhan' => 'nullable|string|max:100',
        ]);

        SertifikatNonPso::create($validated);

        return redirect()->route('admin.nonpso.dashboard')->with('success', 'Data berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $sertifikat = SertifikatNonPso::findOrFail($id);
        return view('admin.edit-nonpso', compact('sertifikat'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $sertifikat = SertifikatNonPso::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:50',
            'jabatan' => 'nullable|string|max:100',
            'kapal' => 'nullable|string|max:100',
            'pemilik' => 'nullable|string|max:100',
            'kelompok' => 'nullable|string|max:100',
            'no_ktp' => 'nullable|string|max:100',
            'jenis_sertifikat' => 'nullable|string|max:100',
            'nomor_sertifikat' => 'nullable|string|max:100',
            'tanggal_pengajuan' => 'nullable|date',
            'terbit' => 'nullable|date',
            'expired' => 'nullable|date',
            'bendera' => 'nullable|string|max:100',
            'tipe' => 'nullable|string|max:100',
            'pelabuhan' => 'nullable|string|max:100',
        ]);

        // Jika kapal diubah, update semua record dengan nik yang sama
        if ($request->filled('kapal') && $request->kapal !== $sertifikat->kapal) {
            SertifikatNonPso::where('nik', $sertifikat->nik)->update(['kapal' => $request->kapal]);
        }

        // Update data lain untuk record yang sedang di-edit (kecuali kapal, karena sudah dihandle mass update)
        $dataToUpdate = $validated;
        unset($dataToUpdate['kapal']);
        $sertifikat->update($dataToUpdate);

        return redirect()->route('admin.nonpso.dashboard')->with('success', 'Data berhasil diupdate.');
    }

    // Hapus data
    public function destroy($id)
    {
        $sertifikat = SertifikatNonPso::findOrFail($id);
        $sertifikat->delete();

        return redirect()->route('admin.nonpso.dashboard')->with('success', 'Data berhasil dihapus.');
    }
}