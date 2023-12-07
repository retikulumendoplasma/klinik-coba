@extends('layouts.main')

@section('main')
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">
        <img src="img/Gambar Mesjid Al-Ikhlas.jpg" class="d-block w-100" alt="..." height="720">
    </div>
    <div class="carousel-item" data-bs-interval="5000">
        <img src="img/Gambar Kantor Desa Jatirejo.jpg" class="d-block w-100" alt="..." height="720">
    </div>
    <div class="carousel-item" data-bs-interval="5000">
        <img src="img/Gambar Struktur Organisasi.png" class="d-block w-100" alt="..." height="720">
    </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
    </button>
</div>

{{-- jumlah penduduk start --}}
<div class="container p-5">
  <header class="row">
    <div class="col-md-12 text-center mb-4">
      <h2 class="head_text">Jumlah Penduduk Desa Jatirejo</h2>
    </div>
  </header>
  <div class="row">
    <div class="col-md-3 mb-3">
      <div class="card-body text-center">
        <img src="https://digitaldesa.id/templates/homepage/media/misc/icon-users.svg" height="65">
        <p id="totalPenduduk" name="totalPenduduk" class="jum-total">1023</p>
        <p class="des_card">Total Penduduk</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card-body text-center">
        <img src="https://digitaldesa.id/templates/homepage/media/misc/icon-users.svg" height="65">
        <p id="totalPenduduk" name="totalPenduduk" class="jum-total">321</p>
        <p class="des_card">Jumlah KK</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card-body text-center">
        <img src="https://digitaldesa.id/templates/homepage/media/misc/icon-users.svg" height="65">
        <p id="totalPendudukPria" name="totalPendudukPria" class="jum-total">434</p>
        <p class="des_card">Penduduk Laki-laki</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card-body text-center">
        <img src="https://digitaldesa.id/templates/homepage/media/misc/icon-users.svg" height="65">
        <p id="totalPendudukWanita" name="totalPendudukWanita" class="jum-total">600</p>
        <p class="des_card">Penduduk Wanita</p>
      </div>
    </div>
  </div>
</div>
{{-- jumlah penduduk end --}}

{{-- visi misi --}}
<div class="container p-5">
  <div class="row">
    <div class="col-md-12 text-center">
      <h2 class="head_text">Visi dan Misi</h2>
    </div>
  </div>
  <div class="row mt-4 mb-4">
    <div class="col-6 text-center">
      <h3>Visi</h3>
    </div>
    <div class="col-6 text-center">
      <h3>Misi</h3>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-6 col-lg-5 col-xl-5">
      <div class="card_content">
        <h5 class="pb-2">Kesejahteraan Bersama</h5>
        <p>Menjadi desa di mana kesejahteraan bersama menjadi kenyataan, dengan setiap warga menikmati tingkat hidup yang lebih baik.</p>
      </div>
    </div>
    <div class="col-2 text-center center-v">
      {{-- <i class="bi bi-arrow-down-square"></i> --}}
      <img class="icon-manfaat-digides" src="https://digitaldesa.id/templates/homepage/media/misc/icon/kecerdasan.svg" alt="aplikasi desa pintar">
    </div>
    <div class="col-6 col-lg-5 col-xl-5">
      <div class="card_content">
        <h5 class="pb-2">Pembangunan Infrastruktur yang Berkesinambungan</h5>
        <p>Merencanakan dan melaksanakan pembangunan infrastruktur yang berkelanjutan, termasuk jaringan jalan, air bersih, sanitasi, dan listrik, untuk meningkatkan kualitas hidup warga desa.</p>
      </div>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-6 col-lg-5 col-xl-5">
      <div class="card_content">
        <h5 class="pb-2">Keberlanjutan Lingkungan</h5>
        <p>Mengembangkan desa yang berkelanjutan, menjaga keindahan alam, dan meminimalkan dampak negatif terhadap lingkungan.</p>
      </div>
    </div>
    <div class="col-2 text-center center-v">
      {{-- <i class="bi bi-arrow-down-square"></i> --}}
      <img class="icon-manfaat-digides" src="https://digitaldesa.id/templates/homepage/media/misc/icon/kecepatan.svg" alt="sistem informasi desa online">
    </div>
    <div class="col-6 col-lg-5 col-xl-5">
      <div class="card_content">
        <h5 class="pb-2">Pemberdayaan Ekonomi Lokal</h5>
        <p>Menggalakkan pertumbuhan ekonomi dengan mendukung usaha mikro dan kecil, menciptakan lapangan kerja lokal, dan mendorong inovasi ekonomi untuk meningkatkan taraf hidup warga desa.</p>
      </div>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-6 col-lg-5 col-xl-5">
      <div class="card_content">
        <h5 class="pb-2">Keterlibatan Warga</h5>
        <p>Menciptakan desa inklusif dengan melibatkan aktif seluruh warga dalam proses pengambilan keputusan dan pembangunan.</p>
      </div>
    </div>
    <div class="col-2 text-center">
      {{-- <i class="bi bi-arrow-down-square"></i> --}}
      <img class="icon-manfaat-digides" src="https://digitaldesa.id/templates/homepage/media/misc/icon/jangkauan.svg" alt="aplikasi e desa">
    </div>
    <div class="col-6 col-lg-5 col-xl-5">
      <div class="card_content">
        <h5 class="pb-2">Konservasi Lingkungan dan Warisan Budaya</h5>
        <p>Melindungi dan mempertahankan keanekaragaman alam serta warisan budaya desa, sambil mempromosikan praktik berkelanjutan dan kesadaran lingkungan dikalangan warga.</p>
      </div>
    </div>
  </div>
