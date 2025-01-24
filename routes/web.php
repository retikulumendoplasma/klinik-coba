<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DataObatController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DataDokterController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDataPasienController;
use App\Http\Controllers\AdminPengurusanSuratController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\TransaksiController;


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

// Route::get('/', [BeritaController::class, 'home']);
// Route::get('/home', [BeritaController::class, 'home']);

// login or regis
Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('guest:akun_user');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest:akun_user');
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'register'])->middleware('guest:akun_user');
Route::post('/register', [RegisterController::class, 'store']);

// ................ ROUTE ADMIN ...............//

// Dashboard Admin
Route::get('/dashboard', [AdminDashboardController::class, 'adminhome'])->middleware('auth:akun_user');

// kelola data pasien
Route::get('/dataPasien', [AdminDataPasienController::class, 'index'])->middleware('auth:akun_user');
Route::get('/viewdataPasien/{patients:nomor_rekam_medis}', [AdminDataPasienController::class, 'show'])->middleware('auth:akun_user');
Route::delete('/dataPasien/{nomor_rekam_medis}', [AdminDataPasienController::class, 'destroy']);
Route::get('/tambahPasien', [AdminDataPasienController::class,'create'])->middleware('auth:akun_user');
Route::post('/tambahPasien', [AdminDataPasienController::class,'store'])->middleware('auth:akun_user');
Route::get('/dataPasien/{patients:nomor_rekam_medis}/editPasien', [AdminDataPasienController::class, 'edit'])->middleware('auth:akun_user');
Route::put('/editPasien/{patients:nomor_rekam_medis}', [AdminDataPasienController::class, 'update'])->middleware('auth:akun_user');

// kelola data dokter/perawat
Route::get('/kelolaDokter', [DataDokterController::class, 'kelolaTampil'])->middleware('auth:akun_user');
Route::get('/tambahDokter', [DataDokterController::class, 'create'])->middleware('auth:akun_user');
Route::post('/tambahDokter', [DataDokterController::class, 'store'])->middleware('auth:akun_user');
Route::get('/kelolaDokter/{medical_staff:id_dokter}/editDokter', [DataDokterController::class, 'edit'])->middleware('auth:akun_user');
Route::put('/tambahDokter/{medical_staff:id_dokter}', [DataDokterController::class, 'update'])->middleware('auth:akun_user');
Route::delete('/kelolaDokter/{id_dokter}', [DataDokterController::class, 'destroy'])->middleware('auth:akun_user');
Route::get('/viewDokter/{id_dokter}', [DataDokterController::class, 'show'])->middleware('auth:akun_user');

// Rekam Medis
Route::get('/rekamMedis', [RekamMedisController::class, 'index'])
    ->middleware('auth:akun_user')
    ->name('rekamMedis');
Route::get('/tambahRekamMedis', [RekamMedisController::class, 'formTambahRekamMedis'])->middleware('auth:akun_user');
Route::post('/generate-plan', [RekamMedisController::class, 'generatePlan'])->name('generate.plan');
Route::get('/search-pasien', [RekamMedisController::class, 'searchPasien'])->name('searchPasien');
// Route::post('/tambahRekamMedis', [RekamMedisController::class, 'storeTambahRekamMedis'])->middleware('auth:akun_user');
Route::post('/tambahRekamMedis', [RekamMedisController::class, 'storeTambahRekamMedis'])->middleware('auth:akun_user')->name('tambahRekamMedis'); // Tambahkan nama route
Route::get('/rekamMedisPasien/{nomor_rekam_medis}', [RekamMedisController::class, 'dataRekamMedisPasien'])->middleware('auth:akun_user')->name('rekamMedisPasien');
Route::get('/detailRekamMedisPasien/{id_rekam_medis}', [RekamMedisController::class, 'detailRekamMedisPasien'])->middleware('auth:akun_user');
Route::get('/editRekamMedis/{id_rekam_medis}/editRekamMedis', [RekamMedisController::class, 'edit'])->middleware('auth:akun_user');
Route::put('/editRekamMedis/{id_rekam_medis}', [RekamMedisController::class, 'update'])->middleware('auth:akun_user');
Route::delete('/rekamMedis/{id_rekam_medis}', [RekamMedisController::class, 'destroy']);
Route::delete('/rekamMedisPasien/{id_rekam_medis}', [RekamMedisController::class, 'destroyer']);

