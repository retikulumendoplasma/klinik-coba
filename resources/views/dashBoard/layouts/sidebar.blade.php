<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
            <span data-feather="home"></span>
            Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('kelolaBerita') ? 'active' : '' }}" href="/kelolaBerita">
            <span data-feather="file-text"></span>
            Kelola Berita
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('kelolaTender') ? 'active' : '' }}" href="/kelolaTender">
            <span data-feather="file"></span>
            Tender
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('kelolaSurat') ? 'active' : '' }}" href="/kelolaSurat">
            <span data-feather="file-plus"></span>
            Kelola Surat
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dataKeuangan') ? 'active' : '' }}" href="/dataKeuangan">
            <span data-feather="dollar-sign"></span>
            Data Keuangan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('saranMasukanAdmin') ? 'active' : '' }}" href="/saranMasukanAdmin">
            <span data-feather="inbox"></span>
            Saran dan Masukan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dataPenduduk') ? 'active' : '' }}" href="/dataPenduduk">
            <span data-feather="folder"></span>
            Update Profil Desa
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dataPenduduk') ? 'active' : '' }}" href="/dataPenduduk">
            <span data-feather="users"></span>
            Data Penduduk
            </a>
        </li>
        </ul>
    </div>
</nav>