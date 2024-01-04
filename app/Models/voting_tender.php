<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voting_tender extends Model
{
    use HasFactory;
    protected $table = 'voting_tender';
    public $timestamps = false;

    protected $guarded = [];
    public function pengaju_proposal()
    {
        return $this->belongsTo(pengaju_proposal_tender::class);
    }

    
}
