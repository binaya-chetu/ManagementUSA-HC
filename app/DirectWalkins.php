<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebLead extends Model
{
    //
        protected $table = 'web_leads';
        public $fillable = ['id','first_name','last_name','email','phone','location','requested_time'];
        
}
