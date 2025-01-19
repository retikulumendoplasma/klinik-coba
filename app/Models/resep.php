<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resep extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'resep';
    protected $primaryKey = 'id_resep';

    protected $guarded = [];

    public function medical_reports()
    {
        return $this->belongsTo(medical_reports::class, 'id_rekam_medis');
    }

    public function resep_obat()
    {
        return $this->hasMany(resep_obat::class, 'id_resep_obat');
    }
}
