@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-6">
            
        </div>
        <div class="col-4">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Pesan dan Saran</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="button" class="m-2 btn btn-dark">Kirim Masukan</button>
        </div>
    </div>
@endsection