<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrimixDoses extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trimix_doses';
    protected $fillable = [
        'patient_id',
        'agent_id',
        'dose_type',
        'quantity',
        'doctor',
        'amount1',
        'medicationA1',
        'amount2',
        'medicationA2',
        'amount3',
        'medicationB1',
        'amount4',
        'medicationB2',
        'antidote',
        'dose_start_date',
        'dose_end_date',
        'permanent_dose_status'
    ];
    
    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */
    public function patient() 
    {
        return $this->belongsTo('App\User', 'patient_id');
    }
    
     public function trimixFeedback() 
    {
        return $this->hasOne('App\TrimixDosesFeedback', 'trimix_dose_id');
    }
}
