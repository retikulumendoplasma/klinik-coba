<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tender extends Model
{
    use HasFactory;
    protected $table = 'tender';
    public $timestamps = false;

    protected $guarded = [];
    
    public function pengaju_proposal_tender()
    {
        return $this->hasOne(pengaju_proposal_tender::class, 'id_tender', 'id');
    }


}
