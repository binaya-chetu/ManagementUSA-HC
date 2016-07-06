<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentReason extends Model
{
    protected $table = 'appointment_reasons';
    
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
