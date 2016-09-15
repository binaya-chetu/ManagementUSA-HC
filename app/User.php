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
    protected $fillable = [
		'id',
		'first_name',
		'middle_name',
		'last_name',
		'email',
		'password',
		'role',
		'remember_token',
		'status',
		'created_at',
		'updated_at',
		'deleted_at'	
	];

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

    /**
     * Get id, first name and last name of all the patients
     * @parameters: patient role_id
     * @return object of id, first name and last name of all the patients
     */	
	public static function getAllPatientsIdAndName($patient_role_id){
		$patients = User::where('role', $patient_role_id)
			->join('patient_details', function($join)
			{
				$join->on('users.id', '=', 'patient_details.user_id')
					->where('patient_details.never_treat_status', '=', 0);
			})->get(['users.id', 'first_name', 'last_name']);
			
			return $patients;
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

    public function cart_patient() 
    {
            return $this->hasMany('App\Cart', 'patient_id');
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

    public function payment() 
    {
            return $this->hasMany('App\Payment', 'agent_id');
    }
    
    public function trimixDoses() 
    {
            return $this->hasMany('App\TrimixDoses', 'patient_id');
    }
    
    public function paymentByPatientId()
    {
        return $this->hasMany('App\Payment', 'patient_id');
    }
	
    protected static function boot() {
        parent::boot();
        static::deleting(function($user) {
            if($user->role == config("constants.PATIENT_ROLE_ID")){		
                $user->patientDetail()->delete();
                $user->adamsQuestionaires()->delete();
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
                $apptReq = AppointmentRequest::where('user_id', '=', $user->id)->get()->pluck('id');
                if(sizeof($apptReq->toArray()) > 0){
                        AppointmentRequest::destroy($apptReq->toArray());		
                }
            } elseif($user->role == config("constants.DOCTOR_ROLE_ID")){
                    $user->doctorDetail()->delete();				
            } else{
                    $user->userDetail()->delete();				
            }
        });
    }	
}