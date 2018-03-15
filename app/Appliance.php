<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appliance extends Model
{
    //
    public $table = 'appliances';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'unit_id', 'type','make', 'model', 'serial', 'year'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
