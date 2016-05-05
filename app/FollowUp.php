<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    //
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'followUps';
    
    
    protected $fillable = 
    [
        'action',
        'status',
    ];
    
}
