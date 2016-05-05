<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\Doctor;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null) {
            
        $patient = new Patient;
        $patients = $patient->get();

        $doctor = new Doctor;
        $doctors = $doctor->get();
        return view('appointment.appointment', [
            'patients' => $patients, 'doctors' => $doctors,'appointments'=>array()
        ]);
    }

    public function addPatAppointment(Request $request) {
         //$patient  = new Patient;
        $appointment = new Appointment;
        $appointment->apptTime = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
        $appointment->status = $request->status;
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

        $this->validate($request, [
            'appDate' => 'required',
            'comment' => 'required',
        ]);
        
        if ($this->addPatAppointment($request))
        {
            return Redirect::action('AppointmentController@listappointment');
        }

      
    }

    public function show() {
        $appointment = new Appointment;
        $appointments = $appointment->get();

        return view('appointment.viewappointment', [
            'appointments' => $appointments
        ]);
       
    }

    public function listappointment() {
        $appointment = new Appointment;
        $appointments = $appointment->get();

        $patient = new Patient;
        $patients = $patient->get();

        $doctor = new Doctor;
        $doctors = $doctor->get();

        return view('appointment.listappointment', [
            'appointments' => $appointments, 'patients' => $patients, 'doctors' => $doctors
        ]);
        //return view('home');
    }

    public function viewappointment() {
        $appointment = new Appointment;

        $appointments = $appointment->get();
        $collevent = array();
        $i = 0;
        foreach ($appointments as $appointment) {
            $events = array();
            $events ['title'] = 'Appointment#' . $appointment->id;
            $events ['start'] = $appointment->apptTime;
            $collevent[$i] = $events;
            $i++;
        }

        $patient = new Patient;
        $patients = $patient->get();

        $doctor = new Doctor;
        $doctors = $doctor->get();
        return view('appointment.viewappointment', [
            'appointments' => $collevent, 'patients' => $patients, 'doctors' => $doctors
        ]);
    }

    public function editappointment() {
        $appointment = Appointment::find($_REQUEST['id']);
        $patient = Appointment::find($_REQUEST['id'])->patient;
        $doctor = Appointment::find($_REQUEST['id'])->doctor;
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
        $appointment->status = $request->status;
        $appointment->createdBy = $request->createdBy;
        $appointment->lastUpdatedBy = $request->lastUpdatedBy;
        $appointment->patient_id = $request->patient_id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->marketer = $request->marketer;
        $appointment->clinic = $request->clinic;
        $appointment->comment = $request->comment;
        
        
        $patient = Patient::find($request->patient_id);
        $patient->firstName = $request->firstName;
        $patient->lastName = $request->lastName;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->dob = date('Y-m-d H:i:s', strtotime($request->dob));
        $patient->firstName = $request->firstName;
        $patient->address1 = $request->address1;
        if($patient->save())
        {
           $appointment->save();
        }
        

    }

    public function deleteappointment() {
        Appointment::find($_REQUEST['id'])->delete();
        
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
        if ($patient_id)
        {
            $this->addPatAppointment($request);
             \Session::flash('flash_message','Office successfully added.');
            return "Success";
        }
        else {
            return "Error";
        }
        //
        die;
    }
    
    public function uniquePatientEmail()
    {
       $patient = new Patient;
       $appointment = $patient->where('email', $_REQUEST['email'])->count();
       if($appointment)
       {
           return "Found";
       }
       else
       {
           return "Not Found";
       }
            
    }

}
