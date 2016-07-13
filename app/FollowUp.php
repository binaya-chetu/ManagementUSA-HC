<?php

namespace App;

use App\Appointment;
use App\FollowupStatus;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model {

    protected $table = 'followups';
    protected $fillable = [
        'action',
        'status',
        'comment',
        'followup_later_date'
    ];

    public function appointment() {
        return $this->belongsTo('App\Appointment', 'appt_id')->select('id', 'apptTime', 'patient_id', 'doctor_id', 'comment');
    }
    
    public function followupStatus() {
        return $this->belongsTo('App\FollowupStatus', 'action')->select('id', 'title');
    }
}
