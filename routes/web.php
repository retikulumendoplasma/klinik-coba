<?php

use App\Http\Controllers\adminDataPendudukController;
use App\Http\Controllers\AdminPengurusanSuratController;
use App\Http\Controllers\adminTambahPendudukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfildesaController;
use App\Http\Controllers\KelolaBeritaController;
use App\Http\Controllers\PengurusanSuratController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\KeuanganDesaController;
use App\Http\Controllers\UploadProposalController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BeritaController::class, 'home']);

// login or regis
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest:akun_user');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'register'])->middleware('guest:akun_user');
Route::post('/register', [RegisterController::class, 'store']);

// berita
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{id}', [BeritaController::class, 'tampil']);

// profile desa
Route::get('/profildesa', [ProfildesaController::class, 'index']);

// data keuangan
Route::get('/rencanaanggaran', [KeuanganDesaController::class, 'rencana'])->middleware('auth:akun_user');
Route::get('/laporankeuangan', [KeuanganDesaController::class, 'laporan'])->middleware('auth:akun_user');

// tender
Route::get('/tender', [TenderController::class, 'tampil']);
Route::get('/tenderVote', [TenderController::class, 'tampilVote'])->middleware('auth:akun_user');
Route::get('/voting/{tender}', [TenderController::class, 'voting'])->middleware('auth:akun_user');
Route::post('/voting/{id}', [TenderController::class, 'pilih'])->middleware('auth:akun_user');
Route::delete('/voting/{id}', [TenderController::class, 'batalVoting']);
Route::get('/pengajuanTender/{tender}', [TenderController::class, 'showPengajuanForm'])->name('pengajuanTender');
Route::post('/pengajuanTender', [TenderController::class, 'storeProposal'])->name('tender.storeProposal')->middleware('auth:akun_user');

Route::get('/detailvote', function () {
    return view('detailvote',[
        "title" => "Detail"
    ]);
});

// pengurusan surat
Route::get('/suratkurangmampu',[PengurusanSuratController::class, 'suratkurangmampu'])->middleware('auth:akun_user');
Route::post('/ajukansurat', [PengurusanSuratController::class, 'store'])->middleware('auth:akun_user');
Route::get('/suratkematian',[PengurusanSuratController::class, 'suratkematian'])->middleware('auth:akun_user');
Route::get('/suratdomisili',[PengurusanSuratController::class, 'suratdomisili'])->middleware('auth:akun_user');
Route::get('/suratmenikah',[PengurusanSuratController::class, 'suratmenikah'])->middleware('auth:akun_user');
Route::get('/getPendudukData/{nik}', [PengurusanSuratController::class, 'getPenduduk']);

// lihat pengajuan
Route::get('/pengajuanSurat', [AdminPengurusanSuratController::class, 'statusPengajuan'])->middleware('auth:akun_user');
Route::get('/berhasilurussurat/{id}', [PengurusanSuratController::class, 'berhasil'])->middleware('auth:akun_user');
Route::get('/pengajuanProposalTender', [TenderController::class, 'statusPengajuan'])->middleware('auth:akun_user');
Route::get('/berhasilurusproposal/{id}', [TenderController::class, 'berhasil'])->middleware('auth:akun_user');


Route::get('/saranmasukan', function () {
    return view('saranmasukan',[
        "title" => "Saran dan Masukan"
    ]);
})->middleware('auth:akun_user');

// route admin
Route::get('/dashboard', function () {
    return view('dashBoard.beranda', [
        "title" => "Beranda"
    ]);
})->middleware('auth:akun_user');

Route::get('/kelolaBerita', [BeritaController::class, 'data'])->middleware('auth:akun_user');
Route::get('/kelolaBerita/{berita:id}', [BeritaController::class, 'lihat']);
Route::delete('/kelolaBerita/{id}', [BeritaController::class, 'destroy']);
Route::get('/tambahB', [BeritaController::class, 'create'])->middleware('auth:akun_user');
Route::post('/tambahB', [BeritaController::class, 'store'])->middleware('auth:akun_user');
Route::get('/kelolaBerita/{berita:id}/editBerita', [BeritaController::class, 'edit'])->middleware('auth:akun_user');
Route::put('/tambahB/{berita:id}', [BeritaController::class, 'update'])->middleware('auth:akun_user');

