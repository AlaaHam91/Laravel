<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Channel;
use App\User;
use App\Replay;

class Discussion extends Model
{
    //
    protected $fillable=["user_id","channel_id","title","content","slug"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
    public function replies()
    {
        return $this->hasMany(Replay::class);
    }
}
