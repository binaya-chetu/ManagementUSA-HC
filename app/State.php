<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
	use SoftDeletes;
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';
    
    public function userState()
    {
        return $this->hasMany('App/UserDetail', 'state');
    }
    
    public function doctorState()
    {
        return $this->hasMany('App/Doctor', 'state');
    }
    
    public function patientState()
    {
        return $this->hasMany('App/Patient', 'state');
    }
}
