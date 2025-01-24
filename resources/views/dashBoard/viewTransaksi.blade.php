@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-4">
    <h3 class="mb-4 fw-bold">Rekam Medis dengan Resep atau Tindakan</h3>
    <div class="col-4">
        <button type="submit" onclick="window.location.href='/index'" class="nav-link px-3 bg-success border-0 text-white">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg>
          Cetak Struk
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Rekam Medis</th>
                    <th>Nama Pasien</th>
                    <th>Nomor Hp</th>
                    <th>Nama Dokter</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @forelse ($dataTransaksi as $rekamMedis)
                    <tr data-url="/formTransaksi/{{ $rekamMedis->id_rekam_medis }}" style="cursor: pointer;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rekamMedis->patients->nomor_rekam_medis }}</td> <!-- Menampilkan nomor rekam medis -->
                        <td>{{ $rekamMedis->patients->nama }}</td> <!-- Nama Pasien -->
                        <td>{{ $rekamMedis->patients->nomor_hp }}</td> <!-- No.Hp Pasien -->
                        {{-- <td>{{ \Carbon\Carbon::parse($rekamMedis->tanggal_berobat)->translatedFormat('l d - F - Y') }}</td> --}}
                        <td>{{ $rekamMedis->medical_staff->nama }}</td> <!-- Nama Dokter -->
                        <td>
                            <a href="{{ route('formTransaksi', $rekamMedis->id_rekam_medis) }}" class="btn btn-sm btn-primary">
                                Lihat Detail
                            </a>
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
