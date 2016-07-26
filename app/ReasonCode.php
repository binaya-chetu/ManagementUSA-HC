<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReasonCode extends Model
{
	use SoftDeletes;
	
    protected $table = 'reason_codes';
}
