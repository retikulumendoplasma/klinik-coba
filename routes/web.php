<?php

use App\Http\Controllers\AdminDataPasienController;
use App\Http\Controllers\AdminPengurusanSuratController;
use App\Http\Controllers\adminTambahPendudukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DataDokterController;
use App\Http\Controllers\KelolaBeritaController;
use App\Http\Controllers\PengurusanSuratController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\KeuanganDesaController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\SaranDanMasukanController;
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
Route::get('/home', [BeritaController::class, 'home']);

// login or regis
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest:akun_user');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest:akun_user');
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'register'])->middleware('guest:akun_user');
Route::post('/register', [RegisterController::class, 'store']);

// berita
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{id}', [BeritaController::class, 'tampil']);

// profile desa
Route::get('/profildesa', [DataDokterController::class, 'index']);

// data keuangan
Route::get('/rencanaanggaran', [KeuanganDesaController::class, 'rencana'])->middleware('auth:akun_user');
// Route::get('/view-pdf/{filename}', [KeuanganDesaController::class, 'viewPdf'])->name('view-pdf');
Route::get('/laporankeuangan', [KeuanganDesaController::class, 'laporan'])->middleware('auth:akun_user');

// tender
Route::get('/tender', [TenderController::class, 'tampil']);
Route::get('/tenderVote', [TenderController::class, 'tampilVote']);
Route::get('/voting/{tender}', [TenderController::class, 'voting'])->middleware('auth:akun_user');
Route::post('/voting/{id}', [TenderController::class, 'pilih'])->middleware('auth:akun_user');
Route::delete('/voting/{id}', [TenderController::class, 'batalVoting']);
Route::get('/pengajuanTender/{tender}', [TenderController::class, 'showPengajuanForm'])->name('pengajuanTender')->middleware('auth:akun_user');
Route::post('/pengajuanTender', [TenderController::class, 'storeProposal'])->name('tender.storeProposal')->middleware('auth:akun_user');
Route::get('/detailvote/{id}', [TenderController::class, 'detailVote'])->name('tender.detailVote')->middleware('auth:akun_user');

// pengurusan surat
Route::get('/suratkurangmampu',[PengurusanSuratController::class, 'suratkurangmampu'])->middleware('auth:akun_user');
Route::post('/ajukansurat', [PengurusanSuratController::class, 'store'])->middleware('auth:akun_user');
Route::get('/suratkematian',[PengurusanSuratController::class, 'suratkematian'])->middleware('auth:akun_user');
Route::get('/suratdomisili',[PengurusanSuratController::class, 'suratdomisili'])->middleware('auth:akun_user');
Route::get('/suratmenikah',[PengurusanSuratController::class, 'suratmenikah'])->middleware('auth:akun_user');
Route::get('/getPendudukData/{nik}', [PengurusanSuratController::class, 'getPenduduk']);

// lihat pengajuan
Route::get('/pengajuanSurat', [PengurusanSuratController::class, 'cari'])->middleware('auth:akun_user');
// Route::get('/cariSurat', [PengurusanSuratController::class, 'cari'])->middleware('auth:akun_user');
Route::get('/berhasilurussurat/{id}', [PengurusanSuratController::class, 'berhasil'])->middleware('auth:akun_user');
Route::get('/pengajuanProposalTender', [TenderController::class, 'statusPengajuan'])->middleware('auth:akun_user');
Route::get('/berhasilurusproposal/{id}', [TenderController::class, 'berhasil'])->middleware('auth:akun_user');

// saran dan masukan
Route::get('/saranmasukan', [SaranDanMasukanController::class, 'index'])->middleware('auth:akun_user');
Route::post('/berisaran', [SaranDanMasukanController::class, 'store'])->middleware('auth:akun_user');


// ................ ROUTE ADMIN ...............//

// Dashboard Admin
Route::get('/dashboard', [AdminPengurusanSuratController::class, 'adminhome'])->middleware('auth:akun_user');

