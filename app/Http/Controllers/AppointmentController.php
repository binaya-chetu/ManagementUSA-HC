<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\Doctor;
use App\User;
use App\Followup;
use App\State;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use App;
use Auth;

class AppointmentController extends Controller {

    protected $patient_role = 6;
    protected $doctor_role = 5;
    protected $success = true;
    protected $error = false;

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * 
     * @return \resource\view\appointment\newappointment.blade.php
     *  */
    public function index($id = null) {
        $patients = User::where('role', $this->patient_role)->get(['id', 'first_name', 'last_name']);

        $doctors = User::where('role', $this->doctor_role)->get(['id', 'first_name', 'last_name']);
        if (empty($id)) {
            $id = '';
        }
        return view('appointment.new_appointment', [
            'patients' => $patients, 'doctors' => $doctors, 'appointments' => array(), 'id' => base64_decode($id)
        ]);
    }

    /*
     * function to find the doctor detail by dcotor id
     *      
     * @param $doctor_id
     * 
     * @return \Illuminate\Http\Response
     */
    public function fetchDoctorSchedule($doctor_id) {
        $appointment = new Appointment;
        $appointments = $appointment->where('doctor_id', $doctor_id)->get();

        $collevent = array();
        foreach ($appointments as $appointment) {
            $events = array();
            $events ['title'] = $appointment->patient->first_name . ' ' . $appointment->patient->last_name;
            $events ['patient_email'] = $appointment->patient->email;
            $events ['patient_phone'] = $appointment->patient->phone;
            $events ['start'] = $appointment->apptTime;
            $collevent[] = $events;
        }
        return $collevent;
    }

    /*
     * function to create a new appointment with patient & doctor id
     *      
     *  @param Illuminate\Http\Request 
     * 
     * @return \Illuminate\Http\Response
     */
    public function addPatAppointment(Request $request) {

        $appointment = new Appointment;
        $appointment->apptTime = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
        $appointment->createdBy = $request->createdBy;
        $appointment->lastUpdatedBy = $request->lastUpdatedBy;
        $appointment->patient_id = $request->patient_id;
        $appointment->marketer = $request->marketer;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->comment = $request->comment;

        if ($appointment->save()) {
            return $appointment->id;
        } else {
            return 0;
        }
    }

    /*
     * function to create a new appointment
     *      
     *  @param Illuminate\Http\Request 
     * 
     * @return \resource\view\appointment\newappointment.blade.php or \resource\view\appointment\viewappointment.blade.php
     */
    public function addappointment(Request $request) {
        $data = Input::all();
        $date = $data['appDate'];
        $time = $data['appTime'];
        $doctor_id = $request->doctor_id;

        $messages = [
            'after' => ':attribute cannot be a past date',
            'future_date' => 'Appointment cannot be set for past',
            'doctor_availability' => 'Sorry this time slot is not available'
        ];

        $validator = Validator::make($data, [
                    'appDate' => 'required|date|future_date:' . $time . '|doctor_availability:' . $time . ',' . $doctor_id,
                    'comment' => 'required',
                        ], $messages);

        if ($validator->fails()) {
            return Redirect::to('/appointment/newAppointment')->withInput()->withErrors($validator->errors());
        }

        if (empty($request->patient_id)) {

            $controller = new PatientController();
            if (!($request->patient_id = $controller->saveAppointmentPatient($request))) {
                \Session::flash('flash_message', 'some occur occcured in patient detail.');
                return Redirect::action('AppointmentController@newAppointment');
            }
        }
        if ($this->addPatAppointment($request)) {
            \Session::flash('flash_message', 'Appointment added successfully.');
            return Redirect::action('AppointmentController@viewappointment');
        }
    }

    /*
     * function to show all the appointment in calendar view
     * 
     * @return \resource\view\appointment\viewappointment.blade.php
     */
    public function show() {
        $appointment = new Appointment;
        $appointments = $appointment->get();

        return view('appointment.viewappointment', [
            'appointments' => $appointments
        ]);
    }

    /*
     * Find the doctor schedule
     * 
     * @return \Illuminate\Http\Response
     */
    public function getdoctorschedule() {
        $doctor_id = Input::get('doctor_id');
        $collevent = $this->fetchDoctorSchedule($doctor_id);
        echo json_encode($collevent);
    }

