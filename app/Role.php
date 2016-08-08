<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use SoftDeletes;
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';
    
     protected $fillable =
    [
        'role_title',
        'role_slug',
        'status',
    ];
    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */

    /**
     * many-to-many relationship method.
     *
     * @return QueryBuilder
     */
    public function users()
    {
        return $this->hasMany('App\User', 'role');
    }

    /**
     * many-to-many relationship method.
     *
     * @return QueryBuilder
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
}