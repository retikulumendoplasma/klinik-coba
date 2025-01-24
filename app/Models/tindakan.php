<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tindakan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tindakan';
    protected $primaryKey = 'id_tindakan';

    protected $guarded = [];

    public function medical_reports()
    {
        return $this->belongsTo(medical_reports::class, 'id_rekam_medis', 'id_rekam_medis');
    }

    public function jenis_tindakan()
    {
        return $this->belongsTo(jenis_tindakan::class, 'id_jenis_tindakan', 'id_jenis_tindakan');
    }

}
