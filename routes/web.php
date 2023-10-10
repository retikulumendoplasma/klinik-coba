<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $news = [
        [
            "title" => "Pembuatan web desa",
            "author" => "Febry Aji",
            "slug" => "judul berita 1",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
        ],
        [
            "title" => "Pembuatan aplikasi mobile desa",
            "author" => "Bani Ilyasa",
            "slug" => "judul berita 2",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
        ],
        [
            "title" => "Pembuatan web admin",
            "author" => "Pranata",
            "slug" => "judul berita 3",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
        ],
    ];

    return view('home', [
        "title" => "Home",
        "berita" => $news
    ]);
});

Route::get('/berita', function () {
    $news = [
        [
            "title" => "Pembuatan web desa",
            "author" => "Febry Aji",
            "slug" => "judul berita 1",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
        ],
        [
            "title" => "Pembuatan aplikasi mobile desa",
            "author" => "Bani Ilyasa",
            "slug" => "judul berita 2",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
        ],
        [
            "title" => "Pembuatan web admin",
            "author" => "Pranata",
            "slug" => "judul berita 3",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
        ],
    ];

    return view('berita', [
        //pengisian berita
        "title" => "Berita",
        "berita" => $news
    ]);
});

Route::get('berita/{slug}', function ($slug) {
    // isi berita yang nanti di masukkan kedalam data base
    $news = [
        [
            "title" => "Pembuatan web desa",
            "author" => "Febry Aji",
            "slug" => "judul berita 1",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
        ],
        [
            "title" => "Pembuatan aplikasi mobile desa",
            "author" => "Bani Ilyasa",
            "slug" => "judul berita 2",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
        ],
        [
            "title" => "Pembuatan web admin",
            "author" => "Pranata",
            "slug" => "judul berita 3",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
        ],
    ];

    $detailberita = [];
    foreach ($news as $detail) {
        if($detail["slug"] === $slug) {
            $detailberita = $detail;
        }
    }

    return view('detailberita', [
        "title" => "Detail Berita",
        "detailberita" => $detailberita
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