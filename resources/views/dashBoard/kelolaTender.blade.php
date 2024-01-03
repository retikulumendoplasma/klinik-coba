@extends('dashBoard.dashboard')

@section('container')
<h2>Kelola Tender</h2>
<div class="table-responsive col-lg-8">
    <div class="row">
        <div class="col-8">
            <h4>List Tender</h4>
        </div>
        <div class="col-4">
            <button type="submit" onclick="window.location.href='/buatTender'" class="nav-link px-3 bg-success border-0 text-white"><span data-feather="plus"></span> Buat Tender</button>
        </div>
    </div>
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Judul</th>
        <th scope="col">Waktu mulai</th>
        <th scope="col">Waktu berakhir</th>
        <th class="text-center" scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($dataTender as $tender)
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $tender->judul_tender }}</td>
          <td>{{ $tender->jadwal_tender_dimulai }}</td>
          <td>{{ $tender->jadwal_tender_berakhir }}</td>
          <td>
              <a href="/kelolaTender/{{ $tender->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
              <a href="/kelolaTender/{{ $tender->id }}/editTender" class="badge bg-warning"><span data-feather="edit"></span></a>

              <!-- Form untuk delete -->
              <form action="/kelolaTender/{{ $tender->id }}" method="post" class="d-inline" >
                  @csrf
                  @method('DELETE')
                  <button class="badge bg-danger" onclick="return confirm('are you sure')"><span data-feather="x-circle"></span></button>
              </form>
              <a href="/kelolaPengajuProposal/{{ $tender->id }}" class="badge bg-success"><span data-feather="folder-minus"></span></a>
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection