<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations';
    protected $fillable = [
        'name',
        'city',
        'state',
        'patient_id',
        'appt_request_id'
        
    ];
    
//     public function AppointmentRequest()
//    {
//        return $this->belongsTo('App/AppointmentRequest', 'id');
//    }
}
