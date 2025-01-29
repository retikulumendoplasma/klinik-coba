<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use illuminate\Support\Facades\Gate;

class akun_user extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'akun_user';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function medical_staff()
    {
        return $this->belongsTo(medical_staff::class, 'id_dokter', 'id_dokter');
    }


}
