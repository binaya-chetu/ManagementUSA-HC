<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctor_details';
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
        'specialization'
    ];
    
    public function doctor()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function doctorStateName()
    {
        return $this->belongsTo('App\State', 'state');
    }
}
