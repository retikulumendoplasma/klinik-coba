@extends('layouts.main')

@section('main')

<div class="container text-center pb-5 border border-dark my-5">
    <img src="img/jongek.jpg" alt="Your Image" class="rounded-circle mx-auto p-3" height="250" width="250">
    <h2 class="head-text">Meysa Syafrina</h2>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">Proposal</div>
                    <div class="card-body">
                        <embed id="pdf-viewer" src="https://drive.google.com/uc?id=1MtbyQMEdzOLKE_1Czav03Ma69Wh8vTXb" type="application/pdf" width="100%" height="600px">
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-success" href="path/to/your/file.pdf" download>Download PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="head-text pb-3">Vidio presentasi</h2>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/TQQJD7D6PIU" allowfullscreen></iframe>
        </div>
    </div>
    
</div>

@endsection