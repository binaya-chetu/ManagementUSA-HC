<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Role;
use App\Permission;


class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'email', 'password', 'role', 'remember_token', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /*
    |--------------------------------------------------------------------------
    | ACL Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Checks a Permission
     *
     * @param  String permission Slug of a permission (i.e: manage_user)
     * @return Boolean true if has permission, otherwise false
     */
    public function can($permission = null)
    {
        return !is_null($permission) && $this->checkPermission($permission);
    }

    /**
     * Check if the permission matches with any permission user has
     *
     * @param  String permission slug of a permission
     * @return Boolean true if permission exists, otherwise false
     */
    protected function checkPermission($perm)
    {
        $permissions = $this->getAllPernissionsFormAllRoles();
        $permissionArray = is_array($perm) ? $perm : [$perm];
        return count(array_intersect($permissions, $permissionArray));
    }

    /**
     * Get all permission slugs from all permissions of all roles
     *
     * @return Array of permission slugs
     */
    public function getAllPernissionsFormAllRoles()
    {
        $permissionsArray = [];

        $permissions = $this->roles->load('permissions');
        $permissions = $permissions->toArray();
        
        $permissions = $permissions['permissions'];
        $permissionSlugArr = array();
       foreach($permissions as $permission)
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
     * Many-To-Many Relationship Method for accessing the User->roles
     *
     * @return QueryBuilder Object
     */
    public function roles()
    {
        return $this->belongsTo('App\Role', 'role');
    }
    
    public function roleName()
    {
        return $this->belongsTo('App\Role', 'role');
    }
    
    public function userDetail()
    {
        return $this->hasOne('App\UserDetail', 'user_id');
    }
    
    public function doctorDetail()
    {
        return $this->hasOne('App\Doctor', 'user_id');
    }
    
    public function patientDetail()
    {
        return $this->hasOne('App\Patient', 'user_id');
    }
	
	public function adamsQuestionaires()
	{
		return $this->hasOne('App\AdamsQuestionaires', 'patient_id');
	}
    public function reason()
    {
        return $this->hasMany('App\AppointmentReason', 'patient_id');
    }
}