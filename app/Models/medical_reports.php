<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medical_reports extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'medical_reports';
    protected $primaryKey = 'id_rekam_medis';
    // public $incrementing = false; // Karena primary key adalah string, bukan auto increment
    // protected $keyType = 'string'; // Menentukan tipe primary key sebagai string

    protected $guarded = [];

    /**
     * Relasi ke tabel patients (belongs-to)
     */
    public function patients()
    {
        return $this->belongsTo(Patients::class, 'nomor_rekam_medis', 'nomor_rekam_medis');
    }

    /**
     * Relasi ke tabel medical_staff (belongs-to)
     */
    public function medical_staff()
    {
        return $this->belongsTo(medical_staff::class, 'id_dokter', 'id_dokter');
    }
    
    public function tindakan()
    {
        return $this->hasMany(tindakan::class, 'id_rekam_medis', 'id_rekam_medis');
    }

    public function resep()
    {
        return $this->hasMany(resep::class, 'id_rekam_medis');
    }

    public function transaksi()
    {
        return $this->hasOne(transaksi::class, 'id_rekam_medis', 'id_rekam_medis');
    }
}
