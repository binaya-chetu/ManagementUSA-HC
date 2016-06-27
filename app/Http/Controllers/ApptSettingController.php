<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\AdamsQuestionaires;
use App\User;
use App\WebLead;
use App\AppointmentRequest;
use App\AppointmentSource;
use App\ReasonCode;
use App\AppointmentFollowup;
use App\Disease;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use App;
use Auth;

class ApptSettingController extends Controller {
    protected $user = '';
    protected $patient_role =   6;
    protected $doctor_role  =   5;
    protected $success = true;
    protected $error = false;

    public function __construct() {
        $this->middleware('auth');
    }
	
	public function getPatientHash($salt){
		return md5(uniqid($salt, true));
	}

    /*
     * Open the appointment form for telemarketing, walkin patient 
     * 
     * @param $value = 'marketingCall' or 'walkin'
     * 
     * @return \resource\view\apptsetting\index
     */

    public function index($value = null) {
        $patients = AppointmentRequest::groupBy('first_name')->get(['id', 'first_name', 'last_name', 'email']);
        $resources = AppointmentSource::lists('name', 'id');
        $reasonCode = ReasonCode::lists('reason', 'id')->toArray();
        $diseases = Disease::lists('title', 'id')->toArray();
        return view('apptsetting.index', [
            'value' => $value, 'patients' => $patients, 'resources' => $resources, 'reasonCode' => $reasonCode, 'diseases' => $diseases
        ]);
    }

