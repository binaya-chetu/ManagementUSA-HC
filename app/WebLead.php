<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebLead extends Model
{
	use SoftDeletes;
	
    //
        protected $table = 'web_leads';
        public $fillable = ['id','first_name','last_name','email','phone','location','requested_time'];
        
}
