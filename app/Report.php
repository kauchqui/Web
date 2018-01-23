<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    public $table = 'reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'unit_id','body', 'issue', 'issue_desc', 'resolved'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
