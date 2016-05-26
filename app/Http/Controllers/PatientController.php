<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Patient;
use App\User;
use App\Role;
use App\State;
use View;
use App;

//use Validator;

class PatientController extends Controller {

     protected $role = 6;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function addPatient()
    {
         $states = State::get();
        
        $stateArray = array();
       
        foreach($states as $state)
        {
            $stateArray[$state->id] = $state->name;
        }
        
        return view('patient.addPatient', ['states' => $stateArray]);
    }
    
    public function index($id = null) {
        if ($id == null) {
            $patients = User::with('patientDetail', 'PatientDetail.patientStateName')->where('role', $this->role)->get();
           
            return view('patient.patients', ['patients' => $patients]);
        } else {
            $patient = Patient::find($id);
            return view('patient.patient', ['patient' => $patient]);
        }
    }

    public function save(Request $request) {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15'
        ]);
        
        $userData = new User;
        $userData->first_name = $request->first_name;
        $userData->last_name = $request->last_name;
        $userData->email = $request->email;
        $userData->role = $this->role;
        
        if ($userData->save()) 
        {
            $userId = $userData->id;
            $saveResult = $this->savePatientDetail($request, $userId);
            if ($saveResult != 0) {
                \Session::flash('flash_message', 'Patient added successfully.');
                return redirect('/patient');
            } else {
                return redirect('/patient/addPatient');
            }
        }
        else
        {
             return redirect('/patient/addPatient');
        }
    }
    
     public function saveAppointmentPatient(Request $request) {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
        ]);
        
        $userData = new User;
        $userData->first_name = $request->first_name;
        $userData->last_name = $request->last_name;
        $userData->email = $request->email;
        $userData->role = $this->role;
        //print_r($userData);die;
        if ($userData->save()) 
        {
            $userId = $userData->id;
            $saveResult = $this->savePatientDetail($request, $userId);
            if ($saveResult != 0) {
               return $userId;
            } else {
                return 0;
            }
        }
        else
        {
             return 0;
        }
    }

    public function edit($id = null) {
        if (!($patient = User::with('patientDetail')->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        
        $states = State::get();
        
        $stateArray = array();
       
        foreach($states as $state)
        {
            $stateArray[$state->id] = $state->name;
        }
        
         return view('patient.editPatient', [
            'patient' => $patient,
            'states' => $stateArray
        ]);
       
    }

    public function delete($id = null) {
        if (!($user = User::find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        User::destroy(base64_decode($id));
        \Session::flash('flash_message', 'Data deleted successfully.');
        return Redirect::back();
    }

    public function updatePatient($id = null, Request $request) {
        
        if (!($userData = User::find($id))) {
            App::abort(404, 'Page not found.');
        }
      
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15',
            'payment_bill' => 'mimes:jpg,png,jpeg,doc,docx,pdf,csv,xls'
        ]);
       
        $userInput['first_name'] = $request->first_name;
        $userInput['last_name'] = $request->last_name;
        
        $patientData = Patient::where('user_id',$id)->get();
        
        $file = $request->file('payment_bill');
        $oldImagePath = public_path('uploads/patient_documents/' . $patientData[0]->payment_bill);
        
        if($request->dob)
        {
            $patientInput['dob'] = date('Y-m-d', strtotime($request->dob));
        }
        $patientInput['gender'] = $request->gender;
        $patientInput['phone'] = $request->phone;
        $patientInput['address1'] = $request->address1;
        $patientInput['address2'] = $request->address2;
        $patientInput['city'] = $request->city;
        $patientInput['state'] = $request->state;
        $patientInput['zipCode'] = $request->zipCode;
        $patientInput['employer'] = $request->employer;
        $patientInput['occupation'] = $request->occupation;  
        
        if (isset($file)) {
            $extension = $file->getClientOriginalExtension();
            
            $filename = mt_rand(0, 99999999) . '.' . $extension;
            $uploads = 'uploads\patient_documents';

            if ($file->move($uploads, $filename)) {
                $patientInput['payment_bill'] = $filename;
                if (!empty($patientData[0]->payment_bill)) {
                    unlink($oldImagePath);
                }
            }
        }
        if ($userData->fill($userInput)->save() && $patientData[0]->fill($patientInput)->save()) {
            \Session::flash('flash_message', 'Patient details updated successfully.');
           
            return redirect('/patient');
        } else {
            return redirect('/patient/editPatient');
        }
    }

    // Fucntion for the common save for the patient Detail
    public function savePatientDetail($request, $userId) {
        $patient = new Patient;
        
        $patient->user_id = $userId;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        if($request->dob) {
            $patient->dob = date('Y-m-d', strtotime($request->dob));
        }
        $patient->address1 = $request->address1;
        $patient->address2 = $request->address2;
        $patient->city = $request->city;
        $patient->state = $request->state;
        $patient->zipCode = $request->zipCode;
        $patient->employer = $request->employer;
        $patient->occupation = $request->occupation;
        if ($patient->save()) {
            return $patient->id;
        } else {
            return 0;
        }
    }

    public function view($id = null) {
       if (!($patient = User::with('patientDetail', 'PatientDetail.patientStateName', 'roleName')->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
       
        return view('patient.view_patient', [
            'patient' => $patient
        ]);
    }

}
