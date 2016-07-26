<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelemarketingCall extends Model
{
	use SoftDeletes;
	
    protected $table = 'telemarketing_calls';
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'requested_date', 'status', 'comment'];
    
}
