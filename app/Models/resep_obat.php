<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resep_obat extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'resep_obat';
    protected $primaryKey = 'id_resep_obat';

    protected $guarded = [];

    public function resep()
    {
        return $this->belongsTo(resep::class, 'id_resep');
    }

    public function medicines()
    {
        return $this->belongsTo(medicines::class, 'id_obat');
    }
}
