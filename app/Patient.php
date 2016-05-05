<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable =
    [
        'firstName',
        'lastName',
        'email',
        'phone',
        'address1',
        
    ];
	
	 public function appointmentp(){
        return $this->hasOne('App\Appointment','patient_id');
    }
}
