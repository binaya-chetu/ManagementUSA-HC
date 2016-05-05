<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Doctor;
use View;
use App;



class DoctorController extends Controller {

    
    private $rules = array(
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'required|email|unique:doctors',
    );
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {

        $doctors = \DB::table('doctors')->orderby('id', 'DESC')->paginate(15000000000);
        return view('doctor.index', ['doctors' => $doctors]);
    }

    public function create(Request $request) {
       $doctor = new Doctor();
       
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|max:255|unique:doctors',
            'phone' => 'required'
        ]);
        
        $input['dob'] = date('Y-m-d', strtotime($request->dob));
        $input = $request->all();
        
        if ($doctor->fill($input)->save()) {
            \Session::flash('flash_message', 'New doctor added successfully.');
            return redirect('/doctor');
        } else {
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
        if (!($doctor = Doctor::find($id))) {
            App::abort(404, 'Page not found.');
        }
        return view('doctor.edit_doctor')->withDoctor($doctor);
    }

    public function update($id, Request $request) {
        if (!($doctor = Doctor::find($id))) {
            App::abort(404, 'Page not found.');
        }
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
        ]);
        $input['dob'] = date('Y-m-d', strtotime($request->dob));
        $input = $request->all();
        if ($doctor->fill($input)->save()) {
            \Session::flash('flash_message', 'Doctor details updated successfully.');
            return redirect('/doctor');
        } else {
            return redirect('/doctor/editdoctor');
        }
    }

    public function delete($id) {
        if (!($doctor = Doctor::find($id))) {
            App::abort(404, 'Page not found.');
        }
        Doctor::destroy($id);
        \Session::flash('flash_message', 'Doctor has been deleted successfully.');
        return Redirect::back();
    } 
    
    public function view($id = null) {
        if (!($doctor = Doctor::find($id))) {
            App::abort(404, 'Page not found.');
        }
        return View::make('/doctor/view_doctor', compact('doctor'));
    }
    

}
