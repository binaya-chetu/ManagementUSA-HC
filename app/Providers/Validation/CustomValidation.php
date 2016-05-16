<?php namespace App\Providers\Validation;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Carbon\Carbon;
use App\Appointment;

class CustomValidation extends Validator {
	/**
	* $date: input date
	* $time: input time 
	* @getTimeStamp: combines input date and time values and convert that to timestamp
	*/
	protected function getTimeStamp($date, $time){
		$time = date("G:i", strtotime($time));
		$result = Carbon::createFromFormat('m/d/Y H:i', $date .' '. $time);
		return $result;
	}

    /**
     * $attribute Input name
     * $value Input value
     * $parameters Table, field1
     */
    public function validateFutureDate($attribute, $value, $parameters){
		$date = $value;
		$time = $parameters[0];

		$timestamp = $this->getTimeStamp($date, $time);
		$now = new \DateTime();
		$nowTimestamp = $now->getTimestamp();

        // Now if timestamp provided is less than current timestamp return false else return true
        return ($timestamp >= $now)? true : false;
    }
	
    public function validateDoctorAvailability($attribute, $value, $parameters){
		$doctor_id = $parameters[1];
		$date = $value;
		$time = $parameters[0];
		$apptSpan = \Config::get('constants.DEFAULT_APPOINTMENT_TIME_SPAN'); // average appt span time in sec
		$apptBufferTime = \Config::get('constants.GAP_BETWEEN_APPOINTMENTS'); // buffer time between two appointmentsin sec
		$timeToAdd = $apptSpan + $apptBufferTime;
		
		$timestamp = $this->getTimeStamp($date, $time);
		$appointment = new Appointment;		
		$appointments = $appointment->where('doctor_id', $doctor_id)->get();		
       
		foreach ($appointments as $appointment) {
            $start = $appointment->apptTime;
			
			$obj = new \DateTime($start);			
			$obj->add(new \DateInterval('PT' . $timeToAdd . 'M'));
			$end = $obj->format('Y-m-d H:i:s');
			
		 	if($timestamp >= $start && $timestamp < $end){
				return false;
			} 
        }
		return true;
    }

}