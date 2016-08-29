<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentFollowup extends Model
{
	use SoftDeletes;
	
    protected $table = 'appointment_followups';
     protected $fillable = [
        'appt_id',
        'reason_id',
        'comment',
        'status'
    ];
     
    public function web_lead() {        
        return $this->belongsTo('App\WebLead', 'appt_id');
    }
    
    public function telemarketing() {        
        return $this->belongsTo('App\TelemarketingCall', 'appt_id');
    }

}
