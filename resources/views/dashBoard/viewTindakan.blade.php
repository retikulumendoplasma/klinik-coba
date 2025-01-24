@extends('dashBoard.dashboard')

@section('container')
<h2>Pasien Yang Belum Mendapatkan Tindakan</h2>

<!-- Alert Sukses/Error -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Form Pencarian -->
<div class="row mb-3">
    <form action="/viewTindakan" method="get">
        <div class="input-group">
            <input type="text" name="cari" class="form-control" placeholder="Cari nama pasien atau nomor rekam medis" value="{{ request('cari') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
</div>

<!-- Tabel Data Belum Mendapatkan Tindakan -->
<h3>Pasien Yang Belum Mendapatkan Tindakan</h3>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Rekam Medis</th>
                <th>Nama Pasien</th>
                <th>Tanggal Berobat</th>
                <th>Nama Dokter</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($belumTindakan as $rekamMedis)
                <tr data-url="/formTindakan/{{ $rekamMedis->id_rekam_medis }}" style="cursor: pointer;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rekamMedis->patients->nomor_rekam_medis }}</td>
                    <td>{{ $rekamMedis->patients->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($rekamMedis->tanggal_berobat)->translatedFormat('l d - F - Y') }}</td>
                    <td>{{ $rekamMedis->medical_staff->nama }}</td>
                    <td>
                        <a href="/formTindakan/{{ $rekamMedis->id_rekam_medis }}" class="btn btn-sm btn-primary">Beri Tindakan</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Tabel Data Sudah Mendapatkan Tindakan -->
<h3>Pasien Yang Sudah Mendapatkan Tindakan</h3>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Rekam Medis</th>
                <th>Nama Pasien</th>
                <th>Tanggal Berobat</th>
                <th>Nama Dokter</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sudahTindakan as $rekamMedis)
                <tr data-url="/detailTindakanPasien/{{ $rekamMedis->id_rekam_medis }}" style="cursor: pointer;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rekamMedis->patients->nomor_rekam_medis }}</td>
                    <td>{{ $rekamMedis->patients->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($rekamMedis->tanggal_berobat)->translatedFormat('l d - F - Y') }}</td>
                    <td>{{ $rekamMedis->medical_staff->nama }}</td>
                    <td>
                        <a href="/detailTindakanPasien/{{ $rekamMedis->id_rekam_medis }}" class="badge bg-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                        </a>
                        <a href="/editRekamMedis/{{ $rekamMedis->id_rekam_medis }}/editRekamMedis" class="badge bg-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a>
                        <form action="/rekamMedis/{{ $rekamMedis->id_rekam_medis }}" method="post" class="d-inline" >
                            @csrf
                            @method('DELETE')
                            <button class="badge bg-danger border-0" onclick="return confirm('Apakah kamu yakin ingin menghapus data rekam medis ini?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
      const rows = document.querySelectorAll('tr[data-url]');
      rows.forEach(row => {
          row.addEventListener('click', function() {
              window.location.href = this.dataset.url;
          });
      });
  });
</script>
@endsection

{{-- 
<!-- Form Tambah Resep -->
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title fw-bold">Tambah Resep</h5>
        <form action="{{ route('storeResep') }}" method="POST" id="formResep">
            @csrf
            <input type="hidden" name="id_rekam_medis" value="{{ $rekamMedis->id_rekam_medis }}">
        
            <!-- Select2 untuk mencari obat -->
            <div class="form-group">
                <label for="obat" class="fw-semibold">Cari Obat</label>
                <select id="obat" class="form-control" name="obat[]" multiple="multiple" style="width: 100%;">
                    <!-- Select2 akan memuat opsi obat melalui AJAX -->
                </select>
            </div>

            <!-- Error jika tidak ada obat yang dipilih -->
            @error('obat')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        
            <!-- Daftar obat yang dipilih dengan jumlah -->
            <div id="selected-obat" class="mt-4">
                <!-- Area untuk menampilkan obat yang dipilih dengan jumlah -->
            </div>
        
            <button type="submit" class="btn btn-primary mt-3" id="submitResep">Simpan Resep</button>
        </form>
    </div>
</div> --}}