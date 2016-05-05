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
/*
Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
*/

use App\Task;
use Illuminate\Http\Request;

/**
 * Show Task Dashboard
 */
Route::get('/', function () {

    return view('auth.login');
});

Route::group(['middleware' => 'web'], function () {
	Route::get('/', 'HomeController@index');
    Route::auth();

    Route::get('/homes', 'HomeController@index');
	
    Route::get('/appointment/{id}', 'AppointmentController@index');
    Route::get('/listappointment', 'AppointmentController@listappointment');
    Route::get('/viewappointment', 'AppointmentController@viewappointment');
    Route::post('/addappointment', 'AppointmentController@addappointment');
    Route::get('/show', 'AppointmentController@viewappointment');
    Route::post('/editappointment', 'AppointmentController@editappointment');
    Route::post('/saveappointment', 'AppointmentController@saveappointment');
    Route::post('/deleteappointment', 'AppointmentController@deleteappointment');
    Route::post('/editpatientappointment', 'AppointmentController@editpatientappointment');
    Route::post('/uniquePatientEmail', 'AppointmentController@uniquePatientEmail');
    
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
	Route::get('/patient/addpatient', [
		'as' => 'patient.add', 
		function(){
			return View::make('patient.addpatient');
		},
		//'middleware'=> ['acl:add_patient']		
	]);
	
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
        Route::get('/doctor/addDoctor', ['as' => 'doctor.add', function(){ return View::make('doctor.add_doctor');
                    }	]);
        Route::post('/doctor/saveDoctor', 'DoctorController@create');
        Route::get('/doctor/edit/{id}', 'DoctorController@edit');
        Route::post('/doctor/updateDoctor/{id}', 'DoctorController@update');
        Route::get('/doctor/delete/{id}', 'DoctorController@delete');
        Route::get('/doctor/view/{id}', 'doctorController@view');
});
Route::auth();
Route::get('/home', 'HomeController@index');



