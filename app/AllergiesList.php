<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllergiesList extends Model
{
	use SoftDeletes;
	
    protected $table = 'allergies_list';
    protected $fillable = [
		'id',
		'patient_id',
		'allergic_medicine',
		'created_at',
		'updated_at'	
	];

	public function user()
	{
		return $this->belongsTo('App\User', 'patient_id');
	}		
}
