@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Tambah Tindakan</h1>
            </div>

            <!-- Informasi Rekam Medis -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Informasi Rekam Medis</h5>
                    <div class="form-group pb-3">
                        <label for="tanggal_berobat" class="fw-semibold">Tanggal Berobat</label>
                        <input type="text" class="form-control" id="tanggal_berobat" name="tanggal_berobat" value="{{ \Carbon\Carbon::parse($rekamMedis->tanggal_berobat)->translatedFormat('l d - F - Y') }}" disabled readonly>
                    </div>
                    <div class="form-group pb-3">
                        <label for="nama" class="fw-semibold">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $rekamMedis->patients->nama }}" disabled readonly>
                    </div>
                    <div class="form-group pb-3">
                        <label for="usia" class="fw-semibold">Usia Pasien</label>
                        <input type="text" class="form-control" id="usia" name="usia" value="{{ \Carbon\Carbon::parse($rekamMedis->patients->tanggal_lahir)->age }} Tahun" disabled readonly>
                    </div>
                    <div class="form-group">
                        <label for="namadokter" class="fw-semibold">Dokter</label>
                        <input type="text" class="form-control" id="namadokter" name="namadokter" value="{{ $rekamMedis->medical_staff->nama }}" disabled readonly>
                    </div>
                </div>
            </div>

            <!-- Detail Rekam Medis -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Detail Rekam Medis</h5>
                    <div class="mb-3">
                        <h6 class="fw-semibold">Subjective</h6>
                        <p class="text-muted">{!! nl2br(e($rekamMedis->subjective)) !!}</p>
                        <hr class="my-3">
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-semibold">Objective</h6>
                        <p class="text-muted">{!! nl2br(e($rekamMedis->objective)) !!}</p>
                        <hr class="my-3">
                    </div>
                    <div class="mb-3">
                        <h6 class="fw-semibold">Assesment</h6>
                        <p class="text-muted">{!! nl2br(e($rekamMedis->assesment)) !!}</p>
                        <hr class="my-3">
                    </div>
                    <div>
                        <h6 class="fw-semibold">Planning</h6>
                        <p class="text-muted">{!! nl2br(e($rekamMedis->planning)) !!}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Resep Obat -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Detail Resep</h5>
                    @if($dataResep->isNotEmpty())
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Cara Minum</th>
                                    <th>Cara Pemberian</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataResep as $resepObat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $resepObat->medicines->nama_obat }}</td>
                                        <td>{{ $resepObat->jumlah }}</td>
                                        <td>{{ $resepObat->cara_minum }}</td>
                                        <td>{{ $resepObat->cara_pakai }}</td>
                                        <td>{{ $resepObat->satuan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Belum ada resep yang ditambahkan.</p>
                    @endif
                    
                </div>
            </div>

            <!-- Form Tambah Tindakan -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Tambah Tindakan</h5>
                    <form id="formTindakan" action="{{ route('storeTindakan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_rekam_medis" value="{{ $rekamMedis->id_rekam_medis }}">
                    
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <div id="selected-tindakan">
                            <div class="form-group mb-3">
                                <label for="tindakan" class="fw-semibold">Pilih Tindakan</label>
                                <select id="tindakan" class="form-control"></select>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan Tindakan</button>
                    </form>                    
                    
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script>
$(document).ready(function () {
    // Inisialisasi Select2 untuk mencari tindakan
    $('#tindakan').select2({
        placeholder: "Cari tindakan...",
        ajax: {
            url: "{{ route('searchTindakan') }}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { q: params.term };
            },
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id_jenis_tindakan,
                            text: item.nama_tindakan,
                            harga_tindakan: item.harga_tindakan
                        };
                    })
                };
            },
            cache: true
        }
    });

    // Event listener untuk menambahkan tindakan yang dipilih
    $('#tindakan').on('select2:select', function (e) {
        const selectedData = e.params.data;

        if ($('#selected-tindakan').find(`[data-id="${selectedData.id}"]`).length === 0) {
            $('#selected-tindakan').append(`
                <div class="d-flex align-items-center mb-3" data-id="${selectedData.id}">
                    <input type="hidden" name="id_jenis_tindakan[]" value="${selectedData.id}">
                    <div style="flex-grow: 1;">${selectedData.text}</div>
                    <input type="text" class="form-control input-currency" name="harga_tindakan[]" value="${formatCurrency(selectedData.harga_tindakan)}" style="width: 120px;" required>
                    <button type="button" class="btn btn-danger ms-2 btn-remove">Hapus</button>
                </div>
            `);

            applyCurrencyFormatListeners(); // Mengaktifkan listener input untuk format currency
        }
    });

    // Fungsi untuk memformat angka menjadi format currency dengan titik
    function formatCurrency(value) {
        if (!value || isNaN(value)) return ''; // Jika value kosong atau NaN, kembalikan string kosong
        return parseInt(value, 10).toLocaleString('id-ID');
    }

    // Fungsi untuk menambahkan event listener ke input currency
    function applyCurrencyFormatListeners() {
        $('.input-currency')
            .off('keypress input blur')
            .on('keypress', function (e) {
                // Mencegah input selain angka
                const charCode = e.which ? e.which : e.keyCode;
                if (charCode < 48 || charCode > 57) {
                    e.preventDefault();
                }
            })
            .on('input', function () {
                // Menghapus titik pemisah ribuan untuk diproses kembali
                let rawValue = this.value.replace(/\./g, '');
                if (!rawValue) {
                    this.value = ''; // Kosongkan jika input kosong
                } else if (!isNaN(rawValue)) {
                    this.value = formatCurrency(rawValue);
                }
            })
            .on('blur', function () {
                // Menghapus titik saat validasi input untuk memastikan format yang benar
                let rawValue = this.value.replace(/\./g, '');
                if (!rawValue || isNaN(rawValue)) {
                    this.value = ''; // Kosongkan jika input tidak valid
                } else {
                    this.value = formatCurrency(rawValue);
                }
            });
    }

    // Event listener untuk menghapus tindakan dari daftar
    $('#selected-tindakan').on('click', '.btn-remove', function () {
        $(this).parent().remove();
    });

    // Validasi sebelum submit
    $('#formTindakan').on('submit', function (e) {
        // Menghapus titik sebelum submit
        $('input[name="harga_tindakan[]"]').each(function () {
            // Menghapus titik sebelum mengirimkan data
            this.value = this.value.replace(/\./g, '');
        });

        // Memastikan minimal satu tindakan dipilih
        if ($('#selected-tindakan').children().length === 0) {
            e.preventDefault();
            alert('Pilih minimal satu tindakan untuk disimpan.');
        }
    });
});
</script>






@endsection
