<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sertifikat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SertifikatController extends Controller
{
    /**
     * Dashboard Sertifikat & Reimburse
     */
    public function index(Request $request)
    {
        $query = Sertifikat::where('source', 'reimburse')
                   ->whereNotNull('status_progres_reimburse');
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                ->orWhere('nrp', 'like', "%$search%")
                ->orWhere('jenis_sertifikat', 'like', "%$search%")
                ->orWhere('nomor_sertifikat', 'like', "%$search%")
                ->orWhere('status_progres_reimburse', 'like', "%$search%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $status = $request->status;

            // Status Expire
            if (in_array($status, ['Active', 'Will Expire', 'Expired', 'Not Available'])) {
                $today = now()->startOfDay();
                if ($status == 'Active') {
                    $query->whereNotNull('expired')
                        ->whereDate('expired', '>', $today->copy()->addMonths(3));
                } elseif ($status == 'Will Expire') {
                    $query->whereNotNull('expired')
                        ->whereDate('expired', '>', $today)
                        ->whereDate('expired', '<=', $today->copy()->addMonths(3));
                } elseif ($status == 'Expired') {
                    $query->whereNotNull('expired')
                        ->whereDate('expired', '<', $today);
                } elseif ($status == 'Not Available') {
                    $query->whereNull('expired');
                }
            }
            // Status Reimburse
            else {
                $query->where('status_progres_reimburse', $status);
            }
        }

        // Custom order by status_progres_reimburse
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

        foreach ($sertifikats as $item) {
            $item->status_expired = $this->calculateStatus($item->expired);
        }

        return view('admin.dashboard', compact('sertifikats'));
    }

    public function create()
    {
        return view('admin.edit', ['sertifikat' => null]);
    }

    public function edit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        return view('admin.edit', compact('sertifikat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nrp' => 'required|string|max:50',
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

        $validated['source'] = 'reimburse';
        $validated['status_progres_reimburse'] = 'On Review';

        Sertifikat::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'nrp' => 'required',
            // tambahkan validasi lain jika ada
        ]);

        // Update semua 'kapal' yang memiliki NRP sama
        if ($request->filled('kapal')) {
            Sertifikat::where('nrp', $sertifikat->nrp)->update([
                'kapal' => $request->kapal
            ]);
        }

        // Update hanya data lain (tanpa kapal) untuk record yang sedang di-edit
        $sertifikat->update($request->except('kapal'));

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        $sertifikat->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil dihapus!');
    }

    private function calculateStatus($expired)
    {
        if (empty($expired)) {
            return 'Not Available';
        }
        $expiredDate = Carbon::parse($expired)->startOfDay();
        $today = Carbon::today();
        return $expiredDate->lt($today) ? 'Expired' : 'Active';
    }

    public function dashboard(Request $request)
    {
        $query = Sertifikat::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                ->orWhere('nrp', 'like', "%$search%")
                ->orWhere('jenis_sertifikat', 'like', "%$search%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $status = $request->status;

            // Status Expire
            if (in_array($status, ['Active', 'Will Expire', 'Expired', 'Not Available'])) {
                $today = now()->startOfDay();
                if ($status == 'Active') {
                    $query->whereNotNull('expired')
                        ->whereDate('expired', '>', $today->copy()->addMonths(3));
                } elseif ($status == 'Will Expire') {
                    $query->whereNotNull('expired')
                        ->whereDate('expired', '>', $today)
                        ->whereDate('expired', '<=', $today->copy()->addMonths(3));
                } elseif ($status == 'Expired') {
                    $query->whereNotNull('expired')
                        ->whereDate('expired', '<', $today);
                } elseif ($status == 'Not Available') {
                    $query->whereNull('expired');
                }
            }
            // Status Reimburse
            else {
                $query->where('status_progres_reimburse', $status);
            }
        }

        // Custom order by status_progres_reimburse
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

        $sertifikats = $query->paginate(15);

        return view('admin.dashboard', compact('sertifikats'));
    }

    public function psoCreate()
    {
        return view('admin.create-pso');
    }

    public function psoStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nrp' => 'required|string|max:50',
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

        $validated['source'] = 'pso';

        Sertifikat::create($validated);

        return redirect()->route('admin.sertifikat.dashboard')->with('success', 'Sertifikat PSO berhasil ditambahkan');
    }

    public function psoEdit($id)
    {
        $sertifikat = Sertifikat::findOrFail($id);
        return view('admin.edit-pso', compact('sertifikat'));
    }

    public function psoUpdate(Request $request, $id)
    {
        $sertifikat = Sertifikat::findOrFail($id);

        // Validasi jika perlu
        // $validated = $request->validate([...]);

        // Update semua 'kapal' yang memiliki NRP sama
        if ($request->filled('kapal')) {
            Sertifikat::where('nrp', $sertifikat->nrp)->update([
                'kapal' => $request->kapal
            ]);
        }

        // Update field lain (selain kapal) hanya untuk record yang sedang di-edit
        $sertifikat->update($request->except('kapal'));

        return redirect()->route('admin.sertifikat.dashboard')->with('success', 'Data berhasil diupdate');
    }

    public function psoDestroy($id)
    {
        Sertifikat::destroy($id);
        return redirect()->route('admin.sertifikat.dashboard')->with('success', 'Data berhasil dihapus');
    }

    public function psoIndex(Request $request)
    {
        // Ambil data dari reimburse ATAU dari pso yang tidak punya status_progres_reimburse (murni PSO)
        $query = Sertifikat::where(function ($q) {
            $q->where('source', 'reimburse')
            ->orWhere(function ($q2) {
                $q2->where('source', 'pso')
                    ->whereNull('status_progres_reimburse');
            });
        });

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                ->orWhere('nrp', 'like', "%$search%")
                ->orWhere('jenis_sertifikat', 'like', "%$search%");
            });
        }

        // Filter status expired
        if ($request->filled('status')) {
            $status = $request->status;
            $today = now()->startOfDay();
            if (in_array($status, ['Active', 'Will Expire', 'Expired', 'Not Available'])) {
                if ($status == 'Active') {
                    $query->whereNotNull('expired')
                        ->whereDate('expired', '>', $today->copy()->addMonths(3));
                } elseif ($status == 'Will Expire') {
                    $query->whereNotNull('expired')
                        ->whereDate('expired', '>', $today)
                        ->whereDate('expired', '<=', $today->copy()->addMonths(3));
                } elseif ($status == 'Expired') {
                    $query->whereNotNull('expired')
                        ->whereDate('expired', '<', $today);
                } elseif ($status == 'Not Available') {
                    $query->whereNull('expired');
                }
            }
        }

        // Ambil semua data lalu proses status_expire
        $sertifikats = $query->get();

        // Tambahkan status_expire
        $now = \Carbon\Carbon::today();
        $sertifikats = $sertifikats->map(function($item) use ($now) {
            $expiredDate = $item->expired ? \Carbon\Carbon::parse($item->expired) : null;
            $statusExpire = 'Not Available';

            if ($expiredDate) {
                $willExpire = $expiredDate->copy()->subMonths(3);
                if ($now->gt($expiredDate)) {
                    $statusExpire = 'Expired';
                } elseif ($now->gte($willExpire)) {
                    $statusExpire = 'Will Expire';
                } else {
                    $statusExpire = 'Active';
                }
            }

            $item->status_expire = $statusExpire;
            return $item;
        });

        // Urutkan berdasarkan status kadaluarsa
        $statusOrder = [
            'Expired' => 0,
            'Will Expire' => 1,
            'Active' => 2,
            'Not Available' => 3,
        ];

        $sertifikats = $sertifikats->sortBy(function($item) use ($statusOrder) {
            return $statusOrder[$item->status_expire] ?? 99;
        })->values();

        // Pagination manual
        $page = $request->input('page', 1);
        $perPage = 10;
        $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $sertifikats->forPage($page, $perPage),
            $sertifikats->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.pso-dashboard', ['sertifikats' => $paginated]);
    }

}