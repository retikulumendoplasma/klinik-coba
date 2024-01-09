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
    
    public function proposal(){
        return $this->belongsTo("App\Models\pengaju_proposal_tender");
    }

    public function akun_user()
    {
        return $this->belongsTo(akun_user::class, 'user_id');
    }

    public function penduduk()
    {
        return $this->akun_user->hasOne(penduduk::class, 'nik', 'nik');
    }
    public function tender()
    {
        return $this->belongsTo(tender::class, 'tender_id');
    }

    
}
