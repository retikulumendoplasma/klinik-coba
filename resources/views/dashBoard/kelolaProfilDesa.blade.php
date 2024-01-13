@extends('dashBoard.dashboard')

@section('container')
<h2>Kelola Profil Desa</h2>
<div class="table-responsive col-lg-8 m-5">
    <div class="row">
        <div class="col-8">
            <h4>List Aparatur</h4>
        </div>
        <div class="col-4">
            <button type="submit" onclick="window.location.href='/tambahAparatur'" class="nav-link px-3 bg-success border-0 text-white"><span data-feather="plus"></span> Tambah Aparatur</button>
        </div>
    </div>
    {{-- <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Jabatan</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($kelolaProfilDesa as $kelola)
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
            @endforeach
        </tbody>
    </table> --}}
</div>


@endsection