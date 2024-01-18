@extends('dashBoard.dashboard')

@section('container')
<h2>Kelola Profil Desa</h2>
<div class="table-responsive col-lg-8 m-5">
    <div class="row">
        <div class="col-8">
            <h4>List Aparatur</h4>
        </div>
        <div class="col-4">
            <button type="submit" onclick="window.location.href='/tambahAparatur'" class="nav-link px-3 bg-success border-0 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                  </svg>
                Tambah Aparatur
            </button>
        </div>
    </div>
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Jabatan</th>
        </tr>
        </thead>
        <tbody>
            {{-- @foreach ($kelolaProfilDesa as $kelola)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kelola->nama }}</td>
                <td>{{ $kelola->jabatan }}</td>
                <td>
                    <a href="/kelolaBerita/{{ $kelola->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                    <a href="/kelolaBerita/{{ $kelola->id }}/editBerita" class="badge bg-warning"><span data-feather="edit"></span></a>

                    <!-- Form untuk delete -->
                    <form action="/kelolaBerita/{{ $kelola->id }}" method="post" class="d-inline" >
                        @csrf
                        @method('DELETE')
                        <button class="badge bg-danger" onclick="return confirm('are you sure')"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>


@endsection