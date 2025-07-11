<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reimburse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Reimburse::query();

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('no_sertifikat', 'like', '%' . $request->search . '%')
                  ->orWhere('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('jabatan', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('status') && $request->status != '' && $request->status != 'All') {
            $query->where('status', $request->status);
        }

        // Sorting
        if ($request->has('sort') && $request->has('order')) {
            $query->orderBy($request->sort, $request->order);
        } else {
            // Custom status order
            $query->orderByRaw("
                FIELD(status, 
                    'On Review', 
                    'Diajukan ke LND', 
                    'Diajukan ke Akuntansi', 
                    'Diajukan ke Treasury', 
                    'Cleared'
                )
            ");
        }

        $reimburses = $query->paginate(10);
        return view('admin.dashboard', compact('reimburses'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nrp' => 'required',
            'jabatan' => 'required',
            'jenis_sertifikat' => 'required',
            'no_sertifikat' => 'required|unique:reimburses',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required',
        ]);

        Reimburse::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $reimburse = Reimburse::findOrFail($id);
        return view('admin.edit', compact('reimburse'));
    }

    public function update(Request $request, $id)
    {
        $reimburse = Reimburse::findOrFail($id);

        $request->validate([
            'status' => 'required',
        ]);

        $status = $request->status;
        $now = now();

        // Mapping status ke field tanggal
        $statusDateFields = [
            'On Review' => 'on_review_date',
            'Diajukan ke LND' => 'lnd_date',
            'Diajukan ke Akuntansi' => 'akuntansi_date',
            'Diajukan ke Treasury' => 'treasury_date',
            'Cleared' => 'cleared_date',
        ];

        $updateData = [
            'status' => $status,
        ];

        // Set tanggal step jika status berubah dan tanggal belum ada
        foreach ($statusDateFields as $step => $field) {
            if ($status === $step && empty($reimburse->$field)) {
                $updateData[$field] = $now;
            }
        }

        // Jika Anda ingin bisa mengedit tanggal manual dari form, tambahkan di sini:
        foreach ($statusDateFields as $field) {
            if ($request->filled($field)) {
                $updateData[$field] = $request->$field;
            }
        }

        $reimburse->update($updateData);

        return redirect()->route('admin.dashboard')->with('success', 'Status dan tanggal berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $reimburse = Reimburse::findOrFail($id);
        $reimburse->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data berhasil dihapus.');
    }
}
