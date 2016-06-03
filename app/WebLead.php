<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebLead extends Model
{
    //
        protected $table = 'web_leads';
        public $fillable = ['title','description'];
}
