<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patients extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $primaryKey = 'id_pasien';
    // public $timestamps = false;

    protected $guarded = [];

    public function medical_reports()
    {
        return $this->hasMany(medical_reports::class, 'id_pasien', 'id_pasien');
    }
}
