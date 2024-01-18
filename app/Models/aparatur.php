<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aparatur extends Model
{
    use HasFactory;
    
    protected $table = 'aparatur';
    protected $primaryKey = 'nip_nipd';
    public $timestamps = false;

    protected $guarded = [];
}
