<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    use HasFactory;
    protected $table = 'berita';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

// class Berita
// {
//     //belum terhubung ke data base, penyimpanan sementara
//     private static $berita_post = [
//         [
//             "title" => "Pembuatan web desa",
//             "img" => "https://drive.google.com/uc?id=11fIQo5oJvWQjLsvr1u287z2XKSClGyuH",
//             "author" => "Febry Aji",
//             "slug" => "judul berita 1",
//             "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
//         ],
//         [
//             "title" => "Pembuatan aplikasi mobile desa",
//             "img" => "https://drive.google.com/uc?id=1S_Ml7HLujOXTAGl8Fz1t74yOGZzzxzbu",
//             "author" => "Bani Ilyasa",
//             "slug" => "judul berita 2",
//             "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
//         ],
//         [
//             "title" => "Pembuatan web admin",
//             "img" => "https://drive.google.com/uc?id=1WMsnXhXgqxd8fp1qlxmXsRlbbCVKYqm5",
//             "author" => "Pranata",
//             "slug" => "judul berita 3",
//             "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit corrupti excepturi quibusdam ab dicta temporibus saepe, beatae obcaecati eum explicabo deleniti? Quidem consequatur esse nulla aut consectetur debitis quibusdam voluptas voluptatibus accusantium vitae eum in, temporibus beatae qui fugiat ipsam ad similique natus. Quod consectetur eaque omnis dolor assumenda natus est corporis quibusdam harum quisquam iure, quis, quasi ut magni! Commodi blanditiis eius non perferendis odit. Voluptatem ullam quos beatae fugiat, quae dolorem sed, deserunt maiores sit iure cumque excepturi?"
//         ],
//     ];

//     public static function all()
//     {
//         //collection sederhana untuk mengambil data dari private static $berita_post
//         return collect (self::$berita_post);
//     }

//     public static function find($slug)
//     {
//         $post = static::all();
//         return $post->firstwhere('slug', $slug);
//     }
// }
