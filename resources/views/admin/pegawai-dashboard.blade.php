@extends('layouts.app')

@section('title', 'Dashboard Data Pegawai')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h2 class="mb-0">Dashboard Data Pegawai</h2>
            <div>
                <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#modalTambahPegawai">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Pegawai
                </button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUploadExcel">
                    <i class="bi bi-upload me-1"></i> Upload Excel
                </button>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered dashboard-table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>NRP</th>
                            <th>Jabatan</th>
                            <th>Nama Kapal</th>
                            <th class="aksi-col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawais as $pegawai)
                            <tr>
                                <td>{{ $pegawai->nama }}</td>
                                <td>{{ $pegawai->nrp }}</td>
                                <td>{{ $pegawai->jabatan }}</td>
                                <td>{{ $pegawai->nama_kapal }}</td>
                                <td class="aksi-col">
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <button class="btn btn-sm btn-primary" title="Edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditPegawai"
                                            data-id="{{ $pegawai->id }}"
                                            data-nama="{{ $pegawai->nama }}"
                                            data-nrp="{{ $pegawai->nrp }}"
                                            data-jabatan="{{ $pegawai->jabatan }}"
                                            data-nama_kapal="{{ $pegawai->nama_kapal }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('admin.pegawai.destroy', $pegawai->id) }}" method="POST" onsubmit="return confirm('Hapus data pegawai?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data pegawai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end my-4">
                {{ $pegawais->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pegawai -->
<div class="modal fade" id="modalTambahPegawai" tabindex="-1" aria-labelledby="modalTambahPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.pegawai.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPegawaiLabel">Tambah Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="nrp" class="form-label">NRP</label>
                    <input type="text" name="nrp" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="nama_kapal" class="form-label">Nama Kapal</label>
                    <input type="text" name="nama_kapal" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Pegawai -->
<div class="modal fade" id="modalEditPegawai" tabindex="-1" aria-labelledby="modalEditPegawaiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEditPegawai" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPegawaiLabel">Edit Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="edit-id">
                <div class="mb-3">
                    <label for="edit-nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="edit-nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit-nrp" class="form-label">NRP</label>
                    <input type="text" name="nrp" id="edit-nrp" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit-jabatan" class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" id="edit-jabatan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit-nama_kapal" class="form-label">Nama Kapal</label>
                    <input type="text" name="nama_kapal" id="edit-nama_kapal" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Upload Excel -->
<div class="modal fade" id="modalUploadExcel" tabindex="-1" aria-labelledby="modalUploadExcelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.pegawai.import') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalUploadExcelLabel">Upload Data Pegawai (Excel)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="file_excel" class="form-label">File Excel (.xlsx, .xls)</label>
                    <input type="file" name="file_excel" class="form-control" accept=".xlsx,.xls" required>
                </div>
                <div class="alert alert-info">
                    Format kolom: <strong>nama, nrp, jabatan, nama_kapal</strong>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var editModal = document.getElementById('modalEditPegawai');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var nama = button.getAttribute('data-nama');
        var nrp = button.getAttribute('data-nrp');
        var jabatan = button.getAttribute('data-jabatan');
        var nama_kapal = button.getAttribute('data-nama_kapal');

        var form = document.getElementById('formEditPegawai');
        form.action = '/admin/pegawai/' + id;
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-nrp').value = nrp;
        document.getElementById('edit-jabatan').value = jabatan;
        document.getElementById('edit-nama_kapal').value = nama_kapal;
    });
});
</script>
@endpush
@endsection