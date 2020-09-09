<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Discussion;
use App\User;

class Replay extends Model
{
    //
    public $fillable=["user_id","discussion_id","content"];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function discussion(){
      return $this->belongsTo(Discussion::class);
  }
}
