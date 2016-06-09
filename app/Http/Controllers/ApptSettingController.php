<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\User;
use App\WebLead;
use App\TelemarketingCall;
use App\ReasonCode;
use App\AppointmentFollowup;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use App;
use Auth;

class ApptSettingController extends Controller
{
    protected $patient_role = 6;
    protected $doctor_role = 5;
    protected $success = true;
    protected $error = false;

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Listing all the Call List from the Api
     *
     * @return \resource\view\apptsetting\call_list
     */
    public function marketingCall() {    
        $calls = TelemarketingCall::where('status', 0)->get();
        $reasonCode = ReasonCode::lists('reason', 'id')->toArray();
        $follows = AppointmentFollowup::with('web_lead')
                                        ->where(['appt_type'=>2, 'followup_status' => 1, 'followup_date' => date('Y-m-d') ])
                                        ->get();
        return view('apptsetting.marketing_call', [
            'calls' => $calls, 'reasonCode' => $reasonCode, 'follows' => $follows
        ]);
    }
    
    /*
     * Save the Marketign Calls 
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \resource\view\apptsetting\marketingCall
     */
    public function saveMarketingCall(Request $request) {
        $call = new TelemarketingCall();
        $call->requested_date = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
        $call->first_name = $request->first_name;
        $call->last_name = $request->last_name;
        $call->email = $request->email;
        $call->phone = $request->phone;
        $call->comment = $request->comment;       
        if($call->save()){
            \Session::flash('flash_message', 'New data has been added successfully.');
            return redirect()->back();
        }else{
            \Session::flash('flash_message', 'Some error occured.');
            return redirect()->back();
        }
    }
    
    /**
     * Listing all the Call List from the Api
     *
     * @return \resource\view\apptsetting\call_list
     */
    public function missedCall() {        
        return view('apptsetting.missed_call');
    }
    
    /**
     * Listing all the Call List from the Api
     *
     * @return \resource\view\apptsetting\call_list
     */
    public function webLead() {        

        $webLeads = WebLead::where('status', 0)->get();
        $reasonCode = ReasonCode::lists('reason', 'id')->toArray();
        $follows = AppointmentFollowup::with('web_lead')
                                        ->where(['appt_type'=>1, 'followup_status' => 1, 'followup_date' => date('Y-m-d') ])
                                        ->get();
        
        return view('apptsetting.web_lead', [
            'webLeads' => $webLeads, 'reasonCode' => $reasonCode, 'follows' => $follows
        ]);
    }
   /**
     * Listing all the Call List from the Api
     *
     * @return \resource\view\apptsetting\call_list
     */
    public function directWalkins() {        
           
        $webLeads = WebLead::where('status', 0)->get();
        $reasonCode = ReasonCode::lists('reason', 'id')->toArray();
        return view('apptsetting.web_lead', [
            'webLeads' => $webLeads, 'reasonCode' => $reasonCode
        ]);
    } 
    /*
     * Common function to save the Followup with the patient details from Webleads & Telemarketing calls
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \Illuminate\View\View
     */
    public function saveApptFollowup(Request $request) {
        
        if($request->appt_type == 2){
            $data = TelemarketingCall::find($request->appt_id);
        }else{
            $data = WebLead::find($request->appt_id);
        }
        if($request->status == 1){
            $user = new User;
            $user->first_name = $data->first_name;
            $user->last_name = $data->last_name;
            $user->email = $data->email;
            $user->role = $this->patient_role;
            $user->save();
            $patient = new Patient;
            $patient->user_id = $user->id;
            $patient->phone = $data->phone;
            $patient->save();
            $appointment = new Appointment;
            $appointment->apptTime = $data->requested_date;
            $appointment->patient_id = $user->id;
            $appointment->createdBy = Auth::user()->id;
            $appointment->save();
            
        }
        
        $appointmentFollowup = new AppointmentFollowup;
        
        if($request->status == 2){
            $appointmentFollowup->reason_id = $request->reason_id;
            $appointmentFollowup->comment = $request->comment;
            if(isset($request->followup_status)){
                $appointmentFollowup->followup_date = date('Y-m-d', strtotime('+7 days'));
                $appointmentFollowup->followup_status = 1;
            }   
        }
        $appointmentFollowup->appt_id = $request->appt_id;
        $appointmentFollowup->appt_type = $request->appt_type;        
        $appointmentFollowup->status = $request->status;
        $data->status = 1;
        $data->save();
        if($appointmentFollowup->save()){
            \Session::flash('flash_message', 'Appointment updated successfully.');
            return redirect()->back();
        }else{
            \Session::flash('flash_message', 'Some error Occured.');
            return redirect()->back();
        }
    }
    
}
