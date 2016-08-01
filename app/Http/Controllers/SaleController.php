<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\FollowupReschedule;
use App\AppointmentRequest;
use App\AdamsQuestionaires;
use App\Doctor;
use App\User;
use App\FollowUp;
use App\State;
use App\FollowupStatus;
use App\ReasonCode;
use App\Categories;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Config\Repository;
use Session;
use App;
use Auth;

class SaleController extends Controller
{
    protected $patient_role = 6;
    protected $doctor_role = 5;
    public $success = true;
    public $error = false;
    
    /**
     * Make the front Office Sale
     *
     * @return \resource\view\sale\index.blade.php
     *  */
    public function index() {
        $patients = User::where('role', $this->patient_role)
                        ->join('patient_details', function ($join) {
                                $join->on('users.id', '=', 'patient_details.user_id')
                                     ->where('patient_details.never_treat_status', '=', 0);
                            })->get(['users.id', 'first_name', 'last_name']);
        $categories = Categories::lists('cat_name', 'id')->toArray();
        
        return view('sale.index', [
            'patients' => $patients, 'categories' =>$categories
        ]);
    }
}
