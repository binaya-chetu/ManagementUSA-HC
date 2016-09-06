<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emi extends Model
{
    use SoftDeletes;
	
	protected $table = 'emi';
	
	protected $fillable = [
		'id',
		'type',
		'emi_amount',
		'emi_paid',
		'patient_id',
		'agent_id',
		'package_id',
		'due_date',
		'payment_date',
		'created_at',
		'updated_at',
		'deleted_at'
	];
}
