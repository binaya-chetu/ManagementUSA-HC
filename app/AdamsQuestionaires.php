<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdamsQuestionaires extends Model
{
	use SoftDeletes;
	
	protected $table = 'adams_questionaires';
	
	protected $fillable = [
		'patient_id',
		'libido_rate',
		'energy_rate',
		'strength_rate',
		'enjoy_rate',
		'happiness_rate',
		'erection_rate',
		'performance_rate',
		'sleep_rate',
		'sport_rate',
		'lost_height_rate',
		'created_at',
		'updated_at'
    ];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'patient_id');
	}	
}