    /*
     * Find the list of all appointment with Patient & Doctor details
     * 
     * @return \resource\view\appointment\listappointment.blade.php
     */
    public function listappointment() {

        $appointments = Appointment::with('patient')->get();
        $patients = User::where('role', $this->patient_role)->get();
        $doctors = User::where('role', $this->doctor_role)->get();

        return view('appointment.listappointment', [
            'appointments' => $appointments, 'patients' => $patients, 'doctors' => $doctors
        ]);
    }

    /*
     * Find the Appointment details with patient & doctor
     * 
     * @return \resource\view\appointment\viewappointment.blade.php
     */
    public function viewappointment() {
        $appointments = Appointment::with('patient.patientDetail')->whereIn('status', [1, 4])->get();
        $collevent = array();
        $i = 0;
        foreach ($appointments as $appointment) {
            $events = array();
            $events ['id'] = $appointment->id;
            $events ['title'] = 'Appointment#' . $appointment->id;
            $events ['patientName'] = 'Patient: ' . $appointment->patient->first_name . " " . $appointment->patient->last_name;
            $events ['mobile'] = 'Phone: ' . $appointment->patient->patientDetail->phone;
            $events ['start'] = $appointment->apptTime;
            $events ['end'] = date('Y-m-d H:i:s', strtotime($appointment->apptTime . '+ 30 minute'));
            $events ['color'] = '#0088cc';
            $collevent[$i] = $events;
            $i++;
        }

        $patients = User::where('role', $this->patient_role)->get();
        $doctors = User::where('role', $this->doctor_role)->get();
        return view('appointment.viewappointment', [
            'appointments' => $collevent, 'patients' => $patients, 'doctors' => $doctors
        ]);
    }

    /*
     * Find the Appointment details with patient & doctor
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function editappointment(Request $request) {
        $appointment = Appointment::with('patient.patientDetail')->find($request['id']);
        $patient = $appointment->patient;
        $doctor = $appointment->doctor;
        $combine = array();
        $combine['appointment'] = $appointment;
        $combine['patient'] = $patient;
        $combine['doctor'] = $doctor;
        echo json_encode($combine);
        die;
    }

    /*
     * Save the Apointment with the patient details
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \Illuminate\View\View
     */
    public function saveappointment(Request $request) {

        $appointment = Appointment::find($request->appointment_id);
        $appointment->apptTime = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
        $appointment->lastUpdatedBy = $request->lastUpdatedBy;
        $appointment->patient_id = $request->patient_id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->marketer = $request->marketer;
        $appointment->clinic = $request->clinic;
        $appointment->comment = $request->comment;

        $patient = User::find($request->patient_id);
        $patientInput['first_name'] = $request->first_name;
        $patientInput['last_name'] = $request->last_name;
        $patientDetailData = Patient::where('user_id', $request->patient_id)->get();
        if ($request->dob) {
            $patientDetailInput['dob'] = date('Y-m-d', strtotime($request->dob));
        }
        $patientDetailInput['gender'] = $request->gender;
        $patientDetailInput['phone'] = $request->phone;
        $patientDetailInput['address1'] = $request->address1;
        if ($patient->fill($patientInput)->save() && $patientDetailData[0]->fill($patientDetailInput)->save()) {
            $appointment->save();
            \Session::flash('flash_message', 'Appointment updated successfully.');
            return redirect()->back();
        }
    }
    
    /*
     * Delete the Appointment
     * 
     * @param $id as Appointment id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteappointment($id = null) {
        $id = base64_decode($id);
        if (Appointment::find($id)->delete()) {
            \Session::flash('flash_message', 'Appointment deleted successfully.');
            return redirect()->back();
        }
    }

    /*
     * Submit Patient and Appointment Date in Single Call.
     * 
     * @param Illuminate\Http\Request
     */

//    public function editpatientappointment(Request $request) {
//        $request->merge(array('patient_id' => 12));
//        $request->merge(array('address2' => 'Lorren Epsum'));
//        $request->merge(array('city' => 'Lorren Epsum'));
//        $request->merge(array('state' => 'Lorren Epsum'));
//        $request->merge(array('zipCode' => 000));
//        $request->merge(array('occupation' => 000));
//        $controller = new PatientController();
//        $patient_id = $controller->savePatientDetail($request);
//        $request->merge(array('patient_id' => $patient_id));
//        if ($patient_id) {
//            $this->addPatAppointment($request);
//            \Session::flash('flash_message', 'Appointment added successfully.');
//            ;
//            return "Success";
//        } else {
//            return "Error";
//        }
//        die;
//    }

