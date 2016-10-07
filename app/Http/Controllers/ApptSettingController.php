<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\helpers;
use App\Patient;
use App\Appointment;
use App\AdamsQuestionaires;
use App\User;
use App\WebLead;
use App\AppointmentRequest;
use App\AppointmentSource;
use App\AppointmentReason;
use App\ReasonCode;
use App\AppointmentFollowup;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use App;
use Auth;
use App\Locations;

class ApptSettingController extends Controller {

    protected $user = '';
    protected $patient_role = 6;
    protected $doctor_role = 5;
    protected $success = true;
    protected $error = false;
    protected $confirmedAppointmentStatus = 4;

    public function __construct() {
        $this->middleware('auth');
    }

    public function getPatientHash($salt) {
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
        $patientRole = DB::table('roles')->select('id')->where('role_slug', config("constants.PATIENT_ROLE_SLUG"))->first();
        if (!$patientRole || !($patientRoleId = $patientRole->id)) {
            App::abort(404, 'Role patient not found.');
        }

        $patients = User::where(['users.role' => $patientRoleId, 'users.deleted_at' => null])
                ->select('users.id', 'users.first_name', 'users.last_name', 'users.email')
                ->get();
        $locations = DB::table('locations')->get();
       
        //$resources = AppointmentSource::lists('name', 'id');  // $resources not required remove if no error occur
        $noSetReasonCode = ReasonCode::where('type', '2')->lists('reason', 'id')->toArray();
        $setReasonCode = ReasonCode::where('type', '1')->lists('reason', 'id')->toArray();
        
        return view('apptsetting.index', [
            'value' => $value, 'patients' => $patients,'locations' => $locations,'noSetReasonCode' => $noSetReasonCode, 'setReasonCode' => $setReasonCode
        ]);
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
     * Listing all followups which are Requested and No set
     *
     * @return \resource\view\apptsetting\requestFollowUp
     */
    public function requestFollowUp() {
        $current_date = date('Y-m-d');
        $requestFollowups = AppointmentRequest::with('patient', 'patient.patientDetail', 'noSetReason', 'noSetReason.reasonCode')
                ->where('appointment_requests.status', 1)
                ->where('appointment_requests.followup_date', $current_date)
                ->where('appointment_requests.noSetStatus', 0)
                ->get();
        //echo '<pre>';print_r($requestFollowups->toArray());die;
        $noSetReasonCode = ReasonCode::where('type', '2')->lists('reason', 'id')->toArray();
        $resources = AppointmentSource::lists('name', 'id');
        $reasonCode = ReasonCode::where('type', '1')->lists('reason', 'id')->toArray();
        return view('apptsetting.requestFollowup', [
        'requestFollowups' => $requestFollowups, 'noSetReasonCode' => $noSetReasonCode, 'reasonCode' => $reasonCode, 'resources' => $resources]);
    }

    /*
     * 
     * Edit Request-Followups 
     * 
     * 
     */

    public function editRequestfollowup(Request $request) {
        $requestFollowup = AppointmentRequest::with('patient.patientDetail', 'noSetReason', 'noSetReason.reasonCode')->where('user_id', $request['id'])->get()->first();

        $combine['requestFollowup'] = $requestFollowup;
        echo json_encode($combine);
        die;
    }

    /*
     * Save the Marketign Calls 
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \resource\view\apptsetting\saveRequestFollowUp
     */

    public function saveRequestFollowUp(Request $request) {
        
        $formData = $request->all();
        
        if (!$formData) {
            App::abort(404, 'Empty form data.');
        }

        if ($formData['status'] == 1) {
            $formData['reason_id'] = $formData['noset_reason_id'];
        }

        $patientRole = DB::table('roles')->select('id')->where('role_slug', config("constants.PATIENT_ROLE_SLUG"))->first();
        if (!$patientRole || !($patientRole = $patientRole->id)) {
            App::abort(404, 'Cannot fetch role from database.');
        }

        $id = $formData['user_id'];
        $user = App\User::firstOrCreate(['id' => $id]);
        $id = $user->id;
         $requestId = $formData['appointment_request_id'];
        if (!empty($formData['email'])) {
            $userCheck = User::where('email', '=', $formData['email'])->first();
            if ($userCheck != null && $userCheck->id != $id) {
                \Session::flash('error_message', 'Email id you provided is already registered.');
                return Redirect::back();
            }
        }
        
        if ($formData['status'] == config("constants.APPOINTMENT_SET_FLAG")) {

            $user = User::where('id', $id)->first();
            $user->first_name = $formData['first_name'];
            $user->last_name = $formData['last_name'];
            $user->email = $formData['email'];
            $user->save();

            $patient = Patient::where('user_id', $id)->first();
            $patient->phone = $formData['phone'];
            $patient->dob = date('Y-m-d', strtotime($formData['dob']));
            $patient->save();
           
            $appointment_requests = App\AppointmentRequest::firstOrCreate(['id' => $requestId]);
            $exist_request = App\AppointmentRequest::where('user_id', $id)->first();
            $appointment_requests->user_id = $id;

            if (isset($exist_requests['marketing_phone'])) {
                $appointment_requests->marketing_phone = $exist_request['marketing_phone'];
            }

            $appointment_requests->created_by = Auth::user()->id;
            $appointment_requests->appt_source = $exist_request['appt_source'];
            $appointment_requests->status = $formData['status'];
            $appointment_requests->comment = $formData['comment'];
            $appointment_requests->followup_status = 0;
            $appointment_requests->save();

            $reason = new App\AppointmentReasons;
            $reason->patient_id = $id;
            $reason->reason_id = $formData['reason_id'];
            $reason->request_id = $appointment_requests->id;
            $reason->save();

            $appointment = new App\Appointment;
            $appointment->apptTime = date('Y-m-d H:i:s', strtotime($formData['appDate'] . " " . $formData['appTime']));
            $appointment->createdBy = Auth::user()->id;
            $appointment->patient_id = $user->id;
            $appointment->appt_source = $exist_request['appt_source'];
            $appointment->request_id = $appointment_requests->id;

            if (isset($formData['email_invitation'])) {
                $appointment->email_invitation = 1;
                $user->hash = $patient->hash;
                $this->emailPatientEditForm($user);
            }
            $apptDate = date('Y-m-d', strtotime($formData['appDate']));
            $today = date('Y-m-d');
            if ($today == $apptDate) {
                $appointment->status = $this->confirmedAppointmentStatus;
                $appointment->save();
                $followUp = new App\FollowUp;
                $followUp->action = $this->confirmedAppointmentStatus;
                $followUp->appt_id = $appointment->id;
                $followUp->created_by = Auth::user()->id;
                $followUp->comment = $appointment_requests->comment;
                $followUp->save();
            } else {
                $appointment->save();
            }
        } else {
           
            $user = User::where('id', $id)->first();
            $user->first_name = $formData['first_name'];
            $user->last_name = $formData['last_name'];
            $user->email = $formData['email'];
            $user->save();

            $patient = Patient::where('user_id', $id)->first();
            $patient->phone = $formData['phone'];
            $patient->dob = date('Y-m-d', strtotime($formData['dob']));
            $patient->never_treat_status = 1;
            $patient->save();

            $exist_request = AppointmentRequest::where('user_id', $id)->first();
            $appointment_requests = new App\AppointmentRequest;
            $appointment_requests->user_id = $id;

            if (isset($exist_requests['marketing_phone'])) {
                $appointment_requests->marketing_phone = $exist_request['marketing_phone'];
            }

            $appointment_requests = App\AppointmentRequest::firstOrCreate(['id' => $requestId]);
            $appointment_requests->created_by = Auth::user()->id;
            $appointment_requests->appt_source = $exist_request['appt_source'];
            $appointment_requests->status = $formData['status'];
            $appointment_requests->comment = $formData['comment'];
            $appointment_requests->followup_status = 0;
            $appointment_requests->noSetStatus = 1;
            $appointment_requests->save();
             //echo '<pre>'; print_r($appointment_requests);die;
            $reason = new App\AppointmentReasons;
            $reason->patient_id = $id;
            $reason->reason_id = $formData['reason_id'];
            $reason->request_id = $appointment_requests->id;
            $reason->save();
        }

        if ($formData['status'] == config("constants.APPOINTMENT_SET_FLAG")) {
            \Session::flash('flash_message', 'Appointment added successfully.');
            return redirect()->action('ApptSettingController@requestFollowUp');
        } else {
            \Session::flash('flash_message', 'Appointment ended successfully.');
            return redirect()->action('ApptSettingController@requestFollowUp');
        }
    }

    public function emailPatientEditForm($user) {
        $this->user = $user;
        $url = 'appointment/patientMedical/' . base64_encode($user->id) . '/hash/' . $user->hash;
        $url = App::make('url')->to($url);
        \Mail::send('emails.pateintprofileaccess', ['url' => $url], function($message) {
            $message->to($this->user->email, 'Azmens Clinic')->subject('Welcome!');
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

    public function saveAppointment(Request $request) {
        $formData = $request->all();
       
        if ($formData['status'] == 1) {
            $formData['reason_id'] = $formData['noset_reason_id'];
        }
        if (!$formData) {
            App::abort(404, 'Empty form data.');
        }

        $patientRole = DB::table('roles')->select('id')->where('role_slug', config("constants.PATIENT_ROLE_SLUG"))->first();
        if (!$patientRole || !($patientRole = $patientRole->id)) {
            App::abort(404, 'Cannot fetch role from database.');
        }
        $id = $formData['patient_id'];
        $user = App\User::firstOrCreate(['id' => $id]);
        $id = $user->id;

        if (!empty($formData['email'])) {
            $userCheck = User::where('email', '=', $formData['email'])->first();
            if ($userCheck != null && $userCheck->id != $id) {
                \Session::flash('error_message', 'Email id you provided is already registered.');
                return Redirect::back();
            }
        }

        $user->first_name = $formData['first_name'];
        $user->last_name = $formData['last_name'];
        $user->email = $formData['email'];
        $user->role = $patientRole;        
        $user->save();
        
        $patient = App\Patient::firstOrCreate(['user_id' => $id]);
        $patient->phone = $formData['phone'];
        $patient->dob = date_create($formData['dob']);
        $patient->hash = $this->getPatientHash($id);
         ///saving location id
        
        $patient->location_id = $formData['location_id'];
        $patient->save();
        
        //$appointment_requests = App\AppointmentRequest::firstOrCreate(['user_id' => $id]);
        $appointment_requests = new App\AppointmentRequest;
        $appointment_requests->user_id = $id;
        if (isset($formData['marketing_phone'])) {
            $appointment_requests->marketing_phone = $formData['marketing_phone'];
        }
        $appointment_requests->created_by = $formData['created_by'];
        $appointment_requests->appt_source = $formData['appt_source'];
        $appointment_requests->status = $formData['status'];
        $appointment_requests->comment = $formData['comment'];
        ///saving location id
        $appointment_requests->location_id = $formData['location_id'];
        $appointment_requests->created_at = date('Y-m-d H:i:s', strtotime($formData['created'] . " " . $formData['created_time']));
        if (isset($formData['followup_status'])) {
            $appointment_requests->followup_date = date('Y-m-d', strtotime('+7 days'));
            $appointment_requests->followup_status = 1;
        } else {
            if(isset($formData['followup_date'])){
                $appointment_requests->followup_date = date('Y-m-d', strtotime($formData['followup_date']));
            }            
            $appointment_requests->followup_status = 0;
        }
        $appointment_requests->save();
        $reason = new App\AppointmentReasons;
        $reason->patient_id = $id;
        $reason->reason_id = $formData['reason_id'];
        $reason->request_id = $appointment_requests->id;
        $reason->save();

        if ($formData['status'] == config("constants.APPOINTMENT_SET_FLAG")) {
            $appointment = new App\Appointment;
            $appointment->patient_id = $id;
            $appointment->apptTime = date('Y-m-d H:i:s', strtotime($formData['appDate'] . " " . $formData['appTime']));
            $appointment->createdBy = Auth::user()->id;
            $appointment->patient_id = $user->id;
            $appointment->appt_source = $formData['appt_source'];
            $appointment->request_id = $appointment_requests->id;
            $appointment->comment = $formData['comment'];
            if (isset($formData['email_invitation'])) {
                $appointment->email_invitation = 1;
                $user->hash = $patient->hash;
                $this->emailPatientEditForm($user);
            }

            $apptDate = date('Y-m-d', strtotime($formData['appDate']));
            $today = date('Y-m-d');
            if ($today == $apptDate) {
                $appointment->status = $this->confirmedAppointmentStatus;
                $appointment->save();
                $followUp = new App\FollowUp;
                $followUp->action = $this->confirmedAppointmentStatus;
                $followUp->appt_id = $appointment->id;
                $followUp->created_by = Auth::user()->id;
                $followUp->comment = $appointment_requests->comment;
                $followUp->save();
            } else {
                $appointment->save();
            }
        }
        // Case of selecting patient from drop down 
        if ($formData['status'] == config("constants.APPOINTMENT_SET_FLAG")) {
            \Session::flash('flash_message', 'Appointment added successfully.');
            return redirect()->action('AppointmentController@listappointment');
        } else {
            \Session::flash('flash_message', 'Appointment put on the hold successfully.');
            return redirect()->back();
        }
    }

    /**
     * Function for the checking the enter email is already exist in users table or not
     *
     * @return \Illuminate\View\View
     */
    public function uniqueEmail() {
        
        $appointment = User::where('email', $_GET['email'])->count();
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
        $appointment = DB::table('users')
                ->leftJoin('patient_details', 'users.id', '=', 'patient_details.user_id')
                ->where('users.id', $request['id'])
                ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'patient_details.phone', 'patient_details.dob')
                ->first();

        if ($appointment && $appointment->id) {
            echo json_encode($appointment);
        } else {
            echo json_decode($this->error);
        }
        die;
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

    /*
     * Common function to make the another Appointment for preveios Appointment request
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \Illuminate\View\View
     */

    public function anotherAppointment(Request $request) {
        $formData = $request->all();        
        if (!$formData) {
            App::abort(404, 'Empty form data.');
        }

        $patientRole = DB::table('roles')->select('id')->where('role_slug', config("constants.PATIENT_ROLE_SLUG"))->first();
        if (!$patientRole || !($patientRole = $patientRole->id)) {
            App::abort(404, 'Cannot fetch role from database.');
        }

        $id = $formData['patient_id'];
        $user = User::where('id', $id)->first();
        $id = $user->id;
        if (!empty($formData['email'])) {
            $userCheck = User::where('email', '=', $formData['email'])->first();
            if ($userCheck != null && $userCheck->id != $id) {
                \Session::flash('error_message', 'Email id you provided is already registered.');
                return Redirect::back();
            }
        }
        $user->first_name = $formData['first_name'];
        $user->last_name = $formData['last_name'];
        $user->email = $formData['email'];

        $user->save();

        $patient = Patient::where('user_id', $id)->first();
        $patient->phone = $formData['phone'];
        $patient->dob = date('Y-m-d', strtotime($formData['dob']));
        $patient->save();

        $relative_appointment = Appointment::where('id', $formData['appointment_id'])->first();

        $relative_appointment->progress_status = config("constants.APPOINTMENT_AFTER_REPORT_FLAG");
        $relative_appointment->save();

        $exist_request = AppointmentRequest::where('id', $formData['appointment_request_id'])->first();
        $appointment_requests = new App\AppointmentRequest;
        $appointment_requests->user_id = $id;
        if (isset($exist_requests['marketing_phone'])) {
            $appointment_requests->marketing_phone = $exist_request['marketing_phone'];
        }
        $appointment_requests->created_by = Auth::user()->id;
        $appointment_requests->appt_source = $exist_request['appt_source'];
        $appointment_requests->status = $formData['status'];
        $appointment_requests->comment = $formData['comment'];
        if (isset($formData['followup_status'])) {
            $appointment_requests->followup_date = date('Y-m-d', strtotime('+7 days'));
            $appointment_requests->followup_status = 1;
        } else if (isset($formData['followup_date'])){
            $appointment_requests->followup_date = date('Y-m-d', strtotime($formData['followup_date']));
            $appointment_requests->followup_status = 0;
        }
        $appointment_requests->save();
        if(isset($formData['reason_id'])){
        $reason = new App\AppointmentReasons;
        $reason->patient_id = $id;
        $reason->reason_id = $formData['reason_id'];
        $reason->request_id = $appointment_requests->id;
        $reason->save();
        }

        if ($formData['status'] == config("constants.APPOINTMENT_SET_FLAG")) {
            $appointment = new App\Appointment;
            $appointment->patient_id = $id;
            $appointment->relative_id = $relative_appointment['id'];
            $appointment->apptTime = date('Y-m-d H:i:s', strtotime($formData['appDate'] . " " . $formData['appTime']));
            $appointment->createdBy = Auth::user()->id;
            $appointment->patient_id = $user->id;
            $appointment->appt_source = $exist_request['appt_source'];
            $appointment->request_id = $appointment_requests->id;
            $appointment->comment = $formData['comment'];
            if (isset($formData['email_invitation'])) {
                $appointment->email_invitation = 1;
                $user->hash = $patient->hash;
                $this->emailPatientEditForm($user);
            }
            $apptDate = date('Y-m-d', strtotime($formData['appDate']));
            $today = date('Y-m-d');
            if ($today == $apptDate) {
                $appointment->status = $this->confirmedAppointmentStatus;
                $appointment->save();
                $followUp = new App\FollowUp;
                $followUp->action = $this->confirmedAppointmentStatus;
                $followUp->appt_id = $appointment->id;
                $followUp->created_by = Auth::user()->id;
                $followUp->comment = $appointment_requests->comment;
                $followUp->save();
            } else {
                $appointment->save();
            }
        }
        // Case of selecting patient from drop down 
        if ($formData['status'] == config("constants.APPOINTMENT_SET_FLAG")) {
            \Session::flash('flash_message', 'Appointment added successfully.');
            return redirect()->action('AppointmentController@listappointment');
        } else {
            \Session::flash('flash_message', 'Appointment put on the hold successfully.');
            return redirect()->back();
        }
    }

    /**
     * Function for the showing the MSAccess Database data
     *
     * @return \Illuminate\View\View
     */
    public function showAccessData() {
        $dbName = realpath( "managementUSA.mdb"); 
        $connection = odbc_connect("Driver={Microsoft Access Driver (*.mdb)};Dbq=$dbName",'root', '');
        $resultset=odbc_exec($connection, "SELECT * FROM user");
        odbc_result_all($resultset,"border=1");
        die;
    }
    
    /**
     * Function for the showing the PDF Files
     *
     * @return \Illuminate\View\View
     */
    public function pdfList() {
      return view('apptsetting.pdf_list');
    }

}
