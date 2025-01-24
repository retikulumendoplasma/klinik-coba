<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $guarded = [];

    public function medical_reports()
    {
        return $this->belongsTo(medical_reports::class, 'id_rekam_medis', 'id_rekam_medis');
    }
}
