@extends('layouts.main')

@section('main')
<div class="container">
    <div class="container m-5">
        <div class="row">
            <h2 class="pb-3">Silahkan masukan saran atau masukan yang membangun untuk desa kita bersama jatirejo</h2>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">Live Chat</div>
                    <div class="card-body" id="chat-box">
                        <!-- Chat content will be added here -->
                    </div>
                    <div class="card-footer">
                        <div class="input-group">
                            <input type="text" class="form-control" id="message-input" placeholder="Type your message...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" onclick="sendMessage()">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="input-groub mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Pesan dan Saran</label>
                    <input type="text" class="form-control" id="message-input" placeholder="Type your message...">
                </div>
                <button class="btn btn-success" onclick="sendMessage()">Kirim</button>
            </div>
        </div>
    </div>
</div>

@endsection