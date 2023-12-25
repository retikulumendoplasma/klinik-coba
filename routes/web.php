<?php

use App\Http\Controllers\adminDataPendudukController;
use App\Http\Controllers\adminTambahPendudukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfildesaController;
use App\Http\Controllers\KelolaBeritaController;
use App\Http\Controllers\PengurusanSuratController;


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

Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest:akun_user');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'register'])->middleware('guest:akun_user');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/berita', [BeritaController::class, 'index']);

Route::get('/berita/{id}', [BeritaController::class, 'tampil']);

Route::get('/profildesa', [ProfildesaController::class, 'index']);

Route::get('/laporankeuangan', function () {
    return view('laporankeuangan',[
        "title" => "Laporan keuangan"
    ]);
});

Route::get('/rencanaanggaran', function () {
    return view('rencanaanggaran',[
        "title" => "Rencana anggaran"
    ]);
});

Route::get('/tender', function () {
    return view('tender',[
        "title" => "Pengajuan Tender"
    ]);
});

Route::get('/tenderVote', function () {
    return view('tenderVote',[
        "title" => "Tender Voting"
    ]);
});

Route::get('/pengajuanTender', function () {
    return view('pengajuanTender',[
        "title" => "Pengajuan Proposal"
    ]);
});

Route::get('/voting', function () {
    return view('voting',[
        "title" => "Voting"
    ]);
});

Route::get('/detailvote', function () {
    return view('detailvote',[
        "title" => "Detail"
    ]);
});


Route::get('/suratkurangmampu',[PengurusanSuratController::class, 'suratkurangmampu'])->middleware('auth:akun_user');
Route::get('/suratkematian',[PengurusanSuratController::class, 'suratkematian'])->middleware('auth:akun_user');
Route::get('/suratdomisili',[PengurusanSuratController::class, 'suratdomisili'])->middleware('auth:akun_user');
Route::get('/suratmenikah',[PengurusanSuratController::class, 'suratmenikah'])->middleware('auth:akun_user');
Route::get('/getPendudukData/{nik}', [PengurusanSuratController::class, 'getPenduduk']);

Route::get('/saranmasukan', function () {
    return view('saranmasukan',[
        "title" => "Saran dan Masukan"
    ]);
})->middleware('auth:akun_user');

// route admin
// Route::resource('/dashboard/kelolaBerita', KelolaBeritaController::class)->middleware('auth:akun_user');

Route::get('/dashboard', function () {
    return view('dashBoard.beranda', [
        "title" => "Beranda"
    ]);
})->middleware('auth:akun_user');

Route::get('/kelolaBerita/{new:slug}', [KelolaBeritaController::class, 'show']);

Route::get('/kelolaBerita', [KelolaBeritaController::class, 'kelolaBerita'])->middleware('auth:akun_user');

Route::get('/dataPenduduk', [adminDataPendudukController::class, 'index'])->middleware('auth:akun_user');

Route::get('/kelolaTender', function () {
    return view('dashBoard.kelolaTender', [
        "title" => "Kelola Tender"
    ]);
})->middleware('auth:akun_user');

Route::get('/buatTender', function () {
    return view('dashBoard.buatTender', [
        "title" => "Buat Tender"
    ]);
})->middleware('auth:akun_user');

Route::get('/tambahPenduduk', [adminTambahPendudukController::class, 'create'])->middleware('auth:akun_user');
Route::post('/tambahPenduduk', [adminTambahPendudukController::class, 'store'])->middleware('auth:akun_user');

Route::get('/kelolaSurat', function () {
    return view('dashBoard.kelolaSurat', [
        "title" => "Kelola Surat"
    ]);
})->middleware('auth:akun_user');

Route::get('/saranMasukanAdmin', function () {
    return view('dashBoard.saranMasukanAdmin', [
        "title" => "Saran Masukan"
    ]);
})->middleware('auth:akun_user');

Route::get('/dataKeuangan', function () {
    return view('dashBoard.dataKeuangan', [
        "title" => "Data Keuangan"
    ]);
})->middleware('auth:akun_user');

Route::get('/tambahB', function () {
    return view('dashBoard.tambahB', [
        "title" => "Tambah Berita"
    ]);
})->middleware('auth:akun_user');