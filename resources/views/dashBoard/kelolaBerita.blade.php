@extends('dashBoard.dashboard')

@section('container')
<h2>Kelola Berita</h2>
<div class="table-responsive col-lg-8">
  <div class="row">
    <div class="col-8">
        <h4>List Berita</h4>
    </div>
    <div class="col-4">
        <button type="submit" onclick="window.location.href='/tambahB'" class="nav-link px-3 bg-success border-0 text-white"><span data-feather="plus"></span> Tambah Berita</button>
    </div>
</div>
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Title</th>
        <th scope="col">Author</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($kelolaberita as $berita)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $berita->judul_berita }}</td>
            <td>{{ $berita->author }}</td>
            <td>
                <a href="/kelolaBerita/{{ $berita->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                <a href="/kelolaBerita/{{ $berita->id }}/editBerita" class="badge bg-warning"><span data-feather="edit"></span></a>

                <!-- Form untuk delete -->
                <form action="/kelolaBerita/{{ $berita->id }}" method="post" class="d-inline" >
                    @csrf
                    @method('DELETE')
                    <button class="badge bg-danger" onclick="return confirm('are you sure')"><span data-feather="x-circle"></span></button>
                </form>
            </td>
          </tr>
        @endforeach
    </tbody>
  </table>
</div>


@endsection