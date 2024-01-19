@extends('layouts.main')

@section('main')
    {{-- Slider image --}}
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="img/Gambar Mesjid Al-Ikhlas.jpg" class="d-block w-100 carousel-img" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="img/Gambar Kantor Desa Jatirejo.jpg" class="d-block w-100 carousel-img" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="img/Gambar Struktur Organisasi.png" class="d-block w-100 carousel-img" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev d-md-none" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next d-md-none" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <style>
        .carousel-img {
            height: 80vh; /* Default height for larger screens */
            object-fit: cover;
        }

        /* Media query for smaller screens */
        @media only screen and (max-width: 600px) {
            .carousel-img {
                height: 45vh; /* Adjust the height for smaller screens */
            }
            .card_box {
                max-width: 100%; /* Adjust the width for smaller screens */
            }
            .owl-nav {
                display: none;
            }
        }
    </style>

{{-- jumlah penduduk start --}}
<div class="container p-3">
    <header class="row">
        <div class="col-md-12 text-center mb-4">
            <h2 class="head_text">Jumlah Penduduk Desa Jatirejo</h2>
        </div>
    </header>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card-body text-center">
                <img src="https://digitaldesa.id/templates/homepage/media/misc/icon-users.svg" height="65">
                <p id="totalPenduduk" name="totalPenduduk" class="jum-total">{{ $totalpenduduk }}</p>
                <p class="des_card">Total Penduduk</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card-body text-center">
                <img src="https://digitaldesa.id/templates/homepage/media/misc/icon-users.svg" height="65">
                <p id="totalPenduduk" name="totalPenduduk" class="jum-total">{{ $totalNomorKK }}</p>
                <p class="des_card">Jumlah KK</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card-body text-center">
                <img src="https://digitaldesa.id/templates/homepage/media/misc/icon-users.svg" height="65">
                <p id="totalPendudukPria" name="totalPendudukPria" class="jum-total">{{ $totallakilaki }}</p>
                <p class="des_card">Penduduk Laki-laki</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card-body text-center">
                <img src="https://digitaldesa.id/templates/homepage/media/misc/icon-users.svg" height="65">
                <p id="totalPendudukWanita" name="totalPendudukWanita" class="jum-total">{{ $totalperempuan }}</p>
                <p class="des_card">Penduduk Wanita</p>
            </div>
        </div>
    </div>
</div>
{{-- jumlah penduduk end --}}

{{-- visi misi --}}


<div class="container mt-4 pb-5">
    <div class="row">
        <div class="col-md-6 mb-5">
            <div class="card h-100">
                <div class="card-body d-flex flex-column align-items-center ">
                    <h5 class="card-title head_text">Visi</h5>
                    <p class="des_card text-center">Kesejahteraan Bersama : Menjadi desa di mana kesejahteraan bersama menjadi kenyataan, dengan setiap warga menikmati tingkat hidup yang lebih baik.</p>
                    <p class="des_card text-center">Keberlanjutan Lingkungan : Mengembangkan desa yang berkelanjutan, menjaga keindahan alam, dan meminimalkan dampak negatif terhadap lingkungan.</p>
                    <p class="des_card text-center">Keterlibatan Warga : Menciptakan desa inklusif dengan melibatkan aktif seluruh warga dalam proses pengambilan keputusan dan pembangunan.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-5">
            <div class="card h-100">
                <div class="card-body d-flex flex-column align-items-center ">
                    <h5 class="card-title head_text">Misi</h5>
                    <p class="des_card text-center">Pembangunan Infrastruktur yang Berkesinambungan : Merencanakan dan melaksanakan pembangunan infrastruktur yang berkelanjutan, termasuk jaringan jalan, air bersih, sanitasi, dan listrik, untuk meningkatkan kualitas hidup warga desa.</p>
                    <p class="des_card text-center">Pemberdayaan Ekonomi Lokal : Menggalakkan pertumbuhan ekonomi dengan mendukung usaha mikro dan kecil, menciptakan lapangan kerja lokal, dan mendorong inovasi ekonomi untuk meningkatkan taraf hidup warga desa.</p>
                    <p class="des_card text-center">Konservasi Lingkungan dan Warisan Budaya : Melindungi dan mempertahankan keanekaragaman alam serta warisan budaya desa, sambil mempromosikan praktik berkelanjutan dan kesadaran lingkungan dikalangan warga.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- visi misi end --}}

<!-- card area start -->
<div class="card-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="head_text">Aparatur Desa Jatirejo</h2>
                <p class="des_card">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores culpa, commodi dignissimos vel at eaque! Officiis excepturi, voluptatum sapiente debitis in provident laborum natus quo dolore, hic quod animi sed.</p>
            </div>
            <div class="col-md-12">
                <!-- Adjusted the column to take full width on all screen sizes -->
                <div class="owl-carousel slider_carousel">
                    @foreach ($aparatur as $dataaparatur)
                    <div class="card_box">
                        <img src="{{ asset('storage/' . $dataaparatur->foto) }}" alt="" class="card-image w-100 h-auto">
                        <div class="card_text">
                            <h4>{{ $dataaparatur->nama }}</h4>
                            <p>{{ $dataaparatur->jabatan }}</p>
                            <p>Wa : {{ $dataaparatur->no_wa }}</p>
                            <p>{{ $dataaparatur->tempat_lahir }}, {{ $dataaparatur->tanggal_lahir }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- card area end -->
{{-- interval guard --}}
    <script>
        $(document).ready(function() {
            $('#carouselExampleInterval').carousel({
                interval: 5000
            });
        });
    </script>
@endsection
