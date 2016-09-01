<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dose extends Model
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
    ]; //
}
