<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class AppointmentRequest extends Model
{
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
               'status',
               'noSetStatus'

    ];
    
     public function patient() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function noSetReason(){
         return $this->hasOne('App\AppointmentReason', 'request_id');
    }   
}
