<style>
    @page {
        size: 58mm auto;
        margin: 0;
    }
 
    body {
        width: 58mm;
        margin: 2px;
        padding: 0;
        font-family: 'Courier New', monospace;
        font-size: 10px; /* Mengurangi ukuran font agar lebih sesuai dengan lebar kertas */
        max-height: 150mm; /* Menetapkan tinggi maksimal halaman */
        overflow: hidden;  /* Sembunyikan elemen yang melebihi batas tinggi */
    }
 
    .container {
        padding: 1mm 0; /* Padding atas dan bawah untuk seluruh container */
    }
 
    .text-center {
        text-align: center;
        margin: 1mm 0; /* Menambahkan margin atas dan bawah pada teks yang diberi class text-center */
    }
 
    .line {
        border-top: 1px dashed #000;
        margin: 1px 0;  /* Jarak atas dan bawah untuk garis pemisah */
    }
 
    .bold {
        font-weight: bold;
        margin: 1px 0; /* Jarak untuk elemen dengan class bold */
    }
 
    .container div {
        padding: 2mm 0; /* Padding atas dan bawah untuk setiap div */
    }
 </style>
 
 <div class="container">
     <div class="text-center">
         <div>KLINIK THT</div>
         <div>TAMTAMA MEDICAL CENTER</div>
         <div>Jl. TAMTAMA 10, BINJAI</div>
         <div>Telp: (061) 8823303 / 0812 6024 237</div>
     </div>
     <div class="line"></div>
     <div class="text-center bold">TRANSAKSI</div>
     <div class="line"></div>
     <div>Nama Pasien      : {{ $transaksi->medical_reports->patients->nama }}</div>
     <div>Tanggal Berobat  : {{ $transaksi->medical_reports->tanggal_berobat }}</div>
     <div>Nomor Rekam Medis: {{ $transaksi->medical_reports->patients->nomor_rekam_medis }}</div>
     <div class="line"></div>
     <div>Total Biaya Obat     : Rp {{ number_format($transaksi->total_biaya_obat, 0, ',', '.') }}</div>
     <div>Total Biaya Tindakan : Rp {{ number_format($transaksi->total_biaya_tindakan, 0, ',', '.') }}</div>
     <div class="line"></div>
     <div class="bold">GRAND TOTAL          : Rp {{ number_format($transaksi->grand_total, 0, ',', '.') }}</div>
     <div class="line"></div>
     <div class="text-center">Terima kasih atas kunjungan Anda!</div>
 </div>
 
 <script>
    window.onload = function() {
        window.print(); // Otomatis memunculkan dialog print
    };
</script>
