@extends('dashBoard.dashboard')

@section('container')
<h2>Data Penduduk</h2>
<div class="table-responsive col-lg-8">
    <div class="row">
        <div class="col-8">
            <input class="bg-white form-control form-control-dark w-100 border-dark" type="text" placeholder="Search" aria-label="Search">
        </div>
        <div class="col-4">
            <button type="submit" onclick="window.location.href='/tambahPenduduk'" class="nav-link px-3 bg-success border-0 text-white"><span data-feather="plus"></span> Tambah Penduduk</button>
        </div>
    </div>
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th class="text-center" scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Nama</td>
            <td class="text-center">
                <a href="" class="badge bg-info"><span data-feather="eye"></span></a>
                <a href="" class="badge bg-warning"><span data-feather="edit"></span></a>
                <a href="" class="badge bg-danger"><span data-feather="x-circle"></span></a>
            </td>
          </tr>
    </tbody>
  </table>
</div>
@endsection