@extends('dashBoard.dashboard')

@section('container')
<h2>Tambah Resep Obat</h2>

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
    <form action="/tambahResep" method="get">
        <div class="input-group">
            <input type="text" name="cari" class="form-control" placeholder="Cari nama pasien atau nomor rekam medis" value="{{ request('cari') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
</div>

<!-- Tabel Data -->
<div class="table-responsive">
  <table class="table table-striped">
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
          @forelse ($dataRekamMedis as $rekamMedis)
              <tr data-url="/formResep/{{ $rekamMedis->id_rekam_medis }}" style="cursor: pointer;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rekamMedis->patients->nomor_rekam_medis }}</td> <!-- Menampilkan nomor rekam medis -->
                    <td>{{ $rekamMedis->patients->nama }}</td> <!-- Nama Pasien -->
                    <td>{{ \Carbon\Carbon::parse($rekamMedis->tanggal_berobat)->translatedFormat('l d - F - Y') }}</td>
                    <td>{{ $rekamMedis->medical_staff->nama }}</td> <!-- Nama Dokter -->
                    <td>
                        <a href="/formResep/{{ $rekamMedis->id_rekam_medis }}" class="btn btn-sm btn-primary">Tambah Resep</a>
                    </td>
              </tr>
          @empty
              <tr>
                  <td colspan="6" class="text-center">Data tidak ditemukan</td>
              </tr>
          @endforelse
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
