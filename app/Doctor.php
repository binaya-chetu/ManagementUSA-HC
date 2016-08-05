<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use SoftDeletes;
	
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
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
	
    public function doctor()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function doctorStateName()
    {
        return $this->belongsTo('App\State', 'state');
    }
}
