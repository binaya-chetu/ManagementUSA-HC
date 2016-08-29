<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Appointment;
use App\User;
use App\Role;
use App\FollowupStatus;

/**
 * This class is used to handle home page related action
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class HomeController extends Controller {

    // declear properties for patient role and doctor role
    protected $doctor_role = 5;
    protected $patient_role = 6;

    /**
     * Create a new controller instance.
     *
     * @return null
     */
    public function __construct() {
        // uses auth middleware
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard with calender scheduler.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // get all appointments which status is active
        $appointments = Appointment::with(
            'patient.patientDetail', 'patient.reason', 'patient.reason.reasonCode'
        )
        ->whereIn('status', [1, 4])
        ->get();

        $collevent = [];
        $i = 0;
        foreach ($appointments as $appointment) {
            $events = [];
            $events ['id'] = $appointment->id;
            $reasonArr = $appointment->patient->reason->toArray();
            $reasonArray = array_column($reasonArr, 'reason_code');
            $reasonList = array_column($reasonArray, 'reason');
            $reason = implode(',', $reasonList);

            if ($appointment->patient && $appointment->patient->reason) {
                $reasonArr = $appointment->patient->reason->toArray();
                $reasonArray = array_column($reasonArr, 'reason_code');
                $reasonList = array_column($reasonArray, 'reason');
                $reason = implode(',', $reasonList);
            }

            $events ['title'] = $reason;
            if ($appointment->patient) {
                $events ['patientName'] = 'Patient: ' . $appointment->patient->first_name . " " . $appointment->patient->last_name;
            } else {
                $events ['patientName'] = '';
            }
            if ($appointment->patient && $appointment->patient->patientDetail) {
                $events ['mobile'] = 'Phone: ' . $appointment->patient->patientDetail->phone;
            }
            $events ['start'] = $appointment->apptTime;
            $events ['end'] = date('Y-m-d H:i:s', strtotime($appointment->apptTime . '+ 30 minute'));
            $events ['color'] = '#0088cc';
            $collevent[$i] = $events;
            $i++;
        }

        // get all patients list
        $patients = User::where('role', $this->patient_role)->get();
        // get all doctors list
        $doctors = User::where('role', $this->doctor_role)->get();
        $followupStatus = FollowupStatus::select('id', 'title')
            ->where('status', 1)
            ->get();

        return view('appointment.viewappointment', [
            'appointments' => $collevent,
            'patients' => $patients,
            'doctors' => $doctors,
            'followupStatus' => $followupStatus
        ]);
    }

}
