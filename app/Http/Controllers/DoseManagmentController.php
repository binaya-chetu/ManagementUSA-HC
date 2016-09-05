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
use Auth;
use Exception;
use App\User;
use App\Patient;
use App\TrimixDoses;

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
        $patientData = User::with('patientDetail', 'trimixDoses')->where('id',$request->patient_id)->first();
        return $patientData;
        exit();
    }
    
    /**
     * This function is used to save the new role in tables.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // define validation rule
        $this->validate($request, [
            'doctor' => 'required',
            'amount1' => 'required',
            'medicationA1' => 'required',
            'amount2' => 'required',
            'medicationA2' => 'required',
            'amount3' => 'required',
            'medicationB1' => 'required',
            'amount4' => 'required',
            'medicationB2' => 'required'
        ]);
        
        //echo "<pre>";print_r($request->all());die;
        // create User object
        $trimixData = new TrimixDoses;
        
        $trimixData->patient_id = $request->patient_id;
        $trimixData->agent_id = Auth::user()->id;
        $trimixData->dose_type = 'A';
        $trimixData->quantity = (isset($request->quantity)) ? $request->quantity : 1;
        $trimixData->doctor = $request->doctor;
        $trimixData->amount1 = $request->amount1;
        $trimixData->medicationA1 = $request->medicationA1;
        $trimixData->amount2 = $request->amount2;
        $trimixData->medicationA2 = $request->medicationA2;
        $trimixData->amount3 = $request->amount3;
        $trimixData->medicationB1 = $request->medicationB1;
        $trimixData->amount4 = $request->amount4;
        $trimixData->medicationB2 = $request->medicationB2;
        $trimixData->antidote = (isset($request->antidote)) ? $request->antidote : '';
        $trimixData->dose_start_date = date('Y-m-d h:i:s');
        
        // save user data in user table
        if ($trimixData->save()) {
            // set the flash message.
            \Session::flash('flash_message', 'Doses saved successfully.');
            return redirect('/doses/doseManagement');
        } else {
            \Session::flash('flash_message', 'There are something went wrong Plz Try again.');
            return Redirect::back();
        }
    }
    
}
