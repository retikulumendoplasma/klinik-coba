<?php

use App\Models\Berita;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengurusanSuratController;
use App\Http\Controllers\RegisterController;


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

Route::get('/berita/{berita}', [BeritaController::class, 'tampil']);

Route::get('/profildesa', function () {
    return view('profildesa',[
        "title" => "Profil Desa"
    ]);
});

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

Route::get('/suratkurangmampu',[PengurusanSuratController::class, 'suratkurangmampu'])->middleware('auth:akun_user');

Route::get('/suratdomisili', function () {
    return view('suratdomisili',[
        "title" => "Surat Keterangan Domisili"
    ]);
})->middleware('auth:akun_user');

Route::get('/suratmenikah', function () {
    return view('suratmenikah',[
        "title" => "Surat Keterangan Sudah/Belum Menikah"
    ]);
})->middleware('auth:akun_user');

Route::get('/suratkematian', function () {
    return view('suratkematian',[
        "title" => "Surat Keterangan Meninggal Dunia"
    ]);
})->middleware('auth:akun_user');

Route::get('/saranmasukan', function () {
    return view('saranmasukan',[
        "title" => "Saran dan Masukan"
    ]);
})->middleware('auth:akun_user');