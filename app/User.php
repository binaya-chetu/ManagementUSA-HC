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
        return $this->hasOne('App\Patient', 'user_id', 'id');
    }
	
	public function adamsQuestionaires()
	{
		return $this->hasOne('App\AdamsQuestionaires', 'patient_id');
	}
	public function allergiesList()    
	{
		return $this->hasMany('App\AllergiesList', 'patient_id');
	}
    public function reason() 
    {
        return $this->hasMany('App\AppointmentReasons', 'patient_id');
    }	
	public function appointments()
	{
		return $this->hasMany('App\Appointments', 'patient_id');
	}
	public function appointmentRequest() 
	{
		return $this->hasMany('App\AppointmentRequest', 'user_id');
	}
	public function cart() 
	{
		return $this->hasMany('App\Cart', 'user_id');
	}
	public function cosmetics() 
	{
		return $this->hasOne('App\Cosmetics', 'patient_id');
	}
	public function erectileDysfunctions() 
	{
		return $this->hasOne('App\ErectileDysfunctions', 'patient_id');
	}
	public function highTestosterone()  
	{
		return $this->hasOne('App\HighTestosterone', 'patient_id');
	}
	public function illnessList() 
	{
		return $this->hasMany('App\IllnessList', 'patient_id');
	}
	public function medicalHistories() 
	{
		return $this->hasOne('App\MedicalHistories', 'patient_id');
	}
	public function patientMedicationList() 
	{
		return $this->hasMany('App\PatientMedicationList', 'patient_id');
	}
	public function patientVitaminList() 
	{
		return $this->hasMany('App\PatientVitaminList', 'patient_id');
	}
	public function priapus() 
	{
		return $this->hasOne('App\Priapus', 'patient_id');
	}
	public function sale() 
	{
		return $this->hasMany('App\Sale', 'patient_id');
	}
	public function surgeryList() 
	{
		return $this->hasMany('App\SurgeryList', 'patient_id');
	}
	public function vitamins() 
	{
		return $this->hasMany('App\Vitamins', 'patient_id');
	}
	public function weightLoss() 
	{
		return $this->hasOne('App\WeightLoss', 'patient_id');
	}
	
	protected static function boot() {
		parent::boot();
		static::deleting(function($user) {
			if($user->role == config("constants.PATIENT_ROLE_ID")){		
				$user->patientDetail()->delete();
				$user->adamsQuestionaires()->delete();
				$user->appointmentRequest()->delete();
				//$user->appointments()->delete();
				$user->allergiesList()->delete();
				$user->reason()->delete();
				$user->cart()->delete();
				$user->cosmetics()->delete();
				$user->erectileDysfunctions()->delete();
				$user->highTestosterone()->delete();
				$user->illnessList()->delete();
				$user->medicalHistories()->delete();
				$user->patientMedicationList()->delete();
				$user->patientVitaminList()->delete();
				$user->priapus()->delete();
				//$user->sale()->delete(); 
				$user->surgeryList()->delete();
				$user->vitamins()->delete();
				$user->weightLoss()->delete();				
			}
		});
	}	
}