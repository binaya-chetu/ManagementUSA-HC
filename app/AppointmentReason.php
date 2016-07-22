<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentReason extends Model
{
    protected $table = 'appointment_reasons';
     protected $fillable = [
		'id',
		'patient_id',
		'request_id',
		'reason_id',
               'created_at',
               'updated_at',
               'deleted_at'

    ];
     /**
     * hasOne Relationship Method for accessing the Appointment Reason
     *
     * @return QueryBuilder Object
     */
    public function reasonCode()
    {
        return $this->belongsTo('App\ReasonCode', 'reason_id')->select(array('id', 'reason'));
    }
    public function appointmentRequest(){
         return $this->belongsTo('App\AppointmentRequest', 'request_id')->select(array('id', 'reason'));
    }    
      
    
}
