@extends('dashBoard.dashboard')

@section('container')

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

<!-- Konten untuk pengguna non-admin -->
<div class="row mb-3">
    <!-- Kolom untuk Teks "Antrian" -->
    <div class="col-2 mt-3">
        <h2>Antrian</h2>
    </div>
    
@cannot('admin')
        <!-- Kolom untuk Tombol Tambah Antrian -->
        <div class="col-2 mt-4">
            <button type="submit" onclick="openModal()" class="nav-link px-3 bg-success border-0 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
                Tambah Antrian
            </button>
        </div>
        
        <!-- Kolom untuk Tombol Tambah Pasien Baru -->
        <div class="col-2 mt-4">
            <button type="submit" onclick="window.location.href='/tambahPasien'" class="nav-link px-3 bg-success border-0 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
                Tambah Antrian Pasien Baru
            </button>
        </div>
    </div>    
@endcannot
    
    
    
    <!-- Tabel Data -->
    <div class="table-responsive">
        <!-- Modal -->
        <div id="modalTambahAntrian" style="display: none; position: fixed; right:50%; top:22%; transform: translate(-50%, -50%); padding: 20px; background-color: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <form method="POST" action="{{ route('antrian.store') }}">
                @csrf
                <h3>Tambah Antrian Pasien Lama</h3>
                <label for="pasien">Cari Pasien</label>
                <select name="nomor_rekam_medis" id="selectPasien" style="width: 100%" required>
                    <option value="" disabled selected>Cari berdasarkan nama atau nomor rekam medis</option>
                </select>
                <div style="margin-top: 10px;">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="closeModal()">Batal</button>
                </div>
            </form>
        </div>
        <table class="table table-striped table-bordered" id="tabel-antrian">
            <thead>
          <tr>
              <th>No</th>
              <th>Nomor Rekam Medis</th>
              <th>Nama Pasien</th>
              <th>Alamat</th>
              <th>Nomor Hp</th>
              <th>Status</th>
              @can('admin')
              <th>Action</th>
              @endcan
          </tr>
      </thead>
      <tbody>
        @php
            $nomorA = 0;
        @endphp
        @forelse ($dataAntrian as $antrian)
                <tr @can('admin') 
                    @if ($antrian->status == 'Sedang dilayani' || $antrian->status == 'Selesai')
                        data-url="/rekamMedisPasien/{{ $antrian->nomor_rekam_medis }}" style="cursor: pointer;"
                    @else
                        data-url="/tambahRekamMedis/{{ $antrian->nomor_rekam_medis }}" style="cursor: pointer;"
                    @endif
                    @endcan>
                    <td>{{ ++$nomorA }}</td>
                    <td>{{ $antrian->nomor_rekam_medis }}</td> 
                    <td>{{ $antrian->patients->nama }}</td> 
                    <td>{{ $antrian->patients->alamat }}</td> 
                    <td>{{ $antrian->patients->nomor_hp }}</td> 
                    <td>
                        <span class="
                            @if ($antrian->status == 'Antri') btn btn-sm btn-primary
                            @elseif ($antrian->status == 'Sedang dilayani') btn btn-sm btn-warning
                            @elseif ($antrian->status == 'Selesai') btn btn-sm btn-success
                            @endif
                        ">
                            {{ $antrian->status }}
                        </span>
                    </td>
                    @can('admin')
                    <td>
                        @if ($antrian->status == 'Sedang dilayani' || $antrian->status == 'Selesai')
                            <a href="/rekamMedisPasien/{{ $antrian->nomor_rekam_medis }}" class="btn btn-sm btn-primary">Buka</a>
                        @else
                            <a href="/tambahRekamMedis/{{ $antrian->nomor_rekam_medis }}" class="btn btn-sm btn-primary">Buka</a>
                        @endif
                    </td>
                    @endcan
                </tr>
        @empty
            @cannot('admin')
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endcannot
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
    // Open and close modal
    function openModal() {
        document.getElementById('modalTambahAntrian').style.display = 'block';
        $('#selectPasien').select2({
            placeholder: "Cari pasien...",
            ajax: {
                url: '{{ route("api.patients.search") }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // Search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return { id: item.nomor_rekam_medis, text: item.nama + " (" + item.nomor_rekam_medis + ")" };
                        }),
                    };
                },
                cache: true
            },
        });
    }

    function closeModal() {
        document.getElementById('modalTambahAntrian').style.display = 'none';
    }
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

        // Pastikan data pasien tersedia
        if (!data.pasien) {
            console.error('Data pasien tidak ditemukan dalam event.');
            return;
        }

        // Ambil elemen tbody dari tabel pasien
        const tableBody = document.querySelector('#tabel-antrian tbody');
        if (!tableBody) {
            console.error('Tabel antrian tidak ditemukan di halaman.');
            return;
        }

        // Buat elemen <tr>
        const row = document.createElement('tr');
        row.setAttribute('data-url', `/tambahRekamMedis/${data.pasien.nomor_rekam_medis}`);
        row.style.cursor = 'pointer';

        // Tambahkan event listener untuk menangani klik
        row.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            if (url) {
                window.location.href = url;
            }
        });

        // Isi konten row
        row.innerHTML = `
            <td>${tableBody.children.length + 1}</td>
            <td>${data.pasien.nomor_rekam_medis}</td>
            <td>${data.pasien.nama}</td>
            <td>${data.pasien.alamat}</td>
            <td>${data.pasien.nomor_hp}</td>
            <td>
                <span class="btn btn-sm btn-primary">${data.pasien.status}</span>
            </td>
            <td>
                <a href="/tambahRekamMedis/${data.pasien.nomor_rekam_medis}" class="btn btn-sm btn-primary">Buka</a>
            </td>
        `;

        // Tambahkan baris ke tabel
        tableBody.appendChild(row);
    });

    channel.bind('HapusPasien', function(data) {
        console.log('Data pasien dihapus:', data);

        // Cari tabel pasien
        const tableBody = document.querySelector('#tabel-antrian tbody');

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
