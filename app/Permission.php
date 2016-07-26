<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PermissionRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
	use SoftDeletes;
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
    
    
    public static function getPermissionForLoggedUser($role = null)
    {
        $permissions = PermissionRole::with('permissionId')->where('role_id', $role)->get();
        
        $permissions = $permissions->toArray();
        
        $permissionsArr = array();
        foreach($permissions as $permission)
        {
            $permissionsArr[] = $permission['permission_id'];
        }
        
        $permissionSlugArr = array();
       foreach($permissionsArr as $permission)
       {
           $permissionSlugArr[] = $permission['permission_slug'];
       }
      
       return $permissionSlugArr;
    }

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
}