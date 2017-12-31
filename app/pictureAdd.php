<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pictureAdd extends Model
{
    protected $table = 'maintenancepictures';
    protected $connection = 'mysql';
    //
    public function user()
    {
        return $this->belongsTo('app\Unit');
    }
}
