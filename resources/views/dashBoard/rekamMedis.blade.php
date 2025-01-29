@extends('dashBoard.dashboard')

@section('container')
<h2>Data Rekam Medis</h2>

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
    <form action="/rekamMedis" method="get">
        <div class="input-group">
            <input type="text" name="cari" class="form-control" placeholder="Cari nama pasien atau nomor rekam medis" value="{{ request('cari') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>
    <div class="col-4 mt-3">
      <button type="submit" onclick="window.location.href='/tambahRekamMedis'" class="nav-link px-3 bg-success border-0 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
        </svg>
        Tambah Rekam Medis
      </button>
  </div>
</div>

<!-- Tabel Data -->
<div class="table-responsive">
  <table class="table table-striped table-bordered" id="tabel-pasien">
      <thead>
          <tr>
              <th>No</th>
              <th>Nomor Rekam Medis</th>
              <th>Nama Pasien</th>
              <th>Alamat</th>
              <th>Nomor Hp</th>
              <th>Action</th>
          </tr>
      </thead>
      <tbody>
        @forelse ($dataRekamMedis as $rekamMedis)
              <tr data-url="/rekamMedisPasien/{{ $rekamMedis->nomor_rekam_medis }}" style="cursor: pointer;">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $rekamMedis->nomor_rekam_medis }}</td> <!-- Menampilkan nomor rekam medis -->
                  <td>{{ $rekamMedis->nama }}</td> <!-- Nama Pasien -->
                  <td>{{ $rekamMedis->alamat }}</td> <!-- Menampilkan ID Rekam Medis -->
                  <td>{{ $rekamMedis->nomor_hp }}</td> <!-- Nama Dokter (opsional) -->
                  <td>
                    <a href="/rekamMedisPasien/{{ $rekamMedis->nomor_rekam_medis }}" class="btn btn-sm btn-primary">Lihat Detail</a>
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
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    // Konfigurasi Pusher
    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
    });

    // Subscribe ke channel 'pasien-baru'
    const channel = pusher.subscribe('pasien-baru');

    // Dengarkan event 'PasienBaruDitambahkan'
    channel.bind('PasienBaruDitambahkan', function(data) {
        console.log('Data pasien baru diterima:', data);

        // Cari tbody dari tabel pasien
        const tableBody = document.querySelector('#tabel-pasien tbody');

        // Tambahkan baris baru ke tabel
        const row = `
            <tr data-url="/rekamMedisPasien/{{ $rekamMedis->nomor_rekam_medis }}" style="cursor: pointer;">
                <td>${tableBody.children.length + 1}</td>
                <td>${data.pasien.nomor_rekam_medis}</td>
                <td>${data.pasien.nama}</td>
                <td>${data.pasien.alamat}</td>
                <td>${data.pasien.nomor_hp}</td>
                <td>
                    <a href="/rekamMedisPasien/{{ $rekamMedis->nomor_rekam_medis }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                  </td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });

    channel.bind('HapusPasien', function(data) {
        console.log('Data pasien dihapus:', data);

        // Cari tabel pasien
        const tableBody = document.querySelector('#tabel-pasien tbody');

        // Cari baris yang akan dihapus berdasarkan nomor rekam medis
        const rows = tableBody.getElementsByTagName('tr');
        for (let row of rows) {
            const nomorRekamMedisCell = row.cells[1];
            if (nomorRekamMedisCell && nomorRekamMedisCell.textContent === data.pasien.nomor_rekam_medis) {
                row.remove(); // Hapus baris
                break;
            }
        }
    });

</script>
@endsection
