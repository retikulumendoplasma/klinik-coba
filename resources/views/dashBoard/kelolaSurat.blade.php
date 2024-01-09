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
      @foreach ($dataSurat as $surat)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $surat->jenis_surat }}</td>
          <td>{{ $surat->nama }}</td>
          <td>{{ $surat->nik }}</td>
          <td>{{ $surat->status_surat }}</td>
          <td>
              <a href="/kelolaSurat/{{ $surat->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
              <a href="/kelolaSurat/{{ $surat->id }}/editsurat" class="badge bg-warning"><span data-feather="edit"></span></a>

              <!-- Form untuk delete -->
              <form action="/kelolaSurat/{{ $surat->id }}" method="post" class="d-inline" >
                  @csrf
                  @method('DELETE')
                  <button class="badge bg-danger" onclick="return confirm('are you sure')"><span data-feather="x-circle"></span></button>
              </form>
              <a href="/kelolaPengajuProposal/{{ $surat->id }}" class="badge bg-success"><span data-feather="folder-minus"></span></a>
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection