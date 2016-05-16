<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');
    

    Route::get('/homes', 'HomeController@index');
	
    Route::get('/appointment/newAppointment/{id?}', 'AppointmentController@index');
    Route::get('/appointment/listappointment', 'AppointmentController@listappointment');
    Route::get('/appointment/viewappointment', 'AppointmentController@viewappointment');
    Route::post('/appointment/addappointment', 'AppointmentController@addappointment');
    Route::get('/appointment/show', 'AppointmentController@viewappointment');
    Route::post('/appointment/editappointment', 'AppointmentController@editappointment');
    Route::post('/appointment/saveappointment', 'AppointmentController@saveappointment');
    Route::get('/appointment/delete/{id}', 'AppointmentController@deleteappointment');
    Route::post('/appointment/editpatientappointment', 'AppointmentController@editpatientappointment');
    Route::get('/appointment/uniquePatientEmail/{email?}', 'AppointmentController@uniquePatientEmail');
    Route::post('/appointment/addPatAppointment', 'AppointmentController@addPatAppointment'); 
    Route::post('/appointment/saveAppointmentFolloup', 'AppointmentController@saveAppointmentFolloup');
    
    Route::get('/appointment/followup', 'AppointmentController@followup');
    Route::get('/appointment/viewFollowup/{id}', 'AppointmentController@viewfollowup');
    	Route::post('/getdoctorschedule', [
		'uses' => 'AppointmentController@getdoctorschedule',
		'as' => 'doctor.getSchedule',
		//'middleware' => ['acl:save_patient']
	]);		

    // route for ACL
    Route::get('/listRole', 'AclController@listRoles');
    Route::get('/addRole', 'AclController@addRole');
    Route::post('/saveRole', 'AclController@saveRole');
    Route::get('/deleteRole/{id}', 'AclController@deleteRole');
    Route::get('/editRole/{id}', 'AclController@editRole');
    Route::post('/updateRole/{id}', 'AclController@updateRole');
    Route::get('/listPermission/{id}', 'AclController@listPermissions');
    Route::post('/listPermission/updatePermission', 'AclController@updatePermission');
    
    
    
    
    // Route for patients
    Route::get('/patient', [
		'uses' => 'PatientController@index',
		'as' => 'patient',
		//'middleware' => ['acl:patient']
	]);	
	Route::get('/patient/addpatient', 'PatientController@addPatient');
	
	Route::get('/patient/edit/{id}', [
		'uses' => 'PatientController@edit',
		'as' => 'patient.edit',
		//'middleware' => ['acl:edit_patient']
	]);

	Route::get('/patient/delete/{id}', [
		'uses' => 'PatientController@delete',
		'as' => 'patient.delete',
		//'middleware' => ['acl:delete_patient']
	]);

	Route::get('/patient/view/{id}', [
		'uses' => 'PatientController@view',
		'as' => 'patient.view',
		//'middleware' => ['acl:view_patient']
	]);
	
	Route::post('/savePatient', [
		'uses' => 'PatientController@save',
		'as' => 'patient.save',
		//'middleware' => ['acl:save_patient']
	]);

	Route::post('/updatePatient/{id}', [
		'uses' => 'PatientController@updatePatient',
		//'middleware' => ['acl:editProcess_patient']
	]);
        
        // Doctor route
        
        Route::get('/doctor', 'DoctorController@index');
        Route::get('/doctor/addDoctor', 'DoctorController@addDoctor');
        Route::post('/doctor/saveDoctor', 'DoctorController@create');
        Route::get('/doctor/edit/{id}', 'DoctorController@edit');
        Route::post('/doctor/updateDoctor/{id}', 'DoctorController@update');
        Route::get('/doctor/delete/{id}', 'DoctorController@delete');
        Route::get('/doctor/view/{id}', 'doctorController@view');
        
        
        // route for User
        
        Route::get('/user/addUser', 'UserController@addUser');
        Route::post('/user/saveUser', 'UserController@saveUser');
        Route::get('/user/listUsers', 'UserController@listUsers');
        Route::post('/user/updateUserStatus', 'UserController@updateUserStatus');
        Route::get('/user/deleteUser/{id}', 'UserController@deleteUser');
        Route::get('/user/editUser/{id}', 'UserController@editUser');
        Route::post('/user/updatedUser/{id}', 'UserController@updateUser');
        Route::get('/user/viewUser/{id}', 'UserController@viewUser');
});



