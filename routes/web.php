<?php

use App\Http\Controllers\AdminDataPasienController;
use App\Http\Controllers\AdminPengurusanSuratController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DataDokterController;
use App\Http\Controllers\RekamMedisController;
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
Route::get('/dashboard', [AdminPengurusanSuratController::class, 'adminhome'])->middleware('auth:akun_user');

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

// Rekam Medis
Route::get('/rekamMedis', [RekamMedisController::class, 'index'])->middleware('auth:akun_user');
Route::get('/rekamMedisPasien/{patients:id_pasien}', [RekamMedisController::class, 'dataRekamMedisPasien'])->middleware('auth:akun_user');
Route::get('/tambahRekamMedis', [RekamMedisController::class, 'formTambahRekamMedis'])->middleware('auth:akun_user');
Route::post('/tambahRekamMedis', [RekamMedisController::class, 'storeTambahRekamMedis'])->middleware('auth:akun_user');
Route::get('/search-pasien', [RekamMedisController::class, 'searchPasien'])->name('searchPasien');
Route::delete('/rekamMedis/{mr}', [RekamMedisController::class, 'destroy']);
Route::delete('/rekamMedisPasien/{mr}', [RekamMedisController::class, 'destroyer']);