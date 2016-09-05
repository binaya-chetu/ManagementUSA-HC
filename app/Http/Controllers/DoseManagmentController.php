<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Config\Repository;
use View;
use App;
use DB;
use Exception;
use App\User;

class DoseManagmentController extends Controller
{
    protected $success = false;
    protected $patient_role = 6;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $patients = User::where('role', $this->patient_role)
                        ->join('patient_details', function ($join) {
                                $join->on('users.id', '=', 'patient_details.user_id')
                                     ->where('patient_details.never_treat_status', '=', 0);
                            })->get(['users.id', 'first_name', 'last_name']);
        
        return view('doses.doseManagement',['patients' => $patients ]);
    }
   
    
    public function getPatientDetails(Request $request) {
        $patientData = User::with('patientDetail')->where('id',$request->patient_id)->get();
        return $patientData;
        die;
    }
    
}
