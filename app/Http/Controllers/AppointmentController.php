<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\Doctor;
use App\User;
use App\Followup;
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
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
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

    public function addappointment(Request $request) {
        $data = Input::all();
        $date = $data['appDate'];
        $time = $data['appTime'];
        $doctor_id = $request->doctor_id;

        $messages = [
            'after' => ':attribute cannot be a past date',
            'future_date' => 'Appointment cannot be set for past',
            'patient_id.required' => 'Please select patient or add new patient',
            'doctor_availability' => 'Sorry this time slot is not available'
        ];

        $validator = Validator::make($data, [
                    'patient_id' => 'required',
                    'appDate' => 'required|date|future_date:' . $time . '|doctor_availability:' . $time . ',' . $doctor_id,
                    'comment' => 'required',
                        ], $messages);

        if ($validator->fails()) { 
            return Redirect::to('/appointment/newAppointment')->withInput()->withErrors($validator->errors());
        }

        if (empty($request->patient_id)) {
            $controller = new PatientController();
            if (!($request->patient_id = $controller->savePatientDetail($request))) {
                \Session::flash('flash_message', 'some occur occcured in patient detail.');
                return Redirect::action('AppointmentController@newAppointment');
            }
        }
        if ($this->addPatAppointment($request)) {
            \Session::flash('flash_message', 'Appointment added successfully.');
            return Redirect::action('AppointmentController@viewappointment');
        }
    }

    public function show() {
        $appointment = new Appointment;
        $appointments = $appointment->get();

        return view('appointment.viewappointment', [
            'appointments' => $appointments
        ]);
    }

    public function getdoctorschedule() {
        $doctor_id = Input::get('doctor_id');
        $collevent = $this->fetchDoctorSchedule($doctor_id);
        echo json_encode($collevent);
    }

    public function listappointment() {
       
        $appointments = Appointment::with('patient')->get();  
        $patients = User::where('role', $this->patient_role)->get();
        $doctors = User::where('role', $this->doctor_role)->get();
        
        return view('appointment.listappointment', [
            'appointments' => $appointments, 'patients' => $patients, 'doctors' => $doctors
        ]);
        
    }

    public function viewappointment() {
        $appointment = new Appointment;
        $appointments = $appointment->whereIn('status', [1, 4])->get();
        $collevent = array();
        $i = 0;
        foreach ($appointments as $appointment) {
            $events = array();
            $events ['id'] = $appointment->id;
            $events ['title'] = 'Appointment#' . $appointment->id;
            $events ['patientName'] = 'Patient:' . $appointment->patient->first_name . " " . $appointment->patient->last_name;
            $events ['mobile'] = 'Phone:' . $appointment->patient->phone;
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
       
        if($request->dob)
        {
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

    public function deleteappointment($id = null) {
        $id = base64_decode($id);
        if (Appointment::find($id)->delete()) {
            \Session::flash('flash_message', 'Appointment deleted successfully.');
            return redirect()->back();
        }
    }

    /*
     * Submit Patient and Appointment Date in Single Call.
     */

    public function editpatientappointment(Request $request) {
        $request->merge(array('patient_id' => 12));
        $request->merge(array('address2' => 'Lorren Epsum'));
        $request->merge(array('city' => 'Lorren Epsum'));
        $request->merge(array('state' => 'Lorren Epsum'));
        $request->merge(array('zipCode' => 000));
        $request->merge(array('occupation' => 000));
        $controller = new PatientController();
        $patient_id = $controller->savePatientDetail($request);
        $request->merge(array('patient_id' => $patient_id));
        if ($patient_id) {
            $this->addPatAppointment($request);
            \Session::flash('flash_message', 'Appointment added successfully.');
            ;
            return "Success";
        } else {
            return "Error";
        }
        die;
    }

    public function uniquePatientEmail() {
        
        $appointment = User::where('email', $_GET['email'])->count();
        if ($appointment) {
            echo 'false';
            die;
        } else {
            echo 'true';
            die;
        }
    }

    // Function for the saving the followup with the appointment 
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

    // Function for the listing of the Followup
    public function followup() {
        $followup = Followup::with(['appointment', 'appointment.patient' => function($query) {
                $query->select('id', 'first_name', 'last_name');
            }])->get();
        return view('appointment.followup', ['followup' => $followup]);
    }

    // Function to view the particular appointment followup
    public function viewFollowup($id = null) {
        $id = base64_decode($id);
        $followup = Followup::with(['appointment', 'appointment.patient' => function($query) {
                $query->select('id', 'first_name', 'last_name', 'email');
            }, 'appointment.patient.patientDetail'])->where('id', $id)->first();
        
        return view('appointment.view_followup', ['followup' => $followup]);
    }

}
