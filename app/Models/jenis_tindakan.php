<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_tindakan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'jenis_tindakan';
    protected $primaryKey = 'id_jenis_tindakan';

    protected $guarded = [];

    public function tindakan()
    {
        return $this->hasMany(tindakan::class, 'id_jenis_tindakan', 'id_jenis_tindakan');
    }

}
