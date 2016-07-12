<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientMedicationList extends Model
{
	protected $table = 'patient_medication_list';
    protected $fillable = [
		'patient_id',
		'name',
		'dosage',
		'how_often',
		'taken_for'		
	];
}
