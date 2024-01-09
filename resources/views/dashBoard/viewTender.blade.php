@extends('dashBoard.dashboard')

@section('container')
<div class="container pb-5">
    <article class="py-4">
        <img src="{{ $dataTender->gambar_tender }}" class="img_dberita card-img-top img-fluid" alt="..."> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $dataTender->judul_tender }}</h2>
        <h5 class="font-semibold">Tender dimulai pada: {{ $dataTender->jadwal_tender_dimulai }}</h5>
        <h5 class="font-semibold">Tender berakhir pada: {{ $dataTender->jadwal_tender_berakhir }}</h5>
    </article>
    
    <a href="/kelolaTender" class="btn-success"><span data-feather="arrow left">Kembali</span></a>
    <a href="/kelolaTender/{{ $dataTender->id }}/editTender" class="btn-warning"><span data-feather="edit">Edit</span></a>
    <!-- Form untuk delete -->
    <form action="#" method="post" class="d-inline" >
        @csrf
        @method('DELETE')
        <button class="badge bg-danger" onclick="return confirm('are you sure')"><span data-feather="x-circle"></span>hapus</button>
    </form>  
    
</div>


@endsection