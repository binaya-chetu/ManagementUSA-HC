<?php

namespace App;

use App\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model {
	use SoftDeletes;
	
	protected $table = 'appointments';
	
    protected $fillable = [
		'id',
		'relative_id',
		'apptTime',
		'appt_source',
		'request_id',
		'status',
		'email_invitation',
		'createdBy',
		'lastUpdatedBy',
		'patient_id',
		'doctor_id',
		'comment',
		'patient_status',
		'created_at',
		'updated_at',
		'deleted_at'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'patient_id');
    }	

	public function appointmentRequest(){
		return $this->belongsTo('App\AppointmentRequest', 'request_id');
	}

	public function followup(){
		return $this->hasOne('App\FollowUp', 'appt_id');
	}
	
	public function labReports(){
		return $this->hasMany('App\LabReports', 'appointments_id');
	}
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

	public function sale() {
		return $this->hasMany('App\Sale', 'appt');
	}
	
	protected static function boot() {
		parent::boot();
		static::deleting(function($appointment) {		
			$appointment->followup()->delete();
			$appointment->labReports()->delete();
			$appointment->sale()->delete();
		});
	}	
}
