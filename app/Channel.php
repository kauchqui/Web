<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table = 'channels';
    protected $connection = 'mysql';
    /*
    Override the default to slug. The default return is usually primary key
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function threads(){
        return $this->hasMany(Thread::class);
    }
}
