<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient_details';
    protected $fillable =
    [
        'user_id',
	'dob',
	'gender',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'zipCode',
        'image',
        'employer',
        'occupation',
        'payment_bill'
        
    ];
	
    public function appointmentp() {
        return $this->hasOne('App\Appointment', 'patient_id');
    }
    
    public function patient()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function patientStateName()
    {
        return $this->belongsTo('App\State', 'state');
    }

}
