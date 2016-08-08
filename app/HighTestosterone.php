<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HighTestosterone extends Model
{
	use SoftDeletes;
	
    protected $table = 'high_testosterone';
    protected $fillable = [
		'id',
		'patient_id',
		'harmone_therapy',
		'harmone_therapy_type',
		'usa_military',
		'lack_increment',
		'increase_fat',
		'depression',
		'mood_increment',
		'sleep_difficulty',
		'wrinkle_increment',
		'sagging_increment',
		'hot_flash',
		'loss_activity',
		'stess_increment',
		'loss_interest',
		'loose_skin',
		'exercise_ability',
		'memory_decrement',
		'loss_muscle',
		'endurance',
		'muscle_decrement',
		'loss_hair',
		'sense_decrement',
		'testicle_decrement',
		'shrinkage',
		'osteoporosis',
		'intolerance',
		'unexplained_weight',
		'created_at',
		'updated_at'	
	];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'patient_id');
	}	
}
