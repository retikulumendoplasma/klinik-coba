@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center">
                <h1>Transaksi</h1>
            </div>

            <!-- Informasi Rekam Medis -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Informasi Rekam Medis</h5>
                    <div class="form-group pb-3">
                        <label for="nomor_rekam_medis" class="fw-semibold">nomor_rekam_medis Pasien</label>
                        <input type="text" class="form-control" id="nomor_rekam_medis" name="nomor_rekam_medis" value="{{ $rekamMedis->patients->nomor_rekam_medis }}" disabled readonly>
                    </div>
                    <div class="form-group pb-3">
                        <label for="nama" class="fw-semibold">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $rekamMedis->patients->nama }}" disabled readonly>
                    </div>
                    <div class="form-group pb-3">
                        <label for="tanggal_berobat" class="fw-semibold">Tanggal Berobat</label>
                        <input type="text" class="form-control" id="tanggal_berobat" name="tanggal_berobat" value="{{ \Carbon\Carbon::parse($rekamMedis->tanggal_berobat)->translatedFormat('l d - F - Y') }}" disabled readonly>
                    </div>
                </div>
            </div>

            <!-- Detail Resep Obat -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Detail Resep Obat</h5>
                    @if($dataResep->isNotEmpty())
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @foreach ($dataResep as $resepObat)
                                    @php
                                        $totalHarga = $resepObat->medicines->harga_jual * $resepObat->jumlah;
                                        $grandTotal += $totalHarga;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $resepObat->medicines->nama_obat }}</td>
                                        <td>{{ $resepObat->jumlah }}</td>
                                        <td>Rp{{ number_format($resepObat->medicines->harga_jual, 0, ',', '.') }}</td>
                                        <td>Rp{{ number_format($totalHarga, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Grand Total</th>
                                    <th>Rp{{ number_format($grandTotal, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <p class="text-muted">Belum ada resep yang ditambahkan.</p>
                    @endif
                    
                </div>
            </div>

           <!-- Detail Tindakan -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Detail Tindakan</h5>
                    @if($listTindakan->isNotEmpty())
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Tindakan</th>
                                    <th>Biaya Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotalTindakan = 0; @endphp
                                @foreach ($listTindakan as $tindakanPasien)
                                    @php
                                        $biaya = $tindakanPasien['biaya']; // Akses array
                                        $grandTotalTindakan += $biaya;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tindakanPasien['nama_tindakan'] }}</td>
                                        <td>Rp{{ number_format($biaya, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-right">Grand Total Tindakan</th>
                                    <th>Rp{{ number_format($grandTotalTindakan, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <p class="text-muted">Belum ada tindakan yang diterapkan.</p>
                    @endif
                </div>
            </div>
            
            <!-- Tabel Total Biaya v1-->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Total Biaya</h5>
                    <form action="{{ route('storeTransaksi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_rekam_medis" value="{{ $rekamMedis->id_rekam_medis }}">
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Total Biaya (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Total Biaya Obat</td>
                                    <td>
                                        <input 
                                            type="text" 
                                            id="total_biaya_obat"
                                            name="total_biaya_obat" 
                                            class="form-control format-currency" 
                                            value="{{ number_format($totalBiayaObat, 0, ',', '.') }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Total Biaya Tindakan</td>
                                    <td>
                                        <input 
                                            type="text" 
                                            id="total_biaya_tindakan"
                                            name="total_biaya_tindakan" 
                                            class="form-control format-currency" 
                                            value="{{ number_format($totalBiayaTindakan, 0, ',', '.') }}">
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" class="text-right">Grand Total</th>
                                    <th>
                                        <input 
                                            type="text" 
                                            id="grand_total"
                                            name="grand_total" 
                                            class="form-control format-currency font-weight-bold" 
                                            value="{{ number_format($totalBiaya, 0, ',', '.') }}"
                                            readonly>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    function formatCurrency(value) {
                        value = value.replace(/\./g, ''); // Hilangkan titik
                        return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Tambahkan titik setiap 3 digit
                    }

                    function parseCurrency(value) {
                        return parseInt(value.replace(/\./g, ''), 10) || 0; // Konversi string ke angka
                    }

                    function updateGrandTotal() {
                        const biayaObat = parseCurrency(document.getElementById('total_biaya_obat').value);
                        const biayaTindakan = parseCurrency(document.getElementById('total_biaya_tindakan').value);
                        const grandTotal = biayaObat + biayaTindakan;

                        document.getElementById('grand_total').value = formatCurrency(grandTotal.toString());
                    }

                    // Tambahkan event listener untuk input biaya obat dan tindakan
                    document.querySelectorAll('.format-currency').forEach(function (input) {
                        input.addEventListener('input', function () {
                            const cursorPosition = this.selectionStart;
                            const formattedValue = formatCurrency(this.value);
                            this.value = formattedValue;
                            this.setSelectionRange(cursorPosition, cursorPosition);

                            // Update grand total
                            updateGrandTotal();
                        });
                    });

                    // Pada saat submit, ubah semua input currency ke angka mentah (tanpa titik)
                    document.querySelector('form').addEventListener('submit', function () {
                        document.querySelectorAll('.format-currency').forEach(function (input) {
                            input.value = parseCurrency(input.value);
                        });
                    });
                });
            </script>


        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />




@endsection
