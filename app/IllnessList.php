<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IllnessList extends Model
{
    protected $table = 'illness_list';
    protected $fillable = [
		'id',
		'patient_id',
		'illness',
		'created_at',
		'updated_at'	
	];
}
