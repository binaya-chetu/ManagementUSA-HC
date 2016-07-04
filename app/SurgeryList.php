<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurgeryList extends Model
{
    protected $table = 'surgery_list';
    protected $fillable = [
		'id',
		'type_of_surgery',
		'date',
		'reason',
		'created_at',
		'updated_at'		
    ];
	
}
