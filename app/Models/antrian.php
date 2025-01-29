<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class antrian extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'antrian';
    protected $primaryKey = 'id_antrian';

    protected $guarded = [];

    public function patients()
    {
        return $this->belongsTo(patients::class, 'nomor_rekam_medis', 'nomor_rekam_medis');
    }
}
