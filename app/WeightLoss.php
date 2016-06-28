<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeightLoss extends Model
{
    protected $table = 'weight_loss';
    protected $fillable = [
		'id',
		'patient_id',
		'weight_surgeries',
		'surgeries_kind',
		'weight_supplement',
		'supplement_type',
		'liver_disease',
		'diabetes',
		'thyroid_treated',
		'hormone_treated',
		'seizures',
		'kidney_disorder',
		'eating_disorder',
		'frequently_eat',
		'eat_more',
		'created_at',
		'updated_at'	
	];
}
