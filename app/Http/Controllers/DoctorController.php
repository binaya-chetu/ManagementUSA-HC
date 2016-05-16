<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Doctor;
use App\User;
use App\Role;
use App\State;
use View;
use App;




class DoctorController extends Controller {

    protected $role = 5;
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $doctors = User::with('doctorDetail', 'DoctorDetail.doctorStateName')->where('role', $this->role)->get();
        
        return view('doctor.index', ['doctors' => $doctors]);
    }
    
    public function addDoctor()
    {
        $states = State::get();
        
        $stateArray = array();
       
        foreach($states as $state)
        {
            $stateArray[$state->id] = $state->name;
        }
        
        return view('doctor.add_doctor', ['states' => $stateArray]);
    }
    
    public function create(Request $request) {
        
       
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15'
        ]);
        
        $userData = new User;
        $userData->first_name = $request->first_name;
        $userData->last_name = $request->last_name;
        $userData->email = $request->email;
        $userData->password = bcrypt($request['password']);
        $userData->role = $this->role;
       
        if ($userData->save()) 
        {
           $doctorData = new Doctor;
           $doctorData->user_id = $userData->id;
           if($request->dob)
            {
                $doctorData->dob = date('Y-m-d', strtotime($request->dob));
            }
           $doctorData->gender = $request->gender;
           $doctorData->phone = $request->phone;
           $doctorData->address1 = $request->address1;
           $doctorData->address2 = $request->address2;
           $doctorData->city = $request->city;
           $doctorData->state = $request->state;
           $doctorData->zipCode = $request->zipCode;
           $doctorData->employer = $request->employer;
           $doctorData->specialization = $request->specialization;
           
           if($doctorData->save())
           {
            \Session::flash('flash_message', 'Doctor created successfully.');
            return redirect('/doctor');
           }
           else
           {
                return redirect('/doctor/adddoctor');
           }
        }
        else 
        {
            return redirect('/doctor/addDcotor');
        }
    }

    public function store(Request $request) {
        //
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        if (!($doctor = User::with('doctorDetail')->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        $states = State::get();
        
        $stateArray = array();
       
        foreach($states as $state)
        {
            $stateArray[$state->id] = $state->name;
        }
        
        return view('doctor.edit_doctor', [
            'doctor' => $doctor,
            'states' => $stateArray
        ]);
    }

    public function update($id, Request $request) {
        if (!($userData = User::find($id))) {
            App::abort(404, 'Page not found.');
        }
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15'
        ]);
        
        $userInput['first_name'] = $request->first_name;
        $userInput['last_name'] = $request->last_name;
                
        $doctorData = Doctor::where('user_id',$id)->get();
        if($request->dob)
        {
            $doctorInput['dob'] = date('Y-m-d', strtotime($request->dob));
        }
        $doctorInput['gender'] = $request->gender;
        $doctorInput['phone'] = $request->phone;
        $doctorInput['address1'] = $request->address1;
        $doctorInput['address2'] = $request->address2;
        $doctorInput['city'] = $request->city;
        $doctorInput['state'] = $request->state;
        $doctorInput['zipCode'] = $request->zipCode;
        $doctorInput['employer'] = $request->employer;
        $doctorInput['specialization'] = $request->specialization;  
        
        if ($userData->fill($userInput)->save() && $doctorData[0]->fill($doctorInput)->save()) {
            \Session::flash('flash_message', 'Doctor details updated successfully.');
           
            return redirect('/doctor');
        } else {
            return redirect('/doctor/editdoctor');
        }
    }

    public function delete($id = null) {
        if (!($doctor = User::find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        User::destroy(base64_decode($id));
        \Session::flash('flash_message', 'Doctor has been deleted successfully.');
        return Redirect::back();
    } 
    
    public function view($id = null) {
        if (!($doctor = User::with('doctorDetail', 'UserDetail.userStateName', 'roleName')->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        
        return view('doctor.view_doctor', [
            'doctor' => $doctor
        ]);
    }
}
