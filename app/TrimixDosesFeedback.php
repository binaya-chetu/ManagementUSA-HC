<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrimixDosesFeedback extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'trimix_dose_feedback';
    protected $fillable = [
        'trimix_dose_id',
        'agent_id',
        'time',
        'percentage',
        'pain',
        'antidote',
        'notes'
    ];
    
    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */
    public function trimixDose() 
    {
        return $this->belongsTo('App\TrimixDoses', 'trimix_dose_id');
    }
}
