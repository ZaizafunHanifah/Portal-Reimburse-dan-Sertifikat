<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PegawaiImport;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::orderBy('nama')->paginate(20);
        return view('admin.pegawai_dashboard', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nrp' => 'required|string|max:50',
            'jabatan' => 'required|string|max:100',
            'nama_kapal' => 'required|string|max:100',
        ]);

        // Update jika NRP sudah ada, insert jika tidak
        $pegawai = Pegawai::updateOrCreate(
            ['nrp' => $validated['nrp']],
            $validated
        );

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nrp' => 'required|string|max:50',
            'jabatan' => 'required|string|max:100',
            'nama_kapal' => 'required|string|max:100',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($validated);

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new PegawaiImport, $request->file('file_excel'));
            return redirect()->route('admin.pegawai.index')->with('success', 'Data pegawai berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->route('admin.pegawai.index')->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }
}