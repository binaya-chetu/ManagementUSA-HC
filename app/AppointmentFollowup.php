<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentFollowup extends Model
{
    protected $table = 'appointment_followups';
     protected $fillable = [
        'appt_id',
        'reason_id',
        'comment',
        'status'
    ];

}
