<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="img/Logo Nagan Raya.jpg" alt="Bootstrap" width="30" height="24">
            Desa Jatirejo
        </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Berita") ? 'active' : '' }}" href="/berita">Berita</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Tender
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Pengajuan Tender</a></li>
              <li><a class="dropdown-item" href="#">Voting Tender</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Pengurusan Surat
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/suratkurangmampu">Surat Keterangan Tidak Mampu</a></li>
              <li><a class="dropdown-item" href="/suratkematian">Surat Keterangan Meninggal Dunia</a></li>
              <li><a class="dropdown-item" href="/suratdomisili">Surat Keterangan Domisili</a></li>
              <li><a class="dropdown-item" href="/suratmenikah">Surat Keterangan Belum/Sudah Menikah</a></li>
            </ul>
          </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Keuangan Desa
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item {{ ($title === "Rencana anggaran") ? 'active' : '' }}" href="/rencanaanggaran">Rencana Anggaran</a></li>
              <li><a class="dropdown-item {{ ($title === "Laporan keuangan") ? 'active' : '' }}" href="/laporankeuangan">Laporan Keuangan</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Saran dan Masukan") ? 'active' : '' }}" href="/saranmasukan">Saran dan Masukan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Berita") ? 'active' : '' }}" href="#">Profil Desa</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="/login" class="nav-link {{ ($title === "Login") ? 'active' : '' }}"><i class="bi bi-box-arrow-in-right"></i>Login</a>
          </li>
        </ul>
      </div>
    </div>
</nav>