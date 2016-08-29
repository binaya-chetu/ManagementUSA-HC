<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentReasons extends Model
{
	use SoftDeletes;
	
    protected $table = 'appointment_reasons';
    protected $fillable = [
		'id',
		'patient_id',
		'reason_id',
		'created_at',
		'updated_at'
    ];
	
    public function user() {
        return $this->belongsTo('App\User', 'patient_id');
    }

	public function appointment(){
		return belongsTo('App/Appointment', 'request_id');
	}
	
	public function appointmentRequest(){
		return $this->belongsTo('App/AppointmentRequest', 'request_id');
	}	

     /**
     * hasOne Relationship Method for accessing the Appointment Reason
     *
     * @return QueryBuilder Object
     */
    public function reasonCode()
    {
        return $this->belongsTo('App\ReasonCode', 'reason_id')->select(array('id', 'reason'));
    }	
}
