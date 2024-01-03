<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voting_tender extends Model
{
    use HasFactory;
    protected $table = 'voting';
    public $timestamps = false;

    protected $guarded = [];
}
