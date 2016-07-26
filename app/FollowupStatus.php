<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowupStatus extends Model
{
	use SoftDeletes;
	
   protected $table = 'followup_status';
   protected $fillable = [
        'title',
        'status',
    ];
   
   public function followup() {
        return $this->hasMany('App\Followup');
    }
}
