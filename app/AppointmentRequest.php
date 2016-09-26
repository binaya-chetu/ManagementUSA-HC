<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AppointmentRequest extends Model
{
	use SoftDeletes;
	
    protected $table = 'appointment_requests';

    protected $fillable = [
		'id',
		'user_id',
		'marketing_phone',
		'call_time',
		'comment',
		'created_by',
		'appt_source',
		'followup_date',
		'followup_status',
		'created_at',
		'updated_at',
		'deleted_at',
		'status',
		'noSetStatus'
    ];
    
     public function patient() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function noSetReason(){
         return $this->hasOne('App\AppointmentReason', 'request_id');
    }   

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }	
	
	public function appointment(){
		return $this->hasOne('App\Appointment', 'request_id');
	}
	
	public function appointmentReasons(){
		return $this->hasMany('App\AppointmentReasons', 'request_id');
	}
	
	protected static function boot() {
		parent::boot();
		static::deleting(function($appointmentRequest) {	
			$appointmentRequest->appointmentReasons()->delete();
			
			// check if appointment was set and if so delete the appointment
			if($appointmentRequest->status == 0){			
				$apptReq = Appointment::where('request_id', '=', $appointmentRequest->id)->firstOrFail();
				Appointment::destroy($apptReq->id);					
				//$appointmentRequest->appointment()->delete();
			}
		});
	}	
        public function locations(){
		return $this->belongsTo('App\Locations', 'location_id');
	}
}
