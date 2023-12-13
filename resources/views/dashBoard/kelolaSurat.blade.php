@extends('dashBoard.dashboard')

@section('container')
<h2>Kelola Surat</h2>
<div class="table-responsive col-lg-8">
<input class="bg-white form-control form-control-dark w-100 border-dark mb-3" type="text" placeholder="Search" aria-label="Search">   
  <table class="table table-striped table-sm " style="border: 2px solid #343a40;">
    <thead class="bg-success">
      <tr>
        <th scope="col">No</th>
        <th scope="col">Jenis Surat</th>
        <th scope="col">Nama</th>
        <th scope="col">NIK</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Jenis Surat</td>
            <td>Nama</td>
            <td>NIK</td>
            <td>Status</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Jenis Surat</td>
            <td>Nama</td>
            <td>NIK</td>
            <td>Status</td>
        </tr>
    </tbody>
  </table>
</div>
@endsection