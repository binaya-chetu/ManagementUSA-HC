<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Appointment;
use App\AdamsQuestionaires;
use App\Doctor;
use App\User;
use App\FollowUp;
use App\State;
use App\FollowupStatus;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Config\Repository;
use Session;
use App;
use Auth;

class AppointmentController extends Controller
{

    protected $patient_role = 6;
    protected $doctor_role = 5;
    public $success = true;
    public $error = false;


    public function __construct(Request $request){ 		
		if(($request->segment(2) != 'patientMedical' || $request->segment(4) != 'hash') && $request->segment(2) != 'savePatientMedicalRecord'){ 
			$this->middleware('auth');
		}

    }

    /**
     * Show the application dashboard.
     *
     * @return \resource\view\appointment\newappointment.blade.php
     *  */
    public function index($id = null)
    {
        $patients = User::where('role', $this->patient_role)->get(['id', 'first_name', 'last_name']);

        $doctors = User::where('role', $this->doctor_role)->get(['id', 'first_name', 'last_name']);
        if (empty($id))
        {
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

    public function addPatAppointment(Request $request)
    {

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

    public function addappointment(Request $request)
    {
        $data = Input::all();
        $date = $data['appDate'];
        $time = $data['appTime'];
        $doctor_id = $request->doctor_id;

        $messages = [
            'after' => ':attribute cannot be a past date',
            'future_date' => 'Appointment cannot be set for past',
            'doctor_availability' => 'Sorry this time slot is not available',
            'clinic_off_hours' => 'Appoint can be selected only between ' . config("constants.CLINIC_OPEN_TIME") . ' and ' . config("constants.CLINIC_CLOSE_TIME")
        ];

        $validator = Validator::make($data, [
                    'appDate' => 'required|date|future_date:' . $time . '|doctor_availability:' . $time . ',' . $doctor_id . '|clinic_off_hours:' . $time . ',' . config("constants.CLINIC_OPEN_TIME") . ',' . config("constants.CLINIC_CLOSE_TIME"),
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

    public function show()
    {
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

    public function getdoctorschedule()
    {
        $doctor_id = Input::get('doctor_id');
        $collevent = $this->fetchDoctorSchedule($doctor_id);
        echo json_encode($collevent);
    }

    /*
     * Find the list of all appointment with Patient & Doctor details
     * 
     * @return \resource\view\appointment\listappointment.blade.php
     */

    public function listappointment()
    {

        $appointments = Appointment::with('patient', 'patient.reason', 'patient.reason.reasonCode')->orderBy('id', 'desc')->get();
        $patients = User::where('role', $this->patient_role)->get();
        $doctors = User::where('role', $this->doctor_role)->get();
        $followupStatus = FollowupStatus::select('id', 'title')->where('status', 1)->get();

        return view('appointment.listappointment', [
            'appointments' => $appointments, 'patients' => $patients, 'doctors' => $doctors, 'followupStatus' => $followupStatus
        ]);
    }

    /*
     * Find the Appointment details with patient & doctor
     * 
     * @return \resource\view\appointment\viewappointment.blade.php
     */
    public function viewappointment() {
        $appointments = Appointment::with('patient.patientDetail', 'patient.reason', 'patient.reason.reasonCode')->whereIn('status', [1, 4])->get();
        $collevent = array();
        $i = 0;
        foreach ($appointments as $appointment) {
            $events = array();
            $events ['id'] = $appointment->id;
            
            $reasonArr = $appointment->patient->reason->toArray();
            $reasonArray = array_column($reasonArr, 'reason_code');
            $reasonList = array_column($reasonArray, 'reason');
            $reason = implode(',', $reasonList);             
            $events ['title'] = $reason;
            $events ['patientName'] = 'Patient: ' . $appointment->patient->first_name . " " . $appointment->patient->last_name;
            $events ['mobile'] = 'Phone: ' . $appointment->patient->patientDetail->phone;
            $events ['start'] = $appointment->apptTime;
            $events ['end'] = date('Y-m-d H:i:s', strtotime($appointment->apptTime . '+ 30 minute'));
            $events ['color'] = '#0088cc';
            $collevent[$i] = $events;
            $i++;
        }
        
        $followupStatus = FollowupStatus::select('id', 'title')->where('status', 1)->get();
        $patients = User::where('role', $this->patient_role)->get();
        $doctors = User::where('role', $this->doctor_role)->get();
        return view('appointment.viewappointment', [
            'appointments' => $collevent, 'patients' => $patients, 'doctors' => $doctors, 'followupStatus' => $followupStatus
        ]);
    }

    /*
     * Find the Appointment details with patient & doctor
     * 
     * @param Illuminate\Http\Request
     * 
     * @return \Illuminate\Http\Response
     */

    public function editappointment(Request $request)
    {
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

    public function saveappointment(Request $request)
    {

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

    public function deleteappointment($id = null)
    {
        $id = base64_decode($id);
        if (Appointment::find($id)->delete()) {
            \Session::flash('flash_message', 'Appointment deleted successfully.');
            return redirect()->back();
        }
    }

    /**
     * Function for the checking the enter email is already exist or not
     *
     * @return \Illuminate\View\View
     */
    public function uniquePatientEmail()
    {
        $appointment = User::where('email', $_GET['email'])->count();
        if ($appointment) {
            echo json_encode($this->error);
        } else {
            echo json_encode($this->success);
        }
        die;
    }

    /**
     * Function for the saving the followup with the appointment
     *
     * @return \Illuminate\View\View
     */
    public function saveAppointmentFolloup(Request $request)
    {
        if (!($appointment = Appointment::find($request->appointment_id))) {
            App::abort(404, 'Page not found.');
        }
        $followUp = new FollowUp();
        // Update the Appointment table according  to the followup
        switch ($request->action) {
            case '4' :
                $appointment->status = $request->action;
                $appointment->save();
                break;
            case '2' :
                $appointment->status = $request->action;
                $appointment->save(); // save the updated status in pre appointment 
                unset($appointment->id); // Unset the id of first appointment
                unset($appointment->status); // Unset the status of first appointment
                $newAppointment = new Appointment(); //create a new object for new entry in appointment table
                $input = $appointment->toArray();
                $input['apptTime'] = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
                $newAppointment->fill($input)->save();
                break;
            case '3' :
                $appointment->status = $request->action;
                $appointment->save();
                break;
            case '1' :
                $followUp->followup_later_date = date('Y-m-d H:i:s', strtotime($request->appDate . " " . $request->appTime));
                $appointment->status = $request->action;
                $appointment->save();
                break;
            case '5' :
                if (!($patient = Patient::where('user_id', $appointment->patient_id)->get()->first())) {
                    App::abort(404, 'Page not found.'); // If pateint not found in the database
                }
                $patientInput['never_treat_status'] = 1;
                Patient::where('user_id', $appointment->patient_id)
                        ->update(['never_treat_status' => 1]);  // Save the never_treat_status in patient table

                $appointment->status = $request->action;
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
    public function followup()
    {
        $followup = FollowUp::with(['appointment', 'followupStatus', 'appointment.patient' => function($query) {
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
    public function viewFollowup($id = null)
    {
        $id = base64_decode($id);
        $followup = FollowUp::with(['appointment', 'followupStatus', 'appointment.patient' => function($query) {
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
    public function patientMedical($id = null, $hash = null) {

        $id = base64_decode($id);
        $hash = $hash;
        $patient = User::with('patientDetail')->find($id);
        //$disease_id = DB::table('appointments')->where('patient_id', $id)->orderBy('updated_at', 'DESC')->limit(1)->pluck('disease_id');
        //$disease_id = !empty($disease_id) ? $disease_id[0] : '';
        
        $disease_id = DB::table('appointment_reasons')->where('patient_id', $id)->orderBy('updated_at', 'DESC')->pluck('reason_id');        
        $diseases = DB::table('reason_codes')->where('type', 1)->pluck('reason', 'id');     
        $adamsQ = DB::table('adams_questionaires')->where('patient_id', $id)->first();
        $medHistories = DB::table('medical_histories')->where('patient_id', $id)->first();
        $erectileD = DB::table('erectile_dysfunctions')->where('patient_id', $id)->first();
        $weightL = DB::table('weight_loss')->where('patient_id', $id)->first();
        $priapus = DB::table('priapus')->where('patient_id', $id)->first();
        $testosterone = DB::table('high_testosterone')->where('patient_id', $id)->first();
        $vitamins = DB::table('vitamins')->where('patient_id', $id)->first();
        $cosmetics = DB::table('cosmetics')->where('patient_id', $id)->first();
        if (!$patient)
		{
            App::abort(404, 'Patient with given id was not found.');
        }

        $patient->base64Id = base64_encode($patient->id);
        if ($hash != null) {
            $patHash = $patient->toArray()['patient_detail']['hash'];
            if ($patHash != $hash) {
                App::abort(404, 'The url seeme to be expired or invalid.');
            }
        }
        $states = State::lists('name', 'id')->toArray();
        return view('appointment.patient_medical', [
            'patient' => $patient,
            'disease_id' => $disease_id,
            'diseases' => $diseases,
            'adamsQuestionaires' => $adamsQ,
            'medHistories' => $medHistories,
            'erectileD' => $erectileD,
            'weightL' => $weightL,
            'priapus' => $priapus,
            'testosterone' => $testosterone,
            'testosterone' => $testosterone,
            'cosmetics' => $cosmetics,
            'vitamins' => $vitamins,
            'states' => $states,
            'hash' => $hash
        ]);
    }

    /**
     * open the pop-up for the list of medicine when checked on radio button at pateint medical form
     *
     * @return \resource\view\appointment\medical\medicine_list
     */
    public function checkList(Request $request)
    {
        if (!empty($request['id'])) {

            $id = $request['id']; 
			if($id == 'vitamin_taken1' ){
				$patientId = $request['patientId'];
				$data = DB::table('patient_vitamin_list')->where('patient_id', $patientId)->get();
			} elseif($id == 'surgeries1' ){
				$patientId = $request['patientId'];
				$data = DB::table('surgery_list')->where('patient_id', $patientId)->get();
			} elseif($id == 'allergies1'){
				$patientId = $request['patientId'];
				$data = DB::table('allergies_list')->where('patient_id', $patientId)->get();				
			} elseif($id == 'illness1'){
				$patientId = $request['patientId'];
				$data = DB::table('illness_list')->where('patient_id', $patientId)->get();					
			} elseif($id == 'medication1'){
				$patientId = $request['patientId'];
				$data = DB::table('patient_medication_list')->where('patient_id', $patientId)->get();					
			}
			
            return view('appointment.medical.medicine_list', [
                'id' => $id,
				'data' => (isset($data) && !empty($data)) ? $data : ''
            ]);
            die;
        }
    }

    /*
     * Find the list of all appointment which appointment time are within 24 Hours.
     * 
     * @return \resource\view\apptsetting\listappointment.blade.php
     */

    public function upcomingappointments() {       

        $appointments = Appointment::with('patient', 'patient.reason', 'patient.reason.reasonCode')->whereDate('apptTime', '=', date('Y-m-d', strtotime("+1 day")))->get();
        $patients = User::where('role', $this->patient_role)->get();
        $doctors = User::where('role', $this->doctor_role)->get();
        $followupStatus = FollowupStatus::select('id', 'title')->where('status', 1)->get();
        
        return view('appointment.listappointment', [
            'appointments' => $appointments, 'patients' => $patients, 'doctors' => $doctors, 'followupStatus' => $followupStatus, 'type' => 'upcoming'
        ]);
    }

    /**
     * Save the patient medical form for different diseases
     * 
     * @param $id
     *
     * @return \resource\view\appointment\patient_medical
     */
    public function savePatientMedicalRecord($id, Request $response) {
		$formData = $response->all();
		$id = base64_decode($id);

		$user = App\User::firstOrCreate(['id' => $id]);
		$user->first_name		= $formData['first_name'];
		$user->middle_name		= $formData['middle_name'];
		$user->last_name		= $formData['last_name'];
		$user->email			= $formData['email'];
		$user->role				= $formData['gender'];		
		$user->save();

		$patient = App\Patient::firstOrCreate(['user_id' => $id]);
		
		if(Input::hasFile('driving_license')){
			$file = array('image' => Input::file('driving_license'));
			$rules = array('image' => 'mimes:jpeg,png,pdf',); //mimes:jpeg,bmp,png and for max size max:10000
			$validator = Validator::make($file, $rules);
			if ($validator->fails()) {
				\Session::flash('error_message', 'Please upload a valid driving license image (jpeg,png,pdf).');
				return redirect()->back();
				//return Redirect::to('upload')->withInput()->withErrors($validator);
			} else {
				if (Input::file('driving_license')->isValid()) {
					$destinationPath = 'uploads/driving_license'; // upload path
					$extension = Input::file('driving_license')->getClientOriginalExtension();
					$patient->driving_license = md5(uniqid(time(), true)).'.'.$extension; 
					Input::file('driving_license')->move($destinationPath, $patient->driving_license); 
				} else {
					\Session::flash('error_message', 'Please upload a valid driving license image (jpeg,png,pdf).');
					return redirect()->back();
				}
			}
		} 		
		
		$patient->dob			= date('Y/m/d', strtotime($formData['dob']));
		$patient->gender		= $formData['gender'];
		$patient->phone			= $formData['phone'];
		$patient->address1		= $formData['address1'];
		$patient->address2		= $formData['address2'];
		$patient->city			= $formData['city'];
		$patient->state			= $formData['state'];
		$patient->zipCode		= $formData['zipCode'];
		$patient->employer		= $formData['employer'];
		$patient->occupation	= $formData['occupation'];
		$patient->height		= $formData['height'];
		$patient->weight		= $formData['weight'];
		$patient->employment_place = $formData['employment_place'];
		$patient->primary_physician = $formData['primary_physician'];
		$patient->physician_phone = $formData['physician_phone'];
		$patient->employer			= $formData['employer'];
		$patient->call_time		= $formData['call_time'];
		$patient->mobile		= $formData['mobile'];
		//$patient->image			= $formData[''];
		$patient->marital_status = $formData['marital_status'];
		//$patient->payment_bill	= $formData[''];
		//$patient->never_treat_status = $formData[''];
		$patient->save();

		if(isset($formData['vitaminSuppliments']) && !empty($formData['vitaminSuppliments'])){
			$data = json_decode($formData['vitaminSuppliments']);
			$deletedCount = App\PatientVitaminList::where('patient_id', $id)->delete();
			foreach($data as $row){
				$vitaminList = new App\PatientVitaminList;
				$vitaminList->patient_id = $id;
				$vitaminList->name		 = $row->name;
				$vitaminList->dosage	 = $row->dosage;
				$vitaminList->how_often	 = $row->how_often;
				$vitaminList->taken_for	 = $row->condition;
				$vitaminList->save();
			}
		}

		if(isset($formData['medicationList']) && !empty($formData['medicationList'])){
			$data = json_decode($formData['medicationList']);
			$deletedCount = App\PatientMedicationList::where('patient_id', $id)->delete();
			foreach($data as $row){
				$medicationList = new App\PatientMedicationList;
				$medicationList->patient_id = $id;
				$medicationList->name		 = $row->name;
				$medicationList->dosage	 = $row->dosage;
				$medicationList->how_often	 = $row->how_often;
				$medicationList->taken_for	 = $row->condition;
				$medicationList->save();
			}
		}
		
		if(isset($formData['surgeryList']) && !empty($formData['surgeryList'])){
			$data = json_decode($formData['surgeryList']);
			$deletedCount = App\SurgeryList::where('patient_id', $id)->delete();
			foreach($data as $row){
				$surgeryList 				= new App\SurgeryList;
				$surgeryList->patient_id 	= $id;
				$surgeryList->type_of_surgery = $row->type_of_surgery;
				$surgeryList->date	= $row->surgery_date;
				$surgeryList->reason = $row->surgery_reason;
				$surgeryList->save();
			}
		}
		
		if(isset($formData['allergiesList']) && !empty($formData['allergiesList'])){
			$data = json_decode($formData['allergiesList']);
			$deletedCount = App\AllergiesList::where('patient_id', $id)->delete();
			foreach($data as $row){
				$allergiesList 				= new App\AllergiesList;
				$allergiesList->patient_id 	= $id;
				$allergiesList->allergic_medicine = $row->allergic_medicine;
				$allergiesList->save();
			}
		}

		if(isset($formData['illness']) && !empty($formData['illness'])){
			$data = json_decode($formData['illness']);
			$deletedCount = App\IllnessList::where('patient_id', $id)->delete();
			foreach($data as $row){
			 	$reason = new App\IllnessList;
				$reason->patient_id = $id;
				$reason->illness  = $row->illness;
				$reason->save();
			}
		} 
		
		if(isset($formData['disease_id']) && !empty($formData['disease_id'])){
			$data = json_decode($formData['disease_id']);
			$deletedCount = App\AppointmentReasons::where('patient_id', $id)->delete();
			foreach($data as $row){
				$reason = new App\AppointmentReasons;
				$reason->patient_id = $id;
				$reason->reason_id  = $row;
				$reason->save();
			}
		}
	
		$appt = App\Appointment::orderBy('id', 'DESC')->firstOrCreate(['patient_id' => $id]);
		///$appt->disease_id = $formData['disease_id'];
		$appt->save();
		
		$adamsQ = App\AdamsQuestionaires::firstOrCreate(['patient_id' => $id]);		
		$adamsQ->patient_id			= $id;
		$adamsQ->libido_rate		= $formData['libido_rate'];
		$adamsQ->energy_rate		= $formData['energy_rate'];
		$adamsQ->strength_rate		= $formData['strength_rate'];
		$adamsQ->enjoy_rate			= $formData['enjoy_rate'];
		$adamsQ->happiness_rate		= $formData['happiness_rate'];
		$adamsQ->erection_rate		= $formData['erection_rate'];
		$adamsQ->performance_rate	= $formData['performance_rate'];
		$adamsQ->sleep_rate			= $formData['sleep_rate'];
		$adamsQ->sport_rate			= $formData['sport_rate'];
		$adamsQ->lost_height_rate	= $formData['lost_height_rate'];
		$adamsQ->save();
		
		$medHistory = App\MedicalHistories::firstOrCreate(['patient_id' => $id]);	
		$medHistory->cardiovascular			= $formData['cardiovascular'];
		$medHistory->hypertension			= $formData['hypertension'];
		$medHistory->enocrine_disorder		= $formData['enocrine_disorder'];
		$medHistory->prostate				= $formData['prostate'];
		$medHistory->lipid					= $formData['lipid'];
		$medHistory->cancer_form			= $formData['cancer_form'];
		$medHistory->smoke_status			= $formData['smoke_status'];
		$medHistory->smoke_often			= $formData['smoke_often'];
		$medHistory->smoke_quantity			= $formData['smoke_quantity'];
		$medHistory->drink_status			= $formData['drink_status'];
		$medHistory->drink_often			= $formData['drink_often'];
		$medHistory->drink_quantity			= $formData['drink_quantity'];
		$medHistory->activity_level			= $formData['activity_level'];
		$medHistory->exercise_status		= $formData['exercise_status'];
		$medHistory->exercise_often			= $formData['exercise_often'];
		$medHistory->deficiency_status		= $formData['deficiency_status'];
		$medHistory->chemical_dependency	= $formData['chemical_dependency'];
		$medHistory->blood_disorder			= $formData['blood_disorder'];
		$medHistory->orthopedic_disorder	= $formData['orthopedic_disorder'];
		$medHistory->known_deficiency		= $formData['known_deficiency'];
		$medHistory->carpal_syndrome		= $formData['carpal_syndrome'];
		$medHistory->immune_disorder		= $formData['immune_disorder'];
		$medHistory->heart_disease			= $formData['heart_disease'];
		$medHistory->lung_disorder			= $formData['lung_disorder'];
		$medHistory->cancer_status			= $formData['cancer_status'];
		$medHistory->surgeries				= $formData['surgeries'];
		$medHistory->renal					= $formData['renal'];
		$medHistory->upper					= $formData['upper'];
		$medHistory->allergies				= $formData['allergies'];
		$medHistory->genital				= $formData['genital'];
		$medHistory->retention				= $formData['retention'];
		$medHistory->endocrine				= $formData['endocrine'];
		$medHistory->hyperlipidema			= $formData['hyperlipidema'];
		$medHistory->healing				= $formData['healing'];
		$medHistory->neurological			= $formData['neurological'];
		$medHistory->emotional				= $formData['emotional'];
		$medHistory->hypertention_hbp		= $formData['hypertention_hbp'];
		$medHistory->other_illness			= $formData['other_illness'];
		$medHistory->arthritis				= $formData['arthritis'];
		$medHistory->recreational_drug		= $formData['recreational_drug'];
		$medHistory->blood_test				= $formData['blood_test'];
		$medHistory->health_insurance		= $formData['health_insurance'];
		$medHistory->kind_of_hi				= $formData['kind_of_hi'];
		$medHistory->medication				= $formData['medication'];
		$medHistory->save();

		$erectileD = App\ErectileDysfunctions::firstOrCreate(['patient_id' => $id]);
		$erectileD->sex_status		= $formData['sex_status'];
		$erectileD->sex_often		= $formData['sex_often'];
		$erectileD->sex_with		= $formData['sex_with'];
		$erectileD->pronography		= $formData['pronography'];
		$erectileD->prostate_removal= $formData['prostate_removal'];
		$erectileD->nerve_damage	= $formData['nerve_damage'];
		$erectileD->erectile		= $formData['erectile'];
		$erectileD->implant			= $formData['implant'];
		$erectileD->penis_pump		= $formData['penis_pump'];
		$erectileD->recreational	= $formData['recreational'];
		$erectileD->ejaculate		= $formData['ejaculate'];
		$erectileD->medicine_used	= $formData['medicine_used'];
		$erectileD->sickle			= $formData['sickle'];
		$erectileD->dwarfing		= $formData['dwarfing'];
		$erectileD->hiv				= $formData['hiv'];
		$erectileD->sex_medicine	= $formData['sex_medicine'];
		$erectileD->medicine_name	= $formData['medicine_name'];
		$erectileD->medicine_work	= $formData['medicine_work'];
		$erectileD->last_used		= $formData['last_used'];
		$erectileD->still_work		= $formData['still_work'];
		$erectileD->side_effect		= $formData['side_effect'];
		$erectileD->erection_time	= $formData['erection_time'];
		$erectileD->erection_kind	= $formData['erection_kind'];
		$erectileD->erection_strength = $formData['erection_strength'];
		$erectileD->activity_score	= $formData['activity_score'];
		$erectileD->stimulation_score = $formData['stimulation_score'];
		$erectileD->intercourse_score = $formData['intercourse_score'];
		$erectileD->maintain_score	= $formData['maintain_score'];
		$erectileD->difficult_score = $formData['difficult_score'];
		$erectileD->save();
		
		$weightL = App\WeightLoss::firstOrCreate(['patient_id' => $id]);
		$weightL->weight_surgeries	= $formData['weight_surgeries'];
		$weightL->surgeries_kind	= $formData['surgeries_kind'];
		$weightL->weight_supplement	= $formData['weight_supplement'];
		$weightL->supplement_type	= $formData['supplement_type'];
		$weightL->liver_disease		= $formData['liver_disease'];
		$weightL->diabetes			= $formData['diabetes'];
		$weightL->thyroid_treated	= $formData['thyroid_treated'];
		$weightL->hormone_treated	= $formData['hormone_treated'];
		$weightL->seizures			= $formData['seizures'];
		$weightL->kidney_disorder	= $formData['kidney_disorder'];
		$weightL->eating_disorder	= $formData['eating_disorder'];
		$weightL->frequently_eat	= $formData['frequently_eat'];
		$weightL->eat_more			= $formData['eat_more'];
		$weightL->save();

 		$priapus  = App\Priapus::firstOrCreate(['patient_id' => $id]);
		$priapus->abnormal				= $formData['abnormal'];
		$priapus->abnormal_type			= $formData['abnormal_type'];
		$priapus->priapus_goal			= $formData['priapus_goal'];
		$priapus->prp_before			= $formData['prp_before'];
		$priapus->pump_past				= $formData['pump_past'];
		$priapus->implant_surgery		= $formData['implant_surgery'];
		$priapus->pre_activity_score	= $formData['pre_activity_score'];
		$priapus->prp_stimulation_score = $formData['prp_stimulation_score'];
		$priapus->prp_intercourse_score = $formData['prp_intercourse_score'];
		$priapus->prp_maintain_score	= $formData['prp_maintain_score'];
		$priapus->prp_difficult_score	= $formData['prp_difficult_score'];
		$priapus->save();	 

 		$testosterone = App\HighTestosterone::firstOrCreate(['patient_id' => $id]);
		$testosterone->harmone_therapy		= $formData['harmone_therapy'];
		$testosterone->harmone_therapy_type = $formData['harmone_therapy_type'];
		$testosterone->usa_military			= $formData['usa_military'];
		$testosterone->lack_increment		= isset($formData['lack_increment'])? 1: '';
		$testosterone->increase_fat			= isset($formData['increase_fat'])? 1: '';
		$testosterone->depression			= isset($formData['depression'])? 1: '';
		$testosterone->mood_increment		= isset($formData['mood_increment'])? 1: '';
		$testosterone->sleep_difficulty		= isset($formData['sleep_difficulty'])? 1: '';
		$testosterone->wrinkle_increment	= isset($formData['wrinkle_increment'])? 1: '';
		$testosterone->sagging_increment	= isset($formData['sagging_increment'])? 1: '';
		$testosterone->hot_flash			= isset($formData['hot_flash'])? 1: '';
		$testosterone->loss_activity		= isset($formData['loss_activity'])? 1: '';
		$testosterone->stess_increment		= isset($formData['stess_increment'])? 1: '';
		$testosterone->loss_interest		= isset($formData['loss_interest'])? 1: '';
		$testosterone->loose_skin			= isset($formData['loose_skin'])? 1: '';
		$testosterone->exercise_ability		= isset($formData['exercise_ability'])? 1: '';
		$testosterone->memory_decrement		= isset($formData['memory_decrement'])? 1: '';
		$testosterone->loss_muscle			= isset($formData['loss_muscle'])? 1: '';
		$testosterone->endurance			= isset($formData['endurance'])? 1: '';
		$testosterone->muscle_decrement		= isset($formData['muscle_decrement'])? 1: '';
		$testosterone->loss_hair			= isset($formData['loss_hair'])? 1: '';
		$testosterone->sense_decrement		= isset($formData['sense_decrement'])? 1: '';
		$testosterone->testicle_decrement	= isset($formData['testicle_decrement'])? 1: '';
		$testosterone->shrinkage			= isset($formData['shrinkage'])? 1: '';
		$testosterone->osteoporosis			= isset($formData['osteoporosis'])? 1: '';
		$testosterone->intolerance			= isset($formData['intolerance'])? 1: '';
		$testosterone->unexplained_weight	= isset($formData['unexplained_weight'])? 1: '';
		$testosterone->save();	 
		
 		$vitamins = App\Vitamins::firstOrCreate(['patient_id' => $id]);
		$vitamins->needle_afraid		=  isset($formData['needle_afraid'])? $formData['needle_afraid'] : '';
		$vitamins->afraid_limit			= $formData['afraid_limit'];
		$vitamins->injectable_type		= $formData['injectable_type'];
		$vitamins->total_wellness		= $formData['total_wellness'];
		$vitamins->weight_supplement	= $formData['weight_supplement'];
		$vitamins->vitamin_knowledge	= $formData['vitamin_knowledge'];
		$vitamins->vitamin_taken		= $formData['vitamin_taken'];
		$vitamins->wellness_tested		= $formData['wellness_tested'];
		$vitamins->vitamin_drip			= $formData['vitamin_drip'];	
		$vitamins->save();
		
 		$cosmetics = App\Cosmetics::firstOrCreate(['patient_id' => $id]);
		$cosmetics->facial_surgeries = $formData['facial_surgeries'];
		$cosmetics->facial_kind		= $formData['facial_kind'];
		$cosmetics->face_wash		= $formData['face_wash'];
		$cosmetics->exposure		= $formData['exposure'];
		$cosmetics->skin_look		= $formData['skin_look'];
		$cosmetics->look_score		= $formData['look_score'];
		$cosmetics->happy_score		= $formData['happy_score'];
		$cosmetics->crowsfeet		= $formData['crowsfeet'];
		$cosmetics->facial_expression = $formData['facial_expression'];
		$cosmetics->sunken			= $formData['sunken'];
		$cosmetics->bullfrog_looking = $formData['bullfrog_looking'];
		$cosmetics->loose_skin		= $formData['loose_skin'];
		$cosmetics->thin_lip		= $formData['thin_lip'];
		$cosmetics->face_spot		= $formData['face_spot'];
		$cosmetics->acne			= $formData['acne'];
		$cosmetics->skin_tag		= $formData['skin_tag'];	
		$cosmetics->save();	 
		
		$patientHash = DB::table('patient_details')->where('user_id', $id)->pluck('hash')[0];
        \Session::flash('flash_message', 'Patient details saved successfully');		
		if(Auth::check()){
			return redirect('/appointment/listappointment');	
		} elseif(!empty($formData['hash']) && $formData['hash'] == $patientHash){
			$hash = md5(uniqid($id, true));
			App\Patient::where('user_id', $id)->update(['hash' => $hash]);
			return redirect('/common/messages');
		} else{
			App::abort(404, '');
		}
	
       //echo '<pre>'; print_r($response->all());die;
/* 		foreach($response->all() as $i => $v){
			echo $i.'<br>';
		} */

        $patient->dob = date('Y/m/d', strtotime($formData['dob']));
        $patient->gender = $formData['gender'];
        $patient->phone = $formData['phone'];
        $patient->address1 = $formData['address1'];
        $patient->address2 = $formData['address2'];
        $patient->city = $formData['city'];
        $patient->state = $formData['state'];
        $patient->zipCode = $formData['zipCode'];
        $patient->employer = $formData['employer'];
        $patient->occupation = $formData['occupation'];
        $patient->height = $formData['height'];
        $patient->weight = $formData['weight'];
        $patient->employment_place = $formData['employment_place'];
        $patient->primary_physician = $formData['primary_physician'];
        $patient->physician_phone = $formData['physician_phone'];
        $patient->employer = $formData['employer'];
        $patient->call_time = $formData['call_time'];
        $patient->mobile = $formData['mobile'];
        //$patient->image			= $formData[''];
        $patient->marital_status = $formData['marital_status'];
        //$patient->payment_bill	= $formData[''];
        //$patient->never_treat_status = $formData[''];
        $patient->save();

        $appt = App\Appointment::orderBy('id', 'DESC')->firstOrCreate(['patient_id' => $id]);
        $appt->disease_id = $formData['disease_id'];
        $appt->save();

        $adamsQ = App\AdamsQuestionaires::firstOrCreate(['patient_id' => $id]);
        $adamsQ->patient_id = $id;
        $adamsQ->libido_rate = $formData['libido_rate'];
        $adamsQ->energy_rate = $formData['energy_rate'];
        $adamsQ->strength_rate = $formData['strength_rate'];
        $adamsQ->enjoy_rate = $formData['enjoy_rate'];
        $adamsQ->happiness_rate = $formData['happiness_rate'];
        $adamsQ->erection_rate = $formData['erection_rate'];
        $adamsQ->performance_rate = $formData['performance_rate'];
        $adamsQ->sleep_rate = $formData['sleep_rate'];
        $adamsQ->sport_rate = $formData['sport_rate'];
        $adamsQ->lost_height_rate = $formData['lost_height_rate'];
        $adamsQ->save();

        $medHistory = App\MedicalHistories::firstOrCreate(['patient_id' => $id]);
        $medHistory->cardiovascular = $formData['cardiovascular'];
        $medHistory->hypertension = $formData['hypertension'];
        $medHistory->enocrine_disorder = $formData['enocrine_disorder'];
        $medHistory->prostate = $formData['prostate'];
        $medHistory->lipid = $formData['lipid'];
        $medHistory->cancer_form = $formData['cancer_form'];
        $medHistory->smoke_status = $formData['smoke_status'];
        $medHistory->smoke_often = $formData['smoke_often'];
        $medHistory->smoke_quantity = $formData['smoke_quantity'];
        $medHistory->drink_status = $formData['drink_status'];
        $medHistory->drink_often = $formData['drink_often'];
        $medHistory->drink_quantity = $formData['drink_quantity'];
        $medHistory->activity_level = $formData['activity_level'];
        $medHistory->exercise_status = $formData['exercise_status'];
        $medHistory->exercise_often = $formData['exercise_often'];
        $medHistory->deficiency_status = $formData['deficiency_status'];
        $medHistory->chemical_dependency = $formData['chemical_dependency'];
        $medHistory->blood_disorder = $formData['blood_disorder'];
        $medHistory->orthopedic_disorder = $formData['orthopedic_disorder'];
        $medHistory->known_deficiency = $formData['known_deficiency'];
        $medHistory->carpal_syndrome = $formData['carpal_syndrome'];
        $medHistory->immune_disorder = $formData['immune_disorder'];
        $medHistory->heart_disease = $formData['heart_disease'];
        $medHistory->lung_disorder = $formData['lung_disorder'];
        $medHistory->cancer_status = $formData['cancer_status'];
        $medHistory->surgeries = $formData['surgeries'];
        $medHistory->renal = $formData['renal'];
        $medHistory->upper = $formData['upper'];
        $medHistory->allergies = $formData['allergies'];
        $medHistory->genital = $formData['genital'];
        $medHistory->retention = $formData['retention'];
        $medHistory->endocrine = $formData['endocrine'];
        $medHistory->hyperlipidema = $formData['hyperlipidema'];
        $medHistory->healing = $formData['healing'];
        $medHistory->neurological = $formData['neurological'];
        $medHistory->emotional = $formData['emotional'];
        $medHistory->hypertention_hbp = $formData['hypertention_hbp'];
        $medHistory->other_illness = $formData['other_illness'];
        $medHistory->arthritis = $formData['arthritis'];
        $medHistory->recreational_drug = $formData['recreational_drug'];
        $medHistory->blood_test = $formData['blood_test'];
        $medHistory->health_insurance = $formData['health_insurance'];
        $medHistory->kind_of_hi = $formData['kind_of_hi'];
        $medHistory->medication = $formData['medication'];
        $medHistory->save();

        $erectileD = App\ErectileDysfunctions::firstOrCreate(['patient_id' => $id]);
        $erectileD->sex_status = $formData['sex_status'];
        $erectileD->sex_often = $formData['sex_often'];
        $erectileD->sex_with = $formData['sex_with'];
        $erectileD->pronography = $formData['pronography'];
        $erectileD->prostate_removal = $formData['prostate_removal'];
        $erectileD->nerve_damage = $formData['nerve_damage'];
        $erectileD->erectile = $formData['erectile'];
        $erectileD->implant = $formData['implant'];
        $erectileD->penis_pump = $formData['penis_pump'];
        $erectileD->recreational = $formData['recreational'];
        $erectileD->ejaculate = $formData['ejaculate'];
        $erectileD->medicine_used = $formData['medicine_used'];
        $erectileD->sickle = $formData['sickle'];
        $erectileD->dwarfing = $formData['dwarfing'];
        $erectileD->hiv = $formData['hiv'];
        $erectileD->sex_medicine = $formData['sex_medicine'];
        $erectileD->medicine_name = $formData['medicine_name'];
        $erectileD->medicine_work = $formData['medicine_work'];
        $erectileD->last_used = $formData['last_used'];
        $erectileD->still_work = $formData['still_work'];
        $erectileD->side_effect = $formData['side_effect'];
        $erectileD->erection_time = $formData['erection_time'];
        $erectileD->erection_kind = $formData['erection_kind'];
        $erectileD->erection_strength = $formData['erection_strength'];
        $erectileD->activity_score = $formData['activity_score'];
        $erectileD->stimulation_score = $formData['stimulation_score'];
        $erectileD->intercourse_score = $formData['intercourse_score'];
        $erectileD->maintain_score = $formData['maintain_score'];
        $erectileD->difficult_score = $formData['difficult_score'];
        $erectileD->save();

        $weightL = App\WeightLoss::firstOrCreate(['patient_id' => $id]);
        $weightL->weight_surgeries = $formData['weight_surgeries'];
        $weightL->surgeries_kind = $formData['surgeries_kind'];
        $weightL->weight_supplement = $formData['weight_supplement'];
        $weightL->supplement_type = $formData['supplement_type'];
        $weightL->liver_disease = $formData['liver_disease'];
        $weightL->diabetes = $formData['diabetes'];
        $weightL->thyroid_treated = $formData['thyroid_treated'];
        $weightL->hormone_treated = $formData['hormone_treated'];
        $weightL->seizures = $formData['seizures'];
        $weightL->kidney_disorder = $formData['kidney_disorder'];
        $weightL->eating_disorder = $formData['eating_disorder'];
        $weightL->frequently_eat = $formData['frequently_eat'];
        $weightL->eat_more = $formData['eat_more'];
        $weightL->save();

        $priapus = App\Priapus::firstOrCreate(['patient_id' => $id]);
        $priapus->abnormal = $formData['abnormal'];
        $priapus->abnormal_type = $formData['abnormal_type'];
        $priapus->priapus_goal = $formData['priapus_goal'];
        $priapus->prp_before = $formData['prp_before'];
        $priapus->pump_past = $formData['pump_past'];
        $priapus->implant_surgery = $formData['implant_surgery'];
        $priapus->pre_activity_score = $formData['pre_activity_score'];
        $priapus->prp_stimulation_score = $formData['prp_stimulation_score'];
        $priapus->prp_intercourse_score = $formData['prp_intercourse_score'];
        $priapus->prp_maintain_score = $formData['prp_maintain_score'];
        $priapus->prp_difficult_score = $formData['prp_difficult_score'];
        $priapus->save();

        $testosterone = App\HighTestosterone::firstOrCreate(['patient_id' => $id]);
        $testosterone->harmone_therapy = $formData['harmone_therapy'];
        $testosterone->harmone_therapy_type = $formData['harmone_therapy_type'];
        $testosterone->usa_military = $formData['usa_military'];
        $testosterone->lack_increment = isset($formData['lack_increment']) ? 1 : '';
        $testosterone->increase_fat = isset($formData['increase_fat']) ? 1 : '';
        $testosterone->depression = isset($formData['depression']) ? 1 : '';
        $testosterone->mood_increment = isset($formData['mood_increment']) ? 1 : '';
        $testosterone->sleep_difficulty = isset($formData['sleep_difficulty']) ? 1 : '';
        $testosterone->wrinkle_increment = isset($formData['wrinkle_increment']) ? 1 : '';
        $testosterone->sagging_increment = isset($formData['sagging_increment']) ? 1 : '';
        $testosterone->hot_flash = isset($formData['hot_flash']) ? 1 : '';
        $testosterone->loss_activity = isset($formData['loss_activity']) ? 1 : '';
        $testosterone->stess_increment = isset($formData['stess_increment']) ? 1 : '';
        $testosterone->loss_interest = isset($formData['loss_interest']) ? 1 : '';
        $testosterone->loose_skin = isset($formData['loose_skin']) ? 1 : '';
        $testosterone->exercise_ability = isset($formData['exercise_ability']) ? 1 : '';
        $testosterone->memory_decrement = isset($formData['memory_decrement']) ? 1 : '';
        $testosterone->loss_muscle = isset($formData['loss_muscle']) ? 1 : '';
        $testosterone->endurance = isset($formData['endurance']) ? 1 : '';
        $testosterone->muscle_decrement = isset($formData['muscle_decrement']) ? 1 : '';
        $testosterone->loss_hair = isset($formData['loss_hair']) ? 1 : '';
        $testosterone->sense_decrement = isset($formData['sense_decrement']) ? 1 : '';
        $testosterone->testicle_decrement = isset($formData['testicle_decrement']) ? 1 : '';
        $testosterone->shrinkage = isset($formData['shrinkage']) ? 1 : '';
        $testosterone->osteoporosis = isset($formData['osteoporosis']) ? 1 : '';
        $testosterone->intolerance = isset($formData['intolerance']) ? 1 : '';
        $testosterone->unexplained_weight = isset($formData['unexplained_weight']) ? 1 : '';
        $testosterone->save();

        $vitamins = App\Vitamins::firstOrCreate(['patient_id' => $id]);
        $vitamins->needle_afraid = isset($formData['needle_afraid']) ? $formData['needle_afraid'] : '';
        $vitamins->afraid_limit = $formData['afraid_limit'];
        $vitamins->injectable_type = $formData['injectable_type'];
        $vitamins->total_wellness = $formData['total_wellness'];
        $vitamins->weight_supplement = $formData['weight_supplement'];
        $vitamins->vitamin_knowledge = $formData['vitamin_knowledge'];
        $vitamins->vitamin_taken = $formData['vitamin_taken'];
        $vitamins->wellness_tested = $formData['wellness_tested'];
        $vitamins->vitamin_drip = $formData['vitamin_drip'];
        $vitamins->save();

        $cosmetics = App\Cosmetics::firstOrCreate(['patient_id' => $id]);
        $cosmetics->facial_surgeries = $formData['facial_surgeries'];
        $cosmetics->facial_kind = $formData['facial_kind'];
        $cosmetics->face_wash = $formData['face_wash'];
        $cosmetics->exposure = $formData['exposure'];
        $cosmetics->skin_look = $formData['skin_look'];
        $cosmetics->look_score = $formData['look_score'];
        $cosmetics->happy_score = $formData['happy_score'];
        $cosmetics->crowsfeet = $formData['crowsfeet'];
        $cosmetics->facial_expression = $formData['facial_expression'];
        $cosmetics->sunken = $formData['sunken'];
        $cosmetics->bullfrog_looking = $formData['bullfrog_looking'];
        $cosmetics->loose_skin = $formData['loose_skin'];
        $cosmetics->thin_lip = $formData['thin_lip'];
        $cosmetics->face_spot = $formData['face_spot'];
        $cosmetics->acne = $formData['acne'];
        $cosmetics->skin_tag = $formData['skin_tag'];
        $cosmetics->save();

        $patientHash = DB::table('patient_details')->where('user_id', $id)->pluck('hash')[0];
        \Session::flash('flash_message', 'Patient details saved successfully');
        if (Auth::check()) {
            return redirect('/appointment/listappointment');
        } elseif (!empty($formData['hash']) && $formData['hash'] == $patientHash) {
            $hash = md5(uniqid($id, true));
            App\Patient::where('user_id', $id)->update(['hash' => $hash]);
            return redirect('/common/messages');
        } else {
            App::abort(404, '');
        }

        //echo '<pre>'; print_r($response->all());die;
        /* 		foreach($response->all() as $i => $v){
          echo $i.'<br>';
          } */
    }

    /*
     * Find the list of all appointment which appointment time are within 24 Hours.
     * 
     * @return \resource\view\apptsetting\listappointment.blade.php
     */

    public function todayVisits() {
        $appointments = Appointment::with('patient', 'patient.reason', 'patient.reason.reasonCode')->where('status', '4')->whereDate('apptTime', '=', date('Y-m-d'))->get() ;
         //print_r(Session::all());die;
        $patients = User::where('role', $this->patient_role)->get();
        // $doctors = User::where('role', $this->doctor_role)->get();

        return view('appointment.today_visits', [
            'appointments' => $appointments, 'patients' => $patients
        ]);
    }

    /**
     * Function for the saving the patient status in the appointment
     *
     * @return \resource\view\Appointment\today_visits.blade.php
     */
    public function savePatientStatus(Request $request) {

        $values = ['patient_status' => $request->patient_status];
        Appointment::where('id', $request->appointment_id)->update($values);
        //echo '<pre>';print_r($request->all());die;
        \Session::flash('flash_message', 'Patient Status updated successfully');
        return redirect()->back();
    }

    /**
     * Function for the showing the result for the LaB Appointment
     *
     * @return \resource\view\Appointment\today_visits.blade.php
     */
    public function labAppointments() {        
        $appointments = Appointment::with('patient', 'patient.reason', 'patient.reason.reasonCode')->where('patient_status', '2')->get();
        $patients = User::where('role', $this->patient_role)->get();

        return view('appointment.lab_appointments', [
            'appointments' => $appointments, 'patients' => $patients
        ]);
    }
        /*
     * Find the counting for the Appointmennts
     * 
     * @return \Illuminate\Http\Response
     */
    public function countAppointments() {        
        $appointment = array();
        
        \Session::forget('CountLabAppointment');
        $labAppointment = Appointment::whereIn('patient_status', [2, 3])->count();      
        \Session::put('CountLabAppointment', $labAppointment);
        $appointment['lab_appointment'] = $labAppointment;        
        echo json_encode($appointment);                
        die;
    }
    
        /**
     * Function for the showing the result for the LaB Appointment
     *
     * @return \resource\view\Appointment\today_visits.blade.php
     */
    public function labReadyAppointments() {        
        $appointments = Appointment::with('patient', 'patient.patientDetail', 'patient.reason', 'patient.reason.reasonCode')->where('patient_status', '4')->get();
        //echo '<pre>'; print_r($appointments->toArray());die;
        $patients = User::where('role', $this->patient_role)->get();

        return view('appointment.lab_ready_appointments', [
            'appointments' => $appointments, 'patients' => $patients
        ]);
    }

}
