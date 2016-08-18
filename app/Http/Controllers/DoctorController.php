<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Config\Repository;
use App\Doctor;
use App\User;
use App\Role;
use App\State;
use View;
use App;

/**
 * Class is used to handle all the action related to doctor module
 * 
 * @category App\Http\Controllers;
 * 
 * @return void
 */
class DoctorController extends Controller {

    // define role properties for doctor. 
    protected $role = 5;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //uses auth middleware
        $this->middleware('auth');
    }

    /**
     * Fetech all doctor data to show on index page in listing 
     *
     * @params void
     * 
     * @return \resource\views\doctor\index.blade.php
     */
    public function index() {
        // get the doctors list to show on index page
        $doctors = User::with('doctorDetail', 'DoctorDetail.doctorStateName')
            ->where('role', $this->role)
            ->orderBy('id', 'DESC')
            ->get();

        return view('doctor.index', ['doctors' => $doctors]);
    }

    /**
     * Call layout for the add new doctor 
     *
     * @params void
     * 
     * @return \resource\views\doctor\add_doctor.blade.php
     */
    public function addDoctor() {
        // get the state list from state table
        $states = State::lists('name', 'id')->toArray();

        return view('doctor.add_doctor', ['states' => $states]);
    }

    /**
     * Create new doctor and save data in user table and doctor_details table 
     *
     * @params $request
     *  
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        // define validation rule
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15'
        ]);

        // create User object
        $userData = new User;
        $userData->first_name = $request->first_name;
        $userData->last_name = $request->last_name;
        $userData->email = $request->email;
        $userData->password = bcrypt($request['password']);
        $userData->role = $this->role;

        // save user data in user table
        if ($userData->save()) {
            // create doctor object to store doctor details in doctor_details table
            $doctorData = new Doctor;
            // get the last inserted id to store in doctor_details table as reference key
            $doctorData->user_id = $userData->id;
            if ($request->dob) {
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

            // save the user details data in user_details table
            if ($doctorData->save()) {
                // set the flash message for doctor creation success.
                \Session::flash('flash_message', 'Doctor created successfully.');
                return redirect('/doctor');
            } else {
                return redirect('/doctor/adddoctor');
            }
        } else {
            return redirect('/doctor/addDcotor');
        }
    }

    /**
     * Get the layout for eadit doctor details
     *
     * @params $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if (!($doctor = User::with('doctorDetail')->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        // get the state list from state table
        $states = State::lists('name', 'id')->toArray();

        return view('doctor.edit_doctor', [
            'doctor' => $doctor,
            'states' => $states
        ]);
    }

    /**
     * Update the doctor details 
     *
     * @return \Illuminate\Http\Response
     */
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

        $doctorData = Doctor::where('user_id', $id)->get();
        if ($request->dob) {
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

    /**
     * This function is used to delete the doctor from user table and doctor details table.
     *
     * @param user_id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id = null) {
        $doctor = User::find(base64_decode($id));
        if (!$doctor || $doctor->role != config("constants.DOCTOR_ROLE_ID")) {
            App::abort(404, 'Page not found.');
        }

        User::destroy(base64_decode($id));
        \Session::flash('flash_message', 'Doctor has been deleted successfully.');
        return Redirect::back();
    }

    /**
     * This function is used to view the doctor details.
     *
     * @param user_id
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id = null) {
        if (!($doctor = User::with(
            'doctorDetail',
            'UserDetail.userStateName',
            'roleName'
        )->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }

        return view('doctor.view_doctor', [
            'doctor' => $doctor
        ]);
    }

}
