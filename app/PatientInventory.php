<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientInventory extends Model
{
    use SoftDeletes;
	
     protected $table = 'dropdown_details'; 
     
       public function dose_dropdown() {
     
          return $this->belongsToMany('App\dropdown_details','id');
      }
      public function dropdown_details() {
     
          return $this->hasOne('App\dose_dropdown','dropdown_id');
    }
    
}
