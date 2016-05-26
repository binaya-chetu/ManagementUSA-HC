<?php

namespace App;
use App\appointment;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    //
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'followups';
    
    
    protected $fillable = 
    [
        'action',
        'status',
        'comment'
    ];
    
    public function appointment() {
        return $this->belongsTo('App\Appointment', 'appt_id');
    }
}
