@extends('layouts.main')

@section('main')

<div class="container pb-5">
    <h2 class="head-text text-center">Voting</h2>

    <div class="container border border-dark ">
        <h4>Silahkan Pilih Salah Satu Peserta</h4>
        <div class="row m-5">
            <div class="col-md-4 pb-3">
                <div class="card border-dark h-100 text-center" style="width: 18rem;">
                    <img src="img/Boy palestine.jpg" class="card-image mx-auto bg-dark" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Sudarianto</h5>
                      <p class="card-text">Anggota: </p>
                      <p class="card-text">Total Biaya:</p>
                      <a href="/detailvote" >Lihat detail</a>
                    </div>
                    <button type="submit" class="btn btn-success text-white btn-block mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Vote</button>

                    {{-- modal --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Voting</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Sudah yakin dengan pilihan anda?, pilihan akan disimpan silahkan tentukan pilihan anda</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <button type="button" class="btn btn-success">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="col-md-4 pb-3">
                <div class="card border-dark h-100 text-center" style="width: 18rem;">
                    <img src="img/Boy palestine.jpg" class="card-image mx-auto bg-dark" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Sudarianto</h5>
                      <p class="card-text">Anggota: </p>
                      <p class="card-text">Total Biaya:</p>
                      <a href="/detailvote" >Lihat detail</a>
                    </div>
                    <button type="submit" class="btn btn-success text-white btn-block mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Vote</button>

                    {{-- modal --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Voting</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Sudah yakin dengan pilihan anda?, pilihan akan disimpan silahkan tentukan pilihan anda</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <button type="button" class="btn btn-success">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="col-md-4 pb-3">
                <div class="card border-dark h-100 text-center" style="width: 18rem;">
                    <img src="img/Boy palestine.jpg" class="card-image mx-auto bg-dark" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Sudarianto</h5>
                      <p class="card-text">Anggota: </p>
                      <p class="card-text">Total Biaya:</p>
                      <a href="/detailvote" >Lihat detail</a>
                    </div>
                    <button type="submit" class="btn btn-success text-white btn-block mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Vote</button>

                    {{-- modal --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Voting</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p>Sudah yakin dengan pilihan anda?, pilihan akan disimpan silahkan tentukan pilihan anda</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <button type="button" class="btn btn-success">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div>

@endsection