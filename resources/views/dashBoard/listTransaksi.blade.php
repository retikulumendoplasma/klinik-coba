@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5 pb-5">
    <div class="row justify-content-center mt-5">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title fw-bold">Daftar Transaksi</h5>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Nomor Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Nomor Hp</th>
                            <th>Grand Total</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksiList as $transaksi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaksi->tanggal_transaksi }}</td>
                                <td>{{ $transaksi->medical_reports->patients->nomor_rekam_medis }}</td>
                                <td>{{ $transaksi->medical_reports->patients->nama }}</td>
                                <td>{{ $transaksi->medical_reports->patients->nomor_hp }}</td>
                                <td>Rp{{ number_format($transaksi->grand_total, 0, ',', '.') }}</td>
                                {{-- <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->translatedFormat('l d - F - Y') }}</td> --}}
                                <td>
                                    <a href="{{ route('cetakStruk', ['idTransaksi' => $transaksi->id_transaksi]) }}" class="btn btn-primary" target="_blank">
                                        Cetak Struk
                                    </a>                                    
                                    {{-- <a href="/transaksi/print/{{ $transaksi->id_transaksi }}" class="btn btn-primary" target="_blank">
                                        Cetak Struk v2
                                    </a>                                     --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
   