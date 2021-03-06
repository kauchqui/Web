<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $table = 'threads';
    protected $connection = 'mysql';

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('app\User');
    }
    public function path(){

        return '/threads/'. $this->channel->slug . '/' . $this->id;
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function channel(){
        return $this->belongsTo(Channel::class);
    }
    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function addReply($reply){
        $this->replies()->create($reply);
    }
}
