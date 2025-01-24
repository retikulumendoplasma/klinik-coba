@extends('dashBoard.dashboard')

@section('container')
<h2>Data Resep Obat</h2>

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

<div class="row mb-3">
    <form action="/resep" method="get">
        <div class="input-group">
            <input type="text" name="cari" class="form-control" placeholder="Cari nama pasien atau nomor rekam medis" value="{{ request('cari') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
    <div class="col-4">
      <button type="submit" onclick="window.location.href='/tambahResep'" class="nav-link px-3 bg-success border-0 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
        </svg>
        Tambah Resep
      </button>
  </div>
</div>

<!-- Tabel Data -->
<div class="table-responsive">
  <table class="table table-striped table-bordered">
      <thead>
          <tr>
              <th>No</th>
              <th>Tanggal Resep Dibuat</th>
              <th>Nomor Rekam Medis</th>
              <th>Nama Pasien</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @foreach ($dataResep as $resep)
        <tr data-url="/detailResepPasien/{{ $resep->id_resep }}" style="cursor: pointer;">
            <td>{{ $loop->iteration }}</td>
            <td>{{ \Carbon\Carbon::parse($resep->tanggal_resep)->translatedFormat('l d - F - Y') }}</td>
            <td>{{ $resep->medical_reports->nomor_rekam_medis }}</td> <!-- Nomor Rekam Medis -->
            <td>{{ $resep->medical_reports->patients->nama }}</td> <!-- Nama Pasien -->
            <td>
                <a href="/detailResepPasien/{{ $resep->id_resep }}" class="btn btn-sm btn-primary">Lihat Detail</a>
            </td>
        </tr>
    @endforeach
    
      </tbody>
  </table>
</div>

{{-- script agar tabel dapat di click --}}
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
