<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdamsQuestionaires extends Model
{
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
}
