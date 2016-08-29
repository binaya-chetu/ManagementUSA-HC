<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LabReports extends Model
{
    use SoftDeletes;
    protected $table = 'lab_reports';
    protected $fillable = [
		'id',
		'patient_id',
		'appointments_id',
		'file',
		'created_at',
		'updated_at',
		'deleted_at'
    ];
	
    public function appointment() {
        return $this->belongsTo('App\Appointment', 'appointments_id');
    }
}
