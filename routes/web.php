<?php

use App\Models\Berita;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;


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

Route::get('/berita', [BeritaController::class, 'index']);

Route::get('berita/{slug}', [BeritaController::class, 'tampil']);

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

Route::get('/suratdomisili', function () {
    return view('suratdomisili',[
        "title" => "Surat Keterangan Domisili"
    ]);
});

Route::get('/suratmenikah', function () {
    return view('suratmenikah',[
        "title" => "Surat Keterangan Sudah/Belum Menikah"
    ]);
});

Route::get('/suratkematian', function () {
    return view('suratkematian',[
        "title" => "Surat Keterangan Meninggal Dunia"
    ]);
});

Route::get('/suratkurangmampu', function () {
    return view('suratkurangmampu',[
        "title" => "Surat Keterangan Tidak Mampu"
    ]);
});

Route::get('/saranmasukan', function () {
    return view('saranmasukan',[
        "title" => "Saran dan Masukan"
    ]);
});