<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Discussion;

class Channel extends Model
{
    //
    protected  $fillable=['title'];

    public function discussion()
    {
        return $this->hasMany(Discussion::class);
    }

}
