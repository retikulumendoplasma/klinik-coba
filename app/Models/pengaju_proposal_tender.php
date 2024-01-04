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
    public function voting_tender()
    {
        return $this->hasMany(voting_tender::class);
    }

}
