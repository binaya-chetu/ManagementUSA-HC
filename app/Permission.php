<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PermissionRole;

class Permission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';
    
    protected $fillable =
    [
        'permission_title',
        'permission_slug',
        'permission_description',
        'parent_id',
        'status',
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
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    
    public function parent()
    {
        return $this->belongsTo('App\Permission', 0);
    }

    public function children()
    {
        return $this->hasMany('App\Permission', 'parent_id');
    }
    
    public function permission_role()
    {
        return $this->hasMany('App\PermissionRole', 'permission_id');
    }
    
    public function permission_roleId()
    {
        return $this->hasOne('App\PermissionRole', 'role_id');
    }
    
    public function permission_role1($roleid)
    {
        return $this->hasMany('App\PermissionRole', 'permission_id');
    }
}