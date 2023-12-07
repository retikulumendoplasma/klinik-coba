<?php

namespace App\Models;


class Berita
{
    //belum terhubung ke data base, penyimpanan sementara
    private static $berita_post = [
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

    public static function all()
    {
        //collection sederhana untuk mengambil data dari private static $berita_post
        return collect (self::$berita_post);
    }

    public static function find($slug)
    {
        $post = static::all();
        return $post->firstwhere('slug', $slug);
    }
}
