<!-- Sidebar -->
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="width: 320px; font-size: 16px;">
    <!-- Lebar sidebar diperbesar (width: 250px) dan ukuran font ditingkatkan (font-size: 16px) -->
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <!-- Jarak antar elemen (margin-bottom: 10px) ditambahkan pada setiap nav-item -->
            <li class="nav-item" style="margin-bottom: 10px;">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard" style="padding: 15px 20px;">
                    <!-- Padding ditingkatkan (padding: 15px 20px) untuk memperbesar jarak pada elemen -->
                    <span data-feather="home" style="margin-right: 10px;"></span>
                    <!-- Margin-right ditambahkan pada ikon untuk memberikan jarak dengan teks -->
                    Dashboard
                </a>
            </li>
            <li class="nav-item" style="margin-bottom: 10px;">
                <a class="nav-link {{ Request::is('dataPasien') ? 'active' : '' }}" href="/dataPasien" style="padding: 15px 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16" style="margin-right: 10px; color: grey;">
                        <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5z"/>
                      </svg>
                    Data Pasien
                </a>
            </li>
            <li class="nav-item" style="margin-bottom: 10px;">
                <a class="nav-link {{ Request::is('rekamMedis') ? 'active' : '' }}" href="/rekamMedis" style="padding: 15px 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-journal-medical" viewBox="0 0 16 16" style="margin-right: 10px; color: grey;">
                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v.634l.549-.317a.5.5 0 1 1 .5.866L9 6l.549.317a.5.5 0 1 1-.5.866L8.5 6.866V7.5a.5.5 0 0 1-1 0v-.634l-.549.317a.5.5 0 1 1-.5-.866L7 6l-.549-.317a.5.5 0 0 1 .5-.866l.549.317V4.5A.5.5 0 0 1 8 4M5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                      </svg>
                    Rekam Medis
                </a>
            </li>
            <li class="nav-item" style="margin-bottom: 10px;">
                <a class="nav-link {{ Request::is('kelolaDokter') ? 'active' : '' }}" href="/kelolaDokter" style="padding: 15px 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16" style="margin-right: 10px; color: grey;">
                        <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
                        <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z"/>
                      </svg>
                    Data Dokter / Perawat
                </a>
            </li>
            <li class="nav-item" style="margin-bottom: 10px;">
                <a class="nav-link {{ Request::is('dataObat') ? 'active' : '' }}" href="/dataObat" style="padding: 15px 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16" style="margin-right: 10px; color: grey;">
                        <path d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429z"/>
                      </svg>
                    Data Obat
                </a>
            </li>
        </ul>
    </div>
</nav>
