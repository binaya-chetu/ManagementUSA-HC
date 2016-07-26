<?php

namespace App;

use App\Appointment;
use App\FollowupStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowUp extends Model {

	use SoftDeletes;
	
    protected $table = 'followups';
    protected $fillable = [
		'id',
		'appt_id',
		'created_by',
		'action',
		'status',
		'comment',
		'followup_later_date',
		'created_at',
		'updated_at',
		'deleted_at'
    ];

    public function appointment() {
        return $this->belongsTo('App\Appointment', 'appt_id')->select('id', 'apptTime', 'patient_id', 'doctor_id', 'comment');
    }
    
    public function followupStatus() {
        return $this->belongsTo('App\FollowupStatus', 'action')->select('id', 'title');
    }
}
