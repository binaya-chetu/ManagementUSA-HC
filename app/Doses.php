<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doses extends Model
{
    use SoftDeletes;
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'doses';
    protected $fillable = [
        'user_id',
        'package_id',
        'doses',
        'dose_status'
    ];
    
}
