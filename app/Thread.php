<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $table = 'Threads';
    protected $connection = 'mysql';

    public function user()
    {
        return $this->belongsTo('app\User');
    }
    public function path(){
        return '/threads/'. $this->id;
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }

}