    /**
     * Function for the checking the enter email is already exist or not
     *
     * @return \Illuminate\View\View
     */
    public function uniquePatientEmail() {
        $appointment = User::where('email', $_GET['email'])->count();
        if ($appointment) {
            echo $this->error; 
        } else {
            echo $this->success;
        }
        die;
    }

    /**
     * Function for the saving the followup with the appointment
     *
     * @return \Illuminate\View\View
     */
    public function saveAppointmentFolloup(Request $request) {
        if (!($appointment = Appointment::find($request->appointment_id))) {
            App::abort(404, 'Page not found.');
        }
        $followUp = new FollowUp();
        // Update the Appointment table according  to the followup
        switch ($request->action) {
            case 'Confirm' :
                $appointment->status = 4;
                $appointment->save();
                break;
            case 'Reschedule' :
                $appointment->status = 2;
                $appointment->save(); // save the updated status in pre appointment 
                unset($appointment->id); // Unset the id of first appointment
                unset($appointment->status); // Unset the status of first appointment
                $newAppointment = new Appointment(); //create a new object for new entry in appointment table
                $input = $appointment->toArray();
                $input['apptTime'] = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
                $newAppointment->fill($input)->save();
                break;
            case 'Cancel' :
                $appointment->status = 3;
                $appointment->save();
                break;
            case 'Later' :
                $followUp->followup_later_date = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
                break;
            case 'Never Treat' :
                if (!($patient = Patient::where('user_id', $appointment->patient_id)->get()->first())) {
                    App::abort(404, 'Page not found.'); // If pateint not found in the database
                }
                $patientInput['never_treat_status'] = 1;
                Patient::where('user_id', $appointment->patient_id)
                        ->update(['never_treat_status' => 1]);  // Save the never_treat_status in patient table

                $appointment->status = 5;
                $appointment->save();
                break;
            default :
                break;
        }
        // save the followup data in all conditions
        $followUp->action = $request->action;
        $followUp->appt_id = $request->appointment_id;
        $followUp->created_by = Auth::user()->id;
        $followUp->comment = $request->comment;
        $followUp->save();
        \Session::flash('flash_message', 'Follow Up of this appointment has been updated');
        return redirect()->back();
    }

    /**
     * Followup listing of the appointment  
     *
     * @return \resource\view\appointment\followp.blade.php
     */
    public function followup() {
        $followup = Followup::with(['appointment', 'appointment.patient' => function($query) {
                $query->select('id', 'first_name', 'last_name');
            }])->get();
        return view('appointment.followup', ['followup' => $followup]);
    }

    /**
     * View the followup for the appointment 
     * 
     * @param $id
     *
     * @return \resource\view\appointment\view_followup
     */
    public function viewFollowup($id = null) {
        $id = base64_decode($id);
        $followup = Followup::with(['appointment', 'appointment.patient' => function($query) {
                $query->select('id', 'first_name', 'last_name', 'email');
            }, 'appointment.patient.patientDetail'])->where('id', $id)->first();

        return view('appointment.view_followup', ['followup' => $followup]);
    }

    /**
     * Edit the patient for the filling the details for the medical 
     * 
     * @param $id
     *
     * @return \resource\view\appointment\patient_medical
     */
    public function patientMedical($id = null) {
        $id = base64_decode($id);
        if (!($patient = User::with('patientDetail')->find($id))) {
            App::abort(404, 'Page not found.');
        }
        $states = State::lists('name', 'id')->toArray();
        return view('appointment.patient_medical', [
            'patient' => $patient,
            'states' => $states
        ]);
    }

    /**
     * open the pop-up for the list of medicine when checked on radio button at pateint medical form
     *
     * @return \resource\view\appointment\medical\medicine_list
     */
    public function checkList(Request $request) {
        if (!empty($request['id'])) {
            $id = $request['id'];
            return view('appointment.medical.medicine_list', [
                'id' => $id
            ]);
            die;
        }
    }

}
