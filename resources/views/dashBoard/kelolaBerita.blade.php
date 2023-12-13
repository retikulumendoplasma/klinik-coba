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
        @foreach ($news as $new)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $new->judul_berita }}</td>
            <td>{{ $new->author }}</td>
            <td>
                <a href="/berita{{ $new->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                <a href="" class="badge bg-warning"><span data-feather="edit"></span></a>
                <a href="" class="badge bg-danger"><span data-feather="x-circle"></span></a>
            </td>
          </tr>
        @endforeach
    </tbody>
  </table>
</div>


@endsection