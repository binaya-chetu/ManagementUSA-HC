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
    
    // route for appointment module
    Route::get('/appointment/newAppointment/{id?}', [
            'uses' => 'AppointmentController@index',
            'as' => 'appointment.newAppointment',
            'middleware' => ['acl:appointment_write']
        ]);
    Route::get('/appointment/listappointment', [
            'uses' => 'AppointmentController@listappointment',
            'as' => 'appointment.listappointment',
            'middleware' => ['acl:appointment_read']
        ]);
    Route::get('/appointment/viewappointment', [
            'uses' => 'AppointmentController@viewappointment',
            'as' => 'appointment.viewappointment',
            'middleware' => ['acl:appointment_read']
        ]);
    Route::post('/appointment/addappointment', [
            'uses' => 'AppointmentController@addappointment',
            'as' => 'appointment.addappointment',
            'middleware' => ['acl:appointment_write']
        ]);
    Route::get('/appointment/show', [
            'uses' => 'AppointmentController@viewappointment',
            'as' => 'appointment.show',
            'middleware' => ['acl:appointment_read']
        ]);
    Route::post('/appointment/editappointment', [
            'uses' => 'AppointmentController@editappointment',
            'as' => 'appointment.editappointment',
            'middleware' => ['acl:appointment_write']
        ]);
    Route::post('/appointment/saveappointment', [
            'uses' => 'AppointmentController@saveappointment',
            'as' => 'appointment.saveappointment',
            'middleware' => ['acl:appointment_write']
        ]);
    Route::get('/appointment/delete/{id}', [
            'uses' => 'AppointmentController@deleteappointment',
            'as' => 'appointment.delete',
            'middleware' => ['acl:appointment_write']
        ]);
    Route::post('/appointment/editpatientappointment', [
            'uses' => 'AppointmentController@editpatientappointment',
            'as' => 'appointment.editpatientappointment',
            'middleware' => ['acl:appointment_write']
        ]);
    Route::get('/appointment/uniquePatientEmail/{email?}', [
            'uses' => 'AppointmentController@uniquePatientEmail',
            'as' => 'appointment.uniquePatientEmail',
            'middleware' => ['acl:appointment_write']
        ]);
    Route::post('/appointment/addPatAppointment', [
            'uses' => 'AppointmentController@addPatAppointment',
            'as' => 'appointment.addPatAppointment',
            'middleware' => ['acl:appointment_write']
        ]); 
    Route::post('/appointment/saveAppointmentFolloup', [
            'uses' => 'AppointmentController@saveAppointmentFolloup',
            'as' => 'appointment.saveAppointmentFolloup',
            'middleware' => ['acl:appointment_write']
        ]);
    Route::post('/appointment/checkList', [
            'uses' => 'AppointmentController@checkList',
            'as' => 'appointment.checkList',
            'middleware' => ['acl:appointment_write']
        ]);
    
    Route::get('/appointment/followup', [
            'uses' => 'AppointmentController@followup',
            'as' => 'appointment.followup',
            'middleware' => ['acl:followupappointment_read']
        ]);
    Route::get('/appointment/viewFollowup/{id}', [
            'uses' => 'AppointmentController@viewfollowup',
            'as' => 'appointment.viewFollowup',
            'middleware' => ['acl:followupappointment_read']
        ]);
    Route::get('/appointment/patientMedical/{id}', [
            'uses' => 'AppointmentController@patientMedical',
            'as' => 'appointment.patientMedical',
            'middleware' => ['acl:followupappointment_read']
        ]);
    Route::post('/getdoctorschedule', [
            'uses' => 'AppointmentController@getdoctorschedule',
            'as' => 'doctor.getSchedule',
            'middleware' => ['acl:appointment_write']
    ]);		

    // route for ACL
    Route::get('/acl/listRole', [
            'uses' => 'AclController@listRoles',
            'as' => 'acl.listRole',
            'middleware' => ['acl:role_read']
        ]);
    Route::get('/acl/addRole', [
            'uses' => 'AclController@addRole',
            'as' => 'acl.addRole',
            'middleware' => ['acl:role_write']
        ]);
    Route::post('/acl/saveRole', [
            'uses' => 'AclController@saveRole',
            'as' => 'acl.saveRole',
            'middleware' => ['acl:role_write']
        ]);
    Route::get('/acl/deleteRole/{id}', [
            'uses' => 'AclController@deleteRole',
            'as' => 'acl.deleteRole',
            'middleware' => ['acl:role_write']
        ]);
    Route::get('/acl/editRole/{id}', [
            'uses' => 'AclController@editRole',
            'as' => 'acl.editRole',
            'middleware' => ['acl:role_write']
        ]);
    Route::post('/acl/updateRole/{id}', [
            'uses' => 'AclController@updateRole',
            'as' => 'acl.updateRole',
            'middleware' => ['acl:role_write']
        ]);
    Route::get('/acl/listPermission/{id}', [
            'uses' => 'AclController@listPermissions',
            'as' => 'acl.listPermission',
            'middleware' => ['acl:role_write']
        ]);
    Route::post('/acl/listPermission/updatePermission', [
            'uses' => 'AclController@updatePermission',
            'as' => 'acl.listPermission',
            'middleware' => ['acl:role_write']
        ]); 
    
    // Route for patients
    Route::get('/patient', [
            'uses' => 'PatientController@index',
            'as' => 'patient',
            'middleware' => ['acl:patient_read']
        ]);

    Route::get('/patient/addpatient', [
            'uses' => 'PatientController@addPatient',
            'as' => 'patient.addpatient',
            'middleware' => ['acl:patient_write']
        ]);

    Route::get('/patient/edit/{id}', [
            'uses' => 'PatientController@edit',
            'as' => 'patient.edit',
            'middleware' => ['acl:patient_write']
        ]);

    Route::get('/patient/delete/{id}', [
            'uses' => 'PatientController@delete',
            'as' => 'patient.delete',
            'middleware' => ['acl:patient_write']
        ]);

    Route::get('/patient/view/{id}', [
            'uses' => 'PatientController@view',
            'as' => 'patient.view',
            'middleware' => ['acl:patient_read']
        ]);

    Route::post('/patient/savePatient', [
            'uses' => 'PatientController@save',
            'as' => 'patient.savePatient',
            'middleware' => ['acl:patient_write']
        ]);

    Route::post('/patient/updatePatient/{id}', [
            'uses' => 'PatientController@updatePatient',
            'as' => 'patient.updatePatient',
            'middleware' => ['acl:patient_write']
        ]);

    // Doctor route

    Route::get('/doctor', [
            'uses' => 'DoctorController@index',
            'as' => 'doctor',
            'middleware' => ['acl:doctor_read']
        ]);
    Route::get('/doctor/addDoctor', [
            'uses' => 'DoctorController@addDoctor',
            'as' => 'doctor.addDoctor',
            'middleware' => ['acl:doctor_write']
        ]);
    Route::post('/doctor/saveDoctor', [
            'uses' => 'DoctorController@create',
            'as' => 'doctor.saveDoctor',
            'middleware' => ['acl:doctor_write']
        ]);
    Route::get('/doctor/edit/{id}', [
            'uses' => 'DoctorController@edit',
            'as' => 'doctor.edit',
            'middleware' => ['acl:doctor_write']
        ]);
    Route::post('/doctor/updateDoctor/{id}', [
            'uses' => 'DoctorController@update',
            'as' => 'doctor.updateDoctor',
            'middleware' => ['acl:doctor_write']
        ]);
    Route::get('/doctor/delete/{id}', [
            'uses' => 'DoctorController@delete',
            'as' => 'doctor.delete',
            'middleware' => ['acl:doctor_write']
        ]);
    Route::get('/doctor/view/{id}', [
            'uses' => 'doctorController@view',
            'as' => 'doctor.view',
            'middleware' => ['acl:doctor_read']
        ]);


    // route for User

    Route::get('/user/addUser', [
            'uses' => 'UserController@addUser',
            'as' => 'user.addUser',
            'middleware' => ['acl:user_write']
        ]);
    Route::post('/user/saveUser', [
            'uses' => 'UserController@saveUser',
            'as' => 'user.saveUser',
            'middleware' => ['acl:user_write']
        ]);
    Route::get('/user/listUsers', [
            'uses' => 'UserController@listUsers',
            'as' => 'user.listUsers',
            'middleware' => ['acl:user_read']
        ]);
    Route::post('/user/updateUserStatus', [
            'uses' => 'UserController@updateUserStatus',
            'as' => 'user.updateUserStatus',
            'middleware' => ['acl:user_write']
        ]);
    Route::get('/user/deleteUser/{id}', [
            'uses' => 'UserController@deleteUser',
            'as' => 'user.deleteUser',
            'middleware' => ['acl:user_write']
        ]);
    Route::get('/user/editUser/{id}', [
            'uses' => 'UserController@editUser',
            'as' => 'user.editUser',
            'middleware' => ['acl:user_write']
        ]);
    Route::post('/user/updatedUser/{id}', [
            'uses' => 'UserController@updateUser',
            'as' => 'user.updatedUser',
            'middleware' => ['acl:user_write']
        ]);
    Route::get('/user/viewUser/{id}', [
            'uses' => 'UserController@viewUser',
            'as' => 'user.viewUser',
            'middleware' => ['acl:user_read']
        ]);
});



