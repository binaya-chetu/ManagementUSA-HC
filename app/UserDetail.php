<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_details';
    
    protected $fillable =
    [
        'user_id',
        'permission_slug',
        'dob',
        'gender',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'zipCode',
        'image',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
     * many-to-many relationship method
     *
     * @return QueryBuilder
     */
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function userStateName()
    {
        return $this->belongsTo('App\State', 'state');
    }
}
