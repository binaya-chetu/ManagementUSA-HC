<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Appointment;
use App\User;
use App\Role;

class HomeController extends Controller
{
    protected $patient_role = 6;
    protected $doctor_role = 5;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::with('patient.patientDetail' )->whereIn('status', [1, 4])->get();
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
}