Route::get('/dataPenduduk', [adminDataPendudukController::class, 'index'])->middleware('auth:akun_user');
Route::get('/viewdataPenduduk/{penduduk:nik}', [adminDataPendudukController::class, 'show'])->middleware('auth:akun_user');
Route::delete('/dataPenduduk/{nik}', [adminDataPendudukController::class, 'destroy']);
Route::get('/tambahPenduduk', [adminDataPendudukController::class,'create'])->middleware('auth:akun_user');
Route::post('/tambahPenduduk', [adminDataPendudukController::class,'store'])->middleware('auth:akun_user');
Route::get('/dataPenduduk/{penduduk:nik}/editPenduduk', [adminDataPendudukController::class, 'edit'])->middleware('auth:akun_user');
Route::put('/tambahPenduduk/{penduduk:nik}', [adminDataPendudukController::class, 'update'])->middleware('auth:akun_user');

Route::get('/kelolaTender', [TenderController::class, 'index'])->middleware('auth:akun_user');
Route::get('/kelolaTender/{tender:id}', [TenderController::class, 'viewT'])->middleware('auth:akun_user');
Route::get('/buatTender', [TenderController::class, 'create'])->middleware('auth:akun_user');
Route::post('/buatTender', [TenderController::class, 'store'])->middleware('auth:akun_user');
Route::delete('/kelolaTender/{tender}', [TenderController::class, 'destroy']);
Route::get('/kelolaTender/{tender:id}/editTender', [TenderController::class, 'edit'])->middleware('auth:akun_user');
Route::put('/buatTender/{tender:id}', [TenderController::class, 'update'])->middleware('auth:akun_user');

Route::get('/kelolaPengajuProposal/{tender}', [TenderController::class, 'proposal'])->name('kelolaPengajuProposal');
Route::get('/viewProposal/{tender}', [TenderController::class, 'viewProposal'])->name('viewProposal');
Route::post('/kelolaPengajuProposal/{id}', [TenderController::class, 'approveProposal'])->middleware('auth:akun_user');
Route::delete('/kelolaPengajuProposal/{id}', [TenderController::class, 'tolakProposal'])->middleware('auth:akun_user');

Route::get('/kelolaProfilDesa', [ProfildesaController::class, 'kelolaTampil'])->middleware('auth:akun_user');
Route::get('/tambahAparatur', [ProfildesaController::class, 'create'])->middleware('auth:akun_user');

Route::get('/kelolaSurat', [AdminPengurusanSuratController::class, 'tampildata'])->middleware('auth:akun_user');
Route::get('/viewSurat/{surat:id}', [AdminPengurusanSuratController::class, 'lihat']);
Route::post('/kelolaPengajusurat/{id}', [AdminPengurusanSuratController::class, 'terimasurat']);
Route::delete('/kelolaPengajusurat/{id}', [AdminPengurusanSuratController::class, 'tolaksurat']);

Route::get('/saranMasukanAdmin', function () {
    return view('dashBoard.saranMasukanAdmin', [
        "title" => "Saran Masukan"
    ]);
})->middleware('auth:akun_user');

Route::get('/dataKeuangan', [KeuanganDesaController::class, 'index'])->middleware('auth:akun_user');
Route::get('/buatLaporan', [KeuanganDesaController::class, 'create'])->middleware('auth:akun_user');
Route::post('/buatLaporan', [KeuanganDesaController::class, 'store'])->middleware('auth:akun_user');
Route::get('/dataKeuangan/{laporan:id}/editKeuangan', [KeuanganDesaController::class, 'edit'])->middleware('auth:akun_user');
Route::post('/buatLaporan{laporan:id}', [KeuanganDesaController::class, 'update'])->middleware('auth:akun_user');
