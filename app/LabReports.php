<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabReports extends Model
{
    protected $table = 'lab_reports';
    protected $fillable = [
		'id',
		'patient_id',
		'appointments_id',
		'file',
		'created_at',
		'updated_at'	
	];
}
