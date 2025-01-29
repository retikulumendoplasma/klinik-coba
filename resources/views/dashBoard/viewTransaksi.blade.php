@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-4">
    <h3 class="mb-4 fw-bold">Rekam Medis dengan Resep atau Tindakan</h3>
    <div class="col-4">
        <button type="submit" onclick="window.location.href='/listTransaksi'" class="nav-link px-3 bg-success border-0 text-white">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg>
          Cetak Struk
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="tabel-transaksi">
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
                        <td>{{ $rekamMedis->patients->nomor_rekam_medis }}</td>
                        <td>{{ $rekamMedis->patients->nama }}</td>
                        <td>{{ $rekamMedis->patients->nomor_hp }}</td>
                        <td>{{ $rekamMedis->medical_staff->nama }}</td>
                        <td>
                            <a href="{{ route('formTransaksi', $rekamMedis->id_rekam_medis) }}" class="btn btn-sm btn-primary">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
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

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
    // Konfigurasi Pusher
    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true
    });

    // Subscribe ke channel 'transaksi-baru'
    const channel = pusher.subscribe('transaksi-baru');

    // Dengarkan event 'TransaksiBaru'
    channel.bind('TransaksiBaru', function(data) {
        console.log('Data transaksi baru diterima:', data);

        // Cari tbody dari tabel
        const tableBody = document.querySelector('#tabel-transaksi tbody');

        // Menambahkan baris baru ke tabel
        const row = `
            <tr data-url="/formTransaksi/${data.transaksi.id_rekam_medis}">
                <td></td>  <!-- Nomor urut sementara kosong -->
                <td>${data.transaksi.nomor_rekam_medis}</td>
                <td>${data.transaksi.nama_pasien}</td>
                <td>${data.transaksi.nomor_hp}</td>
                <td>${data.transaksi.nama_dokter}</td>
                <td>
                    <a href="/formTransaksi/${data.transaksi.id_rekam_medis}" class="btn btn-sm btn-primary">
                        Lihat Detail
                    </a>
                </td>
            </tr>
        `;

        // Menambahkan row baru ke tabel
        tableBody.innerHTML += row;

        // Mengupdate nomor baris setelah menambah data baru
        let rows = tableBody.querySelectorAll('tr');
        rows.forEach((row, index) => {
            if (index === 0) {
                row.querySelector('td').textContent = 1;  // Baris pertama tetap nomor 1
            } else {
                row.querySelector('td').textContent = index + 1;  // Update nomor urut dimulai dari 2
            }
        });
    });
</script>
@endsection
