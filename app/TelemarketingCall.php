<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelemarketingCall extends Model
{
    protected $table = 'telemarketing_calls';
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'requested_date', 'status', 'comment'];
    
}
