@extends('dashBoard.dashboard')

@section('container')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">Live Chat</div>
                <div class="card-body chat-container" id="chat-box">
                    <!-- Chat content will be added here -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-3">
                <h4>Reply to User</h4>
                <input type="text" class="form-control" id="message-input" placeholder="Type your message...">
                <div class="input-group-append">
                    <button class="btn btn-success" type="button" onclick="sendMessage()">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection