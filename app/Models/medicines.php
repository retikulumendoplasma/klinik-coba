<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicines extends Model
{
    use HasFactory;

    protected $table = 'medicines';
    protected $primaryKey = 'id_obat';

    protected $guarded = [];

    public function resep_obat()
    {
        return $this->hasMany(resep_obat::class, 'id_obat');
    }
}
