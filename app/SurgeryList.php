<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurgeryList extends Model
{
	use SoftDeletes;
	
    protected $table = 'surgery_list';
    protected $fillable = [
		'id',
		'patient_id',
		'type_of_surgery',
		'date',
		'reason',
		'created_at',
		'updated_at',
		'deleted_at'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'patient_id');
    }	
}
