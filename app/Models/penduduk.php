<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';
    protected $primaryKey = 'nik';
    public $timestamps = false;

    protected $guarded = [];

    public function akun_user()
    {
        return $this->hasOne(akun_user::class);
    }
}
