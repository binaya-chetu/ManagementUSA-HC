<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentSource extends Model
{
	use SoftDeletes;
    protected $table = 'appointment_sources';
      protected $fillable = [
        'id',
        'name',
        'discription',
        'created_at',
        'updated_at',
         'deleted_at'
    ];
}
