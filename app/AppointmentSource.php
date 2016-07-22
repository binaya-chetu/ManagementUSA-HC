<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentSource extends Model
{
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
