<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Appointment;
use App\User;
use App\Role;
use App\FollowupStatus;
use Auth;
use App\State;
use App\UserDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * This class is used to handle home page related action
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class HomeController extends Controller {

    // declear properties for patient role and doctor role
    protected $doctor_role = 5;
    protected $patient_role = 6;

    /**
     * Create a new controller instance.
     *
     * @return null
     */
    public function __construct() {
        // uses auth middleware
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard with calender scheduler.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get all appointments which status is active
        
        $location_id = Session::get('location_id');
        if (isset($location_id) && $location_id > 0) {
            $location = DB::table('appointments')
                    ->join('appointment_requests', 'appointment_requests.id', '=', 'appointments.request_id')
                    ->where('location_id', '=', Session::get('location_id'))
                    ->select('appointments.id')
                    ->get();
            $appt_id = array();
            foreach ($location as $loc) {
                $appt_id[] = $loc->id;
            }
            $appointments = $appointments = Appointment::with(['patient.patientDetail','appointmentRequest.locations', 'patient.reason', 'patient.reason.reasonCode'])->whereIn('status', [1, 4])->whereIn('id', $appt_id)->get();

        } else {
           $appointments = Appointment::with(['patient.patientDetail','appointmentRequest.locations', 'patient.reason', 'patient.reason.reasonCode'])->whereIn('status', [1, 4])->get();
        } 

        $collevent = [];
        $i = 0;
        foreach ($appointments as $appointment) {
            //echo '<pre>'; print_r($appointment->toArray());
            $events = [];
            $events ['id'] = $appointment->id;
            $reasonArr = $appointment->patient->reason->toArray();
            $reasonArray = array_column($reasonArr, 'reason_code');
            $reasonList = array_column($reasonArray, 'reason');
            $reason = implode(',', $reasonList);

            if ($appointment->patient && $appointment->patient->reason) {
                $reasonArr = $appointment->patient->reason->toArray();
                $reasonArray = array_column($reasonArr, 'reason_code');
                $reasonList = array_column($reasonArray, 'reason');
                $reason = implode(',', $reasonList);
            }

            $events ['title'] = $reason;
            if ($appointment->patient) {
                $events ['patientName'] = 'Patient: ' . $appointment->patient->first_name . " " . $appointment->patient->last_name;
            } else {
                $events ['patientName'] = '';
            }
            if ($appointment->patient && $appointment->patient->patientDetail) {
                $events ['mobile'] = 'Phone: ' . $appointment->patient->patientDetail->phone;
                if($appointment->patient->patientDetail->patient_status == 1){
                    $events ['color'] = '#47a447';
                }else{
                    $events ['color'] = '#0088cc';
                }
                
            }
            $events ['start'] = $appointment->apptTime;
            $events ['end'] = date('Y-m-d H:i:s', strtotime($appointment->apptTime . '+ 30 minute'));
            $collevent[$i] = $events;
            $i++;
        }
   
        // get all patients list
        $patients = User::where('role', $this->patient_role)->get();
        // get all doctors list
        $doctors = User::where('role', $this->doctor_role)->get();
        $followupStatus = FollowupStatus::select('id', 'title')
            ->where('status', 1)
            ->get();

        return view('appointment.viewappointment', [
            'appointments' => $collevent,
            'patients' => $patients,
            'doctors' => $doctors,
            'followupStatus' => $followupStatus
        ]);
    }
    
    
   
    /** Niwedita : to show the profile details of user
    * This function is used to view the patient details.
    *
    * @return \Illuminate\Http\Response
    */
    public function userProfile() {
       $user_id =  Auth::user()->id;
       if (!($user = User::with(
               'userDetail',
               'userDetail.userStateName',
               'roleName'
            )
            ->find($user_id))) {
            App::abort(404, 'Page not found.');
        }
         
        return view('homes.user_profile', [
            'user' => $user
        ]);
    }
    
    /**
     * This function is used to fetch layout of edit user profile form and user details to display on that form
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function editUserProfile($id = null) {
        if (!($user = User::with('userDetail')->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }

        // get the state list from state table
        $states = State::lists('name', 'id')->toArray();

        return view('homes.edit_user_profile', [
            'user' => $user,
            'states' => $states
        ]);
    }
    
    /**
     * This function is used to update the user profile detail
     *
     * @param $id and $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserProfile($id = null, Request $request) {
        if (!($userData = User::find($id))) {
            App::abort(404, 'Page not found.');
        }

        // validation rule
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15'
        ]);

        $userInput['first_name'] = $request->first_name;
        $userInput['last_name'] = $request->last_name;

        // get user details data by user id
        $userDetailData = UserDetail::where('user_id', $id)->get();
        if ($request->dob) {
            $userDetailInput['dob'] = date('Y-m-d', strtotime($request->dob));
        }
        $userDetailInput['gender'] = $request->gender;
        $userDetailInput['phone'] = $request->phone;
        $userDetailInput['address1'] = $request->address1;
        $userDetailInput['address2'] = $request->address2;
        $userDetailInput['city'] = $request->city;
        $userDetailInput['state'] = $request->state;
        $userDetailInput['zipCode'] = $request->zipCode;
        // save user data in user table and user details data in user details table.
        if ($userData->fill($userInput)->save() && $userDetailData[0]->fill($userDetailInput)->save()) {
            \Session::flash('flash_message', 'User Profile updated successfully.');
            return redirect('/home/userProfile');
        } else {
            return redirect('/home/editUserProfile');
        }
    }

}
