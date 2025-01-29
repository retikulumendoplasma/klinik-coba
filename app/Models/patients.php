<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patients extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $primaryKey = 'nomor_rekam_medis';
    public $incrementing = false; // Karena primary key adalah string, bukan auto increment
    protected $keyType = 'string'; // Menentukan tipe primary key sebagai string

    protected $guarded = [];

    public function medical_reports()
    {
        return $this->hasMany(medical_reports::class, 'nomor_rekam_medis', 'nomor_rekam_medis');
    }
    
    public function antrian()
    {
        return $this->hasMany(antrian::class, 'nomor_rekam_medis', 'nomor_rekam_medis');
    }
}
