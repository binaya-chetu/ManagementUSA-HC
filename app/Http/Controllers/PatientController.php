<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Patient;
use View;
use App;

//use Validator;

class PatientController extends Controller {

    private $rules = array(
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'required|email|unique:patients',
    );

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
    public function index($id = null) {
        if ($id == null) {
            $patients = \DB::table('patients')->orderby('id', 'DESC')->paginate(15000000000);
            //$patients = \DB::table('patients')->orderby('id', 'DESC');
            return view('patient.patients', ['patients' => $patients]);
        } else {
            $patient = Patient::find($id);
            return view('patient.patient', ['patient' => $patient]);
        }
    }

    public function save(Request $request) {

        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required'
        ]);

        $saveResult = $this->savePatientDetail($request);
        if ($saveResult != 0) {
            \Session::flash('flash_message', 'Patient added successfully.');
            return redirect('/patient');
        } else {
            return redirect('/patient/addPatient');
        }
    }

    public function edit($id = null) {
        if (!($patient = Patient::find($id))) {
            App::abort(404, 'Page not found.');
        }
        return view('patient.editPatient')->withPatient($patient);
        //return View::make('patient/editPatient', compact('patient'));
    }

    public function delete($id = null) {
        if (!($patient = Patient::find($id))) {
            App::abort(404, 'Page not found.');
        }
        Patient::destroy($id);
        \Session::flash('flash_message', 'Data deleted successfully.');
        return Redirect::back();
    }

    public function updatePatient($id, Request $request) {
        if (!($patient = Patient::find($id))) {
            App::abort(404, 'Page not found.');
        }
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required',
            'payment_bill' => 'mimes:jpg,png,jpeg,doc,docx,pdf,csv,xls'
        ]);
        $input = $request->all();
        $file = $request->file('payment_bill');
        $oldImagePath = public_path('uploads/patient_documents/' . $patient->payment_bill);

        if (isset($file)) {
            $extension = $file->getClientOriginalExtension();
            
            $filename = mt_rand(0, 99999999) . '.' . $extension;
            $uploads = 'uploads\patient_documents';

            if ($file->move($uploads, $filename)) {
                $input['payment_bill'] = $filename;
                if (!empty($patient->payment_bill)) {
                    unlink($oldImagePath);
                }
            }
        }
        if ($patient->fill($input)->save()) {
            \Session::flash('flash_message', 'Patient details updated successfully.');
            return redirect('/patient');
        } else {
            return redirect('/patient/editPatient');
        }
    }

    // Fucntion for the common save for the patient Detail
    public function savePatientDetail($request) {
        $patient = new Patient;
        $patient->firstName = $request->firstName;
        $patient->lastName = $request->lastName;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        $patient->dob = date('Y-m-d', strtotime($request->dob));
        $patient->address1 = $request->address1;
        $patient->address2 = $request->address2;
        $patient->city = $request->city;
        $patient->state = $request->state;
        $patient->zipCode = $request->zipCode;
        $patient->employer = $request->zipCode;
        $patient->occupation = $request->occupation;

        if ($patient->save()) {
            return $patient->id;
        } else {
            return 0;
        }
    }

    public function view($id = null) {
        if (!($patient = Patient::find($id))) {
            App::abort(404, 'Page not found.');
        }
        
        return View::make('patient/view_patient', compact('patient'));
    }

}
