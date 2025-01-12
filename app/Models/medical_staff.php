<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medical_staff extends Model
{
    use HasFactory;
    
    protected $table = 'medical_staff';
    protected $primaryKey = 'id_dokter';

    protected $guarded = [];

    public function medical_reports()
    {
        return $this->hasMany(medical_reports::class, 'id_dokter', 'id_dokter');
    }
}
