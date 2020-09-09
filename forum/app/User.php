<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\SocialAccount;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Discussion;
use App\Replay;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
        // protected $guarded=['$id'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function accounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function discussion()
    {
        return $this->hasMany(Discussion::class);
    }
    public function replay()
    {
        return $this->hasMany(Replay::class);
    }
}
