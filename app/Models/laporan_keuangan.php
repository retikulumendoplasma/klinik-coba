<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan_keuangan extends Model
{
    use HasFactory;
    protected $table = 'laporan_keuangan';
    public $timestamps = false;

    protected $guarded = [];
}