// Data Obat
Route::get('/dataObat', [DataObatController::class, 'index'])->middleware('auth:akun_user');
Route::get('/obat/{id_obat}', [DataObatController::class, 'dataRekamMedisPasien'])->middleware('auth:akun_user');
Route::get('/tambahObat', [DataObatController::class, 'formTambahObat'])->middleware('auth:akun_user');
Route::post('/tambahObat', [DataObatController::class, 'store'])->middleware('auth:akun_user');
Route::get('/search-obat', [DataObatController::class, 'searchPas'])->name('searchPas');
Route::delete('/obat/{id_obat}', [DataObatController::class, 'destroy']);

// Resep Obat
Route::get('/resep', [ResepController::class, 'index'])
    ->middleware('auth:akun_user')
    ->name('resep');
// Route::get('/resep/{patients:nomor_rekam_medis}', [ResepController::class, 'dataRekamMedisPasien'])->middleware('auth:akun_user');
Route::get('/tambahResep', [ResepController::class, 'tambahResep'])->middleware('auth:akun_user')->name('tambahResep');
Route::get('/formResep/{id_rekam_medis}', [ResepController::class, 'formResep'])->middleware('auth:akun_user')->name('formResep');
// Route::get('/detailResepPasien/{id_resep}', [ResepController::class, 'detailResepPasien'])->name('detailResepPasien');
Route::get('/detailResepPasien/{id_resep}', [ResepController::class, 'detailResepPasien'])->middleware('auth:akun_user')->name('detailResepPasien');
Route::post('/storeResep', [ResepController::class, 'storeResep'])->middleware('auth:akun_user')->name('storeResep');
Route::get('/searchObat', [ResepController::class, 'search'])->middleware('auth:akun_user')->name('searchObat');

// Tindakan
Route::get('/viewTindakan', [TindakanController::class, 'viewTindakan'])->middleware('auth:akun_user')->name('viewTindakan');
Route::get('/formTindakan/{id_rekam_medis}', [TindakanController::class, 'formTindakan'])->middleware('auth:akun_user')->name('formTindakan');
Route::post('/storeTindakan', [TindakanController::class, 'storeTindakan'])->middleware('auth:akun_user')->name('storeTindakan');
Route::get('/search-tindakan', [TindakanController::class, 'searchTindakan'])->middleware('auth:akun_user')->name('searchTindakan');
Route::get('/detailTindakanPasien/{id_rekam_medis}', [TindakanController::class, 'detailTindakanPasien'])->middleware('auth:akun_user')->name('detailTindakanPasien');

//Transaksi
Route::get('/index', [TransaksiController::class, 'index'])->middleware('auth:akun_user')->name('index');
Route::get('/viewTransaksi', [TransaksiController::class, 'viewTransaksi'])->middleware('auth:akun_user')->name('viewTransaksi');
Route::get('/formTransaksi/{id_rekam_medis}', [TransaksiController::class, 'formTransaksi'])->middleware('auth:akun_user')->name('formTransaksi');
Route::post('/transaksi/storeTransaksi', [TransaksiController::class, 'storeTransaksi'])->name('storeTransaksi');
Route::put('/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('updateTotalBiaya');

//struk
Route::get('/transaksi/print/{id}', [TransaksiController::class, 'printStruk'])->name('transaksi.print');
Route::get('/transaksi/cetak/{idTransaksi}', [TransaksiController::class, 'cetakStruk'])->name('cetakStruk');
// Route::get('/cetak-struk', [TransaksiController::class, 'cetakStruk']);