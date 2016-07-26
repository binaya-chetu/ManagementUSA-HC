<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cosmetics extends Model
{
	use SoftDeletes;
	
    protected $table = 'cosmetics';
    protected $fillable = [
		'id',
		'patient_id',
		'facial_surgeries',
		'facial_kind',
		'face_wash',
		'exposure',
		'skin_look',
		'look_score',
		'happy_score',
		'crowsfeet',
		'facial_expression',
		'sunken',
		'bullfrog_looking',
		'loose_skin',
		'thin_lip',
		'face_spot',
		'acne',
		'skin_tag',
		'created_at',
		'updated_at'
	];
	
	public function user()
	{
		return $this->belongsTo('App\User', 'patient_id');
	}	
}
