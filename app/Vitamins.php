<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vitamins extends Model
{
	use SoftDeletes;
	
    protected $table = 'vitamins';
    protected $fillable = [
		'id',
		'patient_id',
		'needle_afraid',
		'afraid_limit',
		'injectable_type',
		'total_wellness',
		'weight_supplement',
		'vitamin_knowledge',
		'vitamin_taken',
		'wellness_tested',
		'vitamin_drip',
		'created_at',
		'updated_at'
	];
	
    public function user() {
        return $this->belongsTo('App\User', 'patient_id');
    }	
}
