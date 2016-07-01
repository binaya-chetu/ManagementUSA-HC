<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentReasons extends Model
{
    protected $table = 'appointment_reasons';
    protected $fillable = [
		'id',
		'patient_id',
		'reason_id',
		'created_at',
		'updated_at'
    ];
}
