<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientVitaminList extends Model
{
	protected $table = 'patient_vitamin_list';
    protected $fillable = [
		'patient_id',
		'name',
		'dosage',
		'how_often',
		'taken_for'		
	];
}
