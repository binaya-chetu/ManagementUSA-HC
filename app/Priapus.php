<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priapus extends Model
{
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
}
