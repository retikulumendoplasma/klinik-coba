<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saran_dan_masukan extends Model
{
    use HasFactory;
    protected $table = 'saran_dan_masukan';
    public $timestamps = false;

    protected $guarded = [];
}
