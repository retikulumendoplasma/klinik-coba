<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk</title>
</head>
<body>
    <!-- Struk cetakan yang telah diproses -->
    <div>
        <p>KLINIK THT</p>
        <p>TAMTAMA MEDICAL CENTER</p>
        <p>Jl. TAMTAMA 10, BINJAI</p>
        <p>Telp: (061) 8823303 / 0812 6024 237</p>
        <p>TRANSAKSI</p>
        <p>Nama Pasien: {{ $transaksi->medical_reports->patients->nama }}</p>
        <p>Tanggal Berobat: {{ \Carbon\Carbon::parse($transaksi->medical_reports->tanggal_berobat)->format('d-m-Y') }}</p>
        <p>Nomor Rekam Medis: {{ $transaksi->medical_reports->patients->nomor_rekam_medis }}</p>
        <p>Total Biaya Obat: Rp {{ number_format($transaksi->total_biaya_obat, 0, ',', '.') }}</p>
        <p>Total Biaya Tindakan: Rp {{ number_format($transaksi->total_biaya_tindakan, 0, ',', '.') }}</p>
        <p>GRAND TOTAL: Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</p>
        <p>Terima kasih atas kunjungan Anda!</p>
    </div>

    <script>
        window.onload = function() {
                window.close(); // Menutup tab setelah pencetakan selesai
        };
    </script>
</body>
</html>
