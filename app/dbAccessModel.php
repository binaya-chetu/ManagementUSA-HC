<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dbAccessModel extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

  public function orders(){
      return $this->belongsTo('App\Order','user_id');
  }
}
