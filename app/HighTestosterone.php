<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HighTestosterone extends Model
{
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
}
