<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IllnessList extends Model
{
	use SoftDeletes;
	
    protected $table = 'illness_list';
    protected $fillable = [
		'id',
		'patient_id',
		'illness',
		'created_at',
		'updated_at'	
	];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'patient_id');
	}	
}
