<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medical_reports extends Model
{
    use HasFactory;

    protected $table = 'medical_reports';
    protected $primaryKey = 'mr';
    public $incrementing = false; // Karena primary key adalah string, bukan auto increment
    protected $keyType = 'string'; // Menentukan tipe primary key sebagai string

    protected $guarded = [];

    /**
     * Relasi ke tabel patients (belongs-to)
     */
    public function patients()
    {
        return $this->belongsTo(Patients::class, 'id_pasien', 'id_pasien');
    }

    /**
     * Relasi ke tabel medical_staff (belongs-to)
     */
    public function medical_staff()
    {
        return $this->belongsTo(medical_staff::class, 'id_dokter', 'id_dokter');
    }
}