// kelola berita
Route::get('/kelolaBerita', [BeritaController::class, 'data'])->middleware('auth:akun_user');
Route::get('/kelolaBerita/{berita:id}', [BeritaController::class, 'lihat']);
Route::delete('/kelolaBerita/{id}', [BeritaController::class, 'destroy']);
Route::get('/tambahB', [BeritaController::class, 'create'])->middleware('auth:akun_user');
Route::post('/tambahB', [BeritaController::class, 'store'])->middleware('auth:akun_user');
Route::get('/kelolaBerita/{berita:id}/editBerita', [BeritaController::class, 'edit'])->middleware('auth:akun_user');
Route::put('/tambahB/{berita:id}', [BeritaController::class, 'update'])->middleware('auth:akun_user');

// kelola data pasien
Route::get('/dataPasien', [AdminDataPasienController::class, 'index'])->middleware('auth:akun_user');
Route::get('/viewdataPasien/{patients:id_pasien}', [AdminDataPasienController::class, 'show'])->middleware('auth:akun_user');
Route::delete('/dataPasien/{id_pasien}', [AdminDataPasienController::class, 'destroy']);
Route::get('/tambahPasien', [AdminDataPasienController::class,'create'])->middleware('auth:akun_user');
Route::post('/tambahPasien', [AdminDataPasienController::class,'store'])->middleware('auth:akun_user');
Route::get('/dataPasien/{patients:id_pasien}/editPasien', [AdminDataPasienController::class, 'edit'])->middleware('auth:akun_user');
Route::put('/editPasien/{patients:id_pasien}', [AdminDataPasienController::class, 'update'])->middleware('auth:akun_user');

// kelola data dokter/perawat
Route::get('/kelolaDokter', [DataDokterController::class, 'kelolaTampil'])->middleware('auth:akun_user');
Route::get('/tambahDokter', [DataDokterController::class, 'create'])->middleware('auth:akun_user');
Route::post('/tambahDokter', [DataDokterController::class, 'store'])->middleware('auth:akun_user');
Route::get('/kelolaDokter/{medical_staff:id_dokter}/editDokter', [DataDokterController::class, 'edit'])->middleware('auth:akun_user');
Route::put('/tambahDokter/{medical_staff:id_dokter}', [DataDokterController::class, 'update'])->middleware('auth:akun_user');
Route::delete('/kelolaDokter/{id_dokter}', [DataDokterController::class, 'destroy'])->middleware('auth:akun_user');
Route::get('/viewDokter/{id_dokter}', [DataDokterController::class, 'show'])->middleware('auth:akun_user');

// saran dan masukan
Route::get('/saranMasukanAdmin', [SaranDanMasukanController::class, 'indexsaran'])->middleware('auth:akun_user');
Route::get('/balasSaran/{saran:id}/balas', [SaranDanMasukanController::class, 'indexbalasan'])->middleware('auth:akun_user');
Route::post('/balasSaran/{saran:id}', [SaranDanMasukanController::class, 'storebalasan'])->middleware('auth:akun_user');
Route::post('/berisaran', [SaranDanMasukanController::class, 'store'])->middleware('auth:akun_user');
Route::put('/editbalasan/{saran:id}', [SaranDanMasukanController::class, 'update'])->middleware('auth:akun_user');

// Rekam Medis
Route::get('/rekamMedis', [RekamMedisController::class, 'index'])->middleware('auth:akun_user');
Route::get('/rekamMedisPasien/{patients:id_pasien}', [RekamMedisController::class, 'dataRekamMedisPasien'])->middleware('auth:akun_user');
Route::get('/tambahRekamMedis', [RekamMedisController::class, 'formTambahRekamMedis'])->middleware('auth:akun_user');
Route::post('/tambahRekamMedis', [RekamMedisController::class, 'storeTambahRekamMedis'])->middleware('auth:akun_user');
Route::get('/search-pasien', [RekamMedisController::class, 'searchPasien'])->name('searchPasien');
Route::delete('/rekamMedis/{mr}', [RekamMedisController::class, 'destroy']);
Route::delete('/rekamMedisPasien/{mr}', [RekamMedisController::class, 'destroyer']);
Route::post('/balasSaran/{saran:id}', [RekamMedisController::class, 'storebalasan'])->middleware('auth:akun_user');
Route::post('/berisaran', [RekamMedisController::class, 'store'])->middleware('auth:akun_user');
Route::put('/editbalasan/{saran:id}', [RekamMedisController::class, 'update'])->middleware('auth:akun_user');