<?php

namespace App;

use App\Appointment;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model {

    protected $fillable = [
        'action',
        'status',
        'comment',
        'followup_later_date'
    ];

    public function appointment() {
        return $this->belongsTo('App\Appointment', 'appt_id')->select('id', 'apptTime', 'patient_id', 'doctor_id', 'comment');
    }
}
