<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllergiesList extends Model
{
    protected $table = 'allergies_list';
    protected $fillable = [
		'id',
		'patient_id',
		'allergic_medicine',
		'created_at',
		'updated_at'	
	];
}
