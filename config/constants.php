<?php
return [
	'CLINIC_OPEN_TIME'				=> '09:00:00',
	'CLINIC_CLOSE_TIME'				=> '18:00:00',
	'DEFAULT_APPOINTMENT_TIME_SPAN'	=> 30, // 30 min
	'GAP_BETWEEN_APPOINTMENTS'		=> 0,
	
	'MAIL_DRIVER'					=> 'smtp',
	'MAIL_HOST'						=> 'mymails.chetu.com',
	'MAIL_PORT'						=> 25, 
	'MAIL_FROM_NAME'				=> 'azmensclinic1',
	'MAIL_FROM_ADDRESS'				=> 'sureshc@chetu.com',
	'MAIL_ENCRYPTION'				=> 'tls',
	
	'PATIENT_ROLE_SLUG'				=> 'patient',

	'PATIENT_ROLE_ID'				=> 6,
	'DOCTOR_ROLE_SLUG'				=> 'doctor',
	'DOCTOR_ROLE_ID'				=> 5,
	'ADMIN_ROLE_SLUG'				=> 'admin',
	'AUTHORS_ROLE_SLUG'				=> 'authors',
	'USER_ROLE_SLUG'				=> 'user',
	
	'APPOINTMENT_SET_FLAG'			=> 0,
	'APPOINTMENT_NO_SET_FLAG'		=> 1,
    'APPOINTMENT_AFTER_REPORT_FLAG'	=> 5,
	
	'BRONZE_PKG_ID'					=> 1,
	'SILVER_PKG_ID'					=> 2,
	'GOLD_PKG_ID'					=> 3

];