    /**
     * Listing all the Call List from the Api
     *
     * @return \resource\view\apptsetting\call_list
     */
    public function marketingCall() {
        $patients = AppointmentRequest::get(['id', 'first_name', 'last_name', 'email']);
        $resources = AppointmentSource::lists('name', 'id');
        $reasonCode = ReasonCode::lists('reason', 'id')->toArray();
        return view('apptsetting.marketing_call', [
            'reasonCode' => $reasonCode, 'patients' => $patients, 'resources' => $resources
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
        if ($call->save()) {
            \Session::flash('flash_message', 'New data has been added successfully.');
            return redirect()->back();
        } else {
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
                ->where(['appt_type' => 1, 'followup_status' => 1, 'followup_date' => date('Y-m-d')])
                ->get();

        return view('apptsetting.web_lead', [
            'webLeads' => $webLeads, 'reasonCode' => $reasonCode, 'follows' => $follows
        ]);
    }

	public function emailPatientEditForm($user){
		$this->user = $user;
		$url = 'appointment/patientMedical/'.base64_encode($user->id).'/hash/'.$user->hash;
		$url = App::make('url')->to($url);

		\Mail::send('emails.pateintprofileaccess', ['url' => $url], function($message)
		{ 
			$message->to($this->user->email, 'Azmensclinic')->subject('Welcome!');
		});		
		return ['response' => true, 'msg' => $url];
	}
	
    /*
     * Common function to save the Followup with the patient details from Webleads & Telemarketing calls
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \Illuminate\View\View
     */

    public function saveApptFollowup(Request $request) {
       
        $apptRequest = new AppointmentRequest;
        $apptRequest->appt_source = $request->appt_source;
        $apptRequest->comment = $request->comment;
        $apptRequest->created_by = $request->created_by;
        $apptRequest->status = $request->status;
        $apptRequest->created_at = date('Y-m-d H:i:s', strtotime($request->created . " " . $request->created_time));
        if(isset($request->marketing_phone)){
            $apptRequest->marketing_phone = $request->marketing_phone;
        }
        // Case of Set for the Appointment request
        if ($request->status == '1') {
            $apptRequest->appt_time = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
            if (isset($request->email_invitation)) {
                $apptRequest->email_invitation = 1;  
            }
            $apptRequest->reason_id = $request->disease_id;
        } else { 
        // Case of NO Set for the Appointment request
            $apptRequest->reason_id = $request->reason_id;
            if (isset($request->followup_status)) {
                //$apptRequest->followup_date = date('Y-m-d', strtotime($request->followup_date));
                $apptRequest->followup_date = date('Y-m-d', strtotime('+7 days'));
                $apptRequest->followup_status = 1;
            }else if(isset($request->followup_status)){
                $apptRequest->followup_date = date('Y-m-d', strtotime($request->followup_date));
                $apptRequest->followup_status = 1;
            }
        }
        // Case of selecting patient from drop down 
        if (!empty($request->patient_id)) {            
            $requestPatient = AppointmentRequest::find($request->patient_id);
            
            $apptRequest->first_name = $requestPatient->first_name;
            $apptRequest->last_name = $requestPatient->last_name;
            $apptRequest->email = $requestPatient->email;
            $apptRequest->phone = $requestPatient->phone;
            $apptRequest->comment = $requestPatient->comment;
            $apptRequest->dob = $requestPatient->dob;
            if (isset($request->email_invitation)) {
                $apptRequest->email_invitation = 1;  
            }
            //$apptRequest->save();
            /* save the data in user, patient_detail, appointment with Set status */
            if ($request->status == '1') {
               
                // If already appointment request email exist or not                
                 if(!empty($requestPatient->email)){
                    $user = User::where('email', $requestPatient->email)
                                    ->select('id', 'email')
                                    ->get()->first();  
									
                    $user->hash = $this->getPatientHash($user->id);
                    $values = ['hash' => $user->hash, 'disease_id' => $request->disease_id];
                    App\Patient::where('user_id', $user->id)->update($values);
                }else{
                    $user = new User;
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->email = $request->email;
                    $user->role = $this->patient_role;
                    $user->save();
                    $patient = new Patient;
                    $patient->user_id = $user->id;
                    $patient->phone = $request->phone;
                    $patient->disease_id = $request->disease_id;
                    if (isset($request->dob)) {
                        $patient->dob = date('Y-m-d', strtotime($request->dob));
                    }

					$patient->hash = $this->getPatientHash($patient->user_id);
					$user->hash = $patient->hash;
					
                    $patient->save();
                }
				
				if(!empty($user->email) && isset($request->email_invitation)){
					$this->emailPatientEditForm($user);
				}
				
                $appointment = new Appointment;
                $appointment->apptTime = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
                $appointment->patient_id = $user->id;
                $appointment->createdBy = Auth::user()->id;
                $appointment->appt_source = $request->appt_source;
                $appointment->request_id = $apptRequest->id;
                $appointment->comment = $request->comment;                
                $appointment->save();
            }
        } else {
            echo 'check';
             
            $apptRequest->first_name = $request->first_name;
            $apptRequest->last_name = $request->last_name;
            $apptRequest->email = $request->email;
            $apptRequest->phone = $request->phone;
            if (!empty($request->dob)) {
                $apptRequest->dob = date('Y-m-d', strtotime($request->dob));
            }
           
            //$apptRequest->save();
            // Case for Set condtions to save the data in user, patient_detail, Appointment models
            if ($request->status == '1') {
                /* save the data in user, patient_detail, appointment with Set status */
                if(!empty($request->email)){
                    $exist_user = User::where('email', $_GET['email'])->where('role', '!=', 6)->count();
                }
                $user = new User;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->role = $this->patient_role;
                $user->save();
                echo '<pre>'; print_r($request->all());die;
                $patient = new Patient;
                $patient->user_id = $user->id;
                $patient->phone = $request->phone;
                $patient->disease_id = $request->disease_id;
                if (!empty($request->dob)) {
                    $patient->dob = date('Y-m-d', strtotime($request->dob));
                }

                $patient->hash = $this->getPatientHash($patient->user_id);
                $user->hash = $patient->hash;
                $patient->save();

                $adamQ = new AdamsQuestionaires();
                $adamQ->patient_id = $user->id;
                $adamQ->save();

                if(!empty($request->email) && isset($request->email_invitation)){
                        $this->emailPatientEditForm($user);
                }
				
                $appointment = new Appointment;
                $appointment->apptTime = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
                $appointment->patient_id = $user->id;
                $appointment->createdBy = Auth::user()->id;
                $appointment->appt_source = $request->appt_source;
                $appointment->request_id = $apptRequest->id;
                $appointment->comment = $request->comment;
                $appointment->save();
            }
        }
        if ($request->status == '1') {
            \Session::flash('flash_message', 'Appointment updated successfully.');
            return redirect()->action('AppointmentController@listappointment');        
        }else{
            \Session::flash('flash_message', 'Appointment updated successfully.');
            return redirect()->back();
        }       
    }
    
    /**
     * Function for the checking the enter email is already exist in appointment_request or not
     *
     * @return \Illuminate\View\View
     */
    public function uniqueEmail() {
        $appointment = AppointmentRequest::where('email', $_GET['email'])->count();
        if ($appointment) {
            echo json_encode($this->error); 
        } else {
            echo json_encode($this->success);
        }
        die;
    }
/*
     * Find the Appointment Request Detail at the time of appointment creation
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function findAppointmentDetail(Request $request) {        
        $appointment = AppointmentRequest::find($request['id']);
        if($appointment->id){
            echo json_encode($appointment);
        }else{
            echo json_decode($this->error);
        }        
        die;
    }
}
