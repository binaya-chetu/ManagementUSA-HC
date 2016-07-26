<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
	use SoftDeletes;
    //
    protected $fillable = 
    [
        'description',
        'status',
        'cash',
        'credit_cd',
        'credit_cd2',
        'credit_cd3',
        'check',
    ];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'patient_id');
	}	
    
    /**
     * Get the user that conducts the sale.
     */
    public function seller(){
        return $this->belongsTo('App\User');
    }
    
    /**
     * Get the user patient that bought.
     */
    public function appt(){
        return $this->belongsTo('App\Appointment');
    }
    
}
