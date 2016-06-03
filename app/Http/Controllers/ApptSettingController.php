<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WebLead;
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
    public function callList() {        
        return view('apptsetting.call_list');
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
        return view('apptsetting.web_lead', [
            'webLeads' => $webLeads, 'reasonCode' => $reasonCode
        ]);
    }
    /*
     * Save the Apointment with the patient details
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \Illuminate\View\View
     */
    public function saveApptFollowup(Request $request) {
        $web = WebLead::find($request->appt_id);
        $appointmentFollowup = new AppointmentFollowup;
        $appointmentFollowup->appt_id = $request->appt_id;
        $appointmentFollowup->reason_id = $request->reason_id;
        $appointmentFollowup->comment = $request->comment;
        $appointmentFollowup->status = $request->status;
        $web->status = 1;
        $web->save();
        if($request->status == 2){
            $appointmentFollowup->save();
            \Session::flash('flash_message', 'Appointment updated successfully.');
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    
}
