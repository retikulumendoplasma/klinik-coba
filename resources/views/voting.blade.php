@extends('layouts.main')

@section('main')


<div class="container pb-5">
  <h2 class="head-text text-center">Voting</h2>

  <div class="container border border-dark">
      <h4>Silahkan Pilih Salah Satu Peserta</h4>
      <div class="row m-5">
          @foreach ($pengajuProposal as $pengaju)
            @if ($pengaju->status_pengajuan == 'diterima')
              <div class="col-md-4 pb-3">
                <div class="card border-dark h-100 text-center" style="width: 18rem;">
                    <img src="{{$pengaju->foto_pengaju}}" class="card-img-top" alt="Pengaju Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pengaju->nama }}</h5>
                        <a href="/detailvote" class="btn btn-dark">Lihat Detail</a>

                        @php
                        $existingVote = \App\Models\voting_tender::where('tender_id', $tender->id)
                                             ->where('user_id', auth()->user()->id)
                                             ->first();
                        @endphp

                      @if (!$existingVote)
                        <form action="/voting/{{ $pengaju->id }}" method="POST">
                          @csrf
                          <input type="hidden" name="tender_id" value="{{ $tender->id }}">
                          <input type="hidden" name="proposal_id" value="{{ $pengaju->id }}">
                          {{-- <input type="hidden" name="proposal_id" value="{{ $pengaju->id}}"> --}}
                          <button type="submit" class="btn btn-success text-white btn-block mb-3">Vote</button>
                        </form>
                      @else
                        @if ($existingVote->proposal_id == $pengaju->id)
                            <form action="/voting/{{ $existingVote->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-white btn-block mb-3">Batalkan Pilihan</button>
                            </form>
                        @else
                            <p class="text-success">Terimakasih sudah memilih</p>
                        @endif
                      @endif
                    </div>

                </div>
              </div>
            @endif
          @endforeach
      </div>
  </div>
</div>

@endsection