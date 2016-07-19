<?php

namespace App;

use App\Patient;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model {
    protected $fillable = [
        'appt_source',
        'request_id',
        'email_invitation',
        'comment',
        'clinic',
        'marketer', //user_id
        'patient_id',
        'status',
        'appointment_time',
        'apptTime',
        'doctor_id',
        'createdBy',
        'lastUpdatedBy'
    ];

    /**
     * Get the user that set the appointment.
     */
    public function setter() {
        return $this->belongsTo('App\User', 'marketer');
    }

    /**
     * Get the patient the aappointment was set for.
     */
    public function patient() {
        return $this->belongsTo('App\User', 'patient_id');
    }

    public function doctor() {
        return $this->belongsTo('App\User', 'doctor_id');
    }
    public function followup() {
        return $this->hasOne('App\Followup');
    }

}
