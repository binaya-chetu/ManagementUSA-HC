<?php

namespace App;

use App\Patient;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model {

    //
    protected $fillable = [
        'comment',
        'clinic',
        'marketer', //user_id
        'patient_id',
        'status',
        'appointment_time',
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
        return $this->belongsTo('App\Patient');
    }

    public function doctor() {
        return $this->belongsTo('App\Doctor', 'doctor_id');
    }

}
