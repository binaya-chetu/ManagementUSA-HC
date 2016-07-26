<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priapus extends Model
{
	use SoftDeletes;
	
    protected $table = 'priapus';
    protected $fillable = [
		'id',
		'patient_id',
		'abnormal',
		'abnormal_type',
		'priapus_goal',
		'prp_before',
		'pump_past',
		'implant_surgery',
		'pre_activity_score',
		'prp_stimulation_score',
		'prp_intercourse_score',
		'prp_maintain_score',
		'prp_difficult_score',
		'created_at',
		'updated_at'	
	];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'patient_id');
	}	
}
