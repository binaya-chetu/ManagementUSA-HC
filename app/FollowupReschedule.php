<?php

namespace App;

use App\Appointment;
use App\FollowupStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowupReschedule extends Model {

	use SoftDeletes;
	
    protected $table = 'followup_reschedule';
    public function appointment() {
        return $this->belongsTo('App\Appointment', 'new_appointment_id')->select('id', 'apptTime');
    }

}