</div>
{{-- visi misi end --}}

<!-- card area start -->
<div class="card-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="head_text">Aparatur Desa Jatirejo</h2>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores culpa, commodi dignissimos vel at eaque! Officiis excepturi, voluptatum sapiente debitis in provident laborum natus quo dolore, hic quod animi sed.</p>
      </div>
      <div class="col-12">
        <div class="owl-carousel slider_carousel">
          <div class="card_box">
            <img src="img/Boy palestine.jpg" alt="" class="card-image w-100">
            <div class="card_text">
              <h4>Sudarianto</h4>
              <p>Kepala Desa Jatirejo</p>
              <p>1967, 14 Juni Jatirejo</p>
            </div>
          </div>
          <div class="card_box">
            <img src="img/Palestina.jpg" alt="" class="card-image w-100">
            <div class="card_text">
              <h4>Febry Aji</h4>
              <p>Sekretaris</p>
              <p>2001, 09 April Purwodadi</p>
            </div>
          </div>
          <div class="card_box">
            <img src="img/Boy palestine.jpg" alt="" class="card-image w-100">
            <div class="card_text">
              <h4>Bani Ilyas</h4>
              <p>Kepala Dusun Sukaramai</p>
              <p>2001, 27 Mei Purworejo</p>
            </div>
          </div>
          <div class="card_box">
            <img src="img/Palestina.jpg" alt="" class="card-image w-100">
            <div class="card_text">
              <h4>Pranata</h4>
              <p>Seksi Keamanan</p>
              <p>2001, 07 July Belawan</p>
            </div>
          </div>
          <div class="card_box">
            <img src="img/Palestina.jpg" alt="" class="card-image w-100">
            <div class="card_text">
              <h4>Febry Aji</h4>
              <p>Sekretaris</p>
              <p>2001, 09 April Purwodadi</p>
            </div>
          </div>
          <div class="card_box">
            <img src="img/Palestina.jpg" alt="" class="card-image w-100">
            <div class="card_text">
              <h4>Febry Aji</h4>
              <p>Sekretaris</p>
              <p>2001, 09 April Purwodadi</p>
            </div>
          </div>
          <div class="card_box">
            <img src="img/Palestina.jpg" alt="" class="card-image w-100">
            <div class="card_text">
              <h4>Febry Aji</h4>
              <p>Sekretaris</p>
              <p>2001, 09 April Purwodadi</p>
            </div>
          </div>
          <div class="card_box">
            <img src="img/Palestina.jpg" alt="" class="card-image w-100">
            <div class="card_text">
              <h4>Febry Aji</h4>
              <p>Sekretaris</p>
              <p>2001, 09 April Purwodadi</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- card area end -->

@endsection