<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Sertifikat::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nrp', 'like', "%$search%")
                  ->orWhere('jenis_sertifikat', 'like', "%$search%")
                  ->orWhere('nomor_sertifikat', 'like', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query->where(function($q) use ($request) {
                $q->where('status_progres_reimburse', $request->status)
                  ->orWhere('status', $request->status);
            });
        }

        // Urutkan data berdasarkan status_progres_reimburse (bukan abjad)
        $query->orderByRaw("
            FIELD(
                status_progres_reimburse, 
                'On Review', 
                'Diajukan ke LND', 
                'Diajukan ke Akuntansi', 
                'Diajukan ke Treasury', 
                'Cleared'
            )
        ")->orderBy('created_at', 'desc');

        $sertifikats = $query->paginate(10);

        // Hitung status expired sertifikat secara otomatis
        foreach ($sertifikats as $item) {
            if (!empty($item->expired)) {
                $item->status = $this->calculateSertifikatStatus($item->expired);
            }
        }

        return view('admin.dashboard', compact('sertifikats'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nrp' => 'required',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        $data = $request->except('_token');
        // Hitung status expired sertifikat otomatis
        if (!empty($data['expired'])) {
            $data['status'] = $this->calculateSertifikatStatus($data['expired']);
        }

        Sertifikat::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        return view('admin.edit', compact('sertifikat'));
    }

    public function update(Request $request, $id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'nrp' => 'required',
            // tambahkan validasi lain sesuai kebutuhan
        ]);

        $data = $request->except('_token', '_method');
        // Hitung status expired sertifikat otomatis
        if (!empty($data['expired'])) {
            $data['status'] = $this->calculateSertifikatStatus($data['expired']);
        }

        $sertifikat->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $sertifikat->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil dihapus!');
    }

    private function calculateSertifikatStatus($expired)
    {
        if (empty($expired)) {
            return 'Not Available';
        }
        $expiredDate = Carbon::parse($expired)->startOfDay();
        $today = Carbon::today();
        $willExpire = $expiredDate->copy()->subMonths(3);

        if ($today->gt($expiredDate)) {
            return 'Expired';
        } elseif ($today->gte($willExpire)) {
            return 'Will Expire';
        }
        return 'Active';
    }
}