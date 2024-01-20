<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengaju_proposal_tender extends Model
{
    use HasFactory;
    protected $table = 'pengaju_proposal_tender';
    public $timestamps = false;

    protected $guarded = [];
    
    public function tender()
    {
        return $this->belongsTo(Tender::class, 'id_tender', 'id');
    }

    public function votes(){
        return $this->hasMany("App\Models\voting_tender");
    }

}
