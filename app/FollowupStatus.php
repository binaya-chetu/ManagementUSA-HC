<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowupStatus extends Model
{
   protected $table = 'followup_status';
   protected $fillable = [
        'title',
        'status',
    ];
   
   public function followup() {
        return $this->hasMany('App\Followup');
    }
}
