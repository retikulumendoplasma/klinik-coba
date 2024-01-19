@extends('layouts.main')

@section('main')
<div class="container m-5 mx-auto">
    <div class="row">
        <h2 class="pb-3">Silahkan masukan saran atau masukan yang membangun untuk desa kita bersama Jatirejo</h2>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">Live Chat</div>
                <div class="card-body" id="chat-box">
                    <!-- Chat content will be added here -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-3">
                <h4>Silahkan masukkan saran dan masukan</h4>
                <label for="exampleFormControlTextarea1" class="form-label"></label>
                <input type="text" class="form-control" id="message-input" placeholder="Type your message..." style="width: 80%;"> <!-- Sesuaikan nilai width -->
            </div>
            <button class="btn btn-success" onclick="sendMessage()">Kirim</button>
        </div>
    </div>
</div>
@endsection