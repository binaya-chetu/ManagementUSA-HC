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
    
    // Route for HomeController
    Route::get('/home', [
        'uses' => 'HomeController@index',
        'as' => 'HomeController.index'
    ]);
    
    Route::get('/', [
        'uses' => 'HomeController@index',
        'as' => 'HomeController.index'
    ]);
    
    Route::get('/common/messages', function(){
        echo '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> Client Profile updated successfully.</em></div>';
    });
        
    /*
     * Route for AppointmentSettingController
     */
   
    Route::get('/apptsetting/index/{val?}', [
        'uses' => 'ApptSettingController@index',
        'as' => 'apptsetting.index',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::get('/apptsettingFront/index/{val?}', [
        'uses' => 'ApptSettingController@index',
        'as' => 'apptsetting.index',
        'middleware' => ['acl:appointment_setting_write']
    ]);

    Route::get('/apptsetting/marketingCall', [
        'uses' => 'ApptSettingController@marketingCall',
        'as' => 'apptsetting.marketingCall',
        'middleware' => ['acl:appointment_setting_write']
    ]);

    Route::get('/apptsetting/missedCall', [
        'uses' => 'ApptSettingController@missedCall',
        'as' => 'apptsetting.missedCall',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::get('/apptsetting/webLead', [
        'uses' => 'ApptSettingController@webLead',
        'as' => 'apptsetting.webLead',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::post('/apptsetting/saveAppointment', [
        'uses' => 'ApptSettingController@saveAppointment',
        'as' => 'apptsetting.saveAppointment',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::post('/apptsetting/saveMarketingCall', [
        'uses' => 'ApptSettingController@saveMarketingCall',
        'as' => 'apptsetting.saveMarketingCall',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::get('/apptsetting/uniqueEmail/{email?}', [
        'uses' => 'ApptSettingController@uniqueEmail',
        'as' => 'apptsetting.uniqueEmail',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::post('/apptsetting/findAppointmentDetail', [
        'uses' => 'ApptSettingController@findAppointmentDetail',
        'as' => 'apptsetting.findAppointmentDetail',
        'middleware' => ['acl:appointment_setting_write']
    ]);

    Route::get('/apptsetting/requestFollowUp', [
        'uses' => 'ApptSettingController@requestFollowUp',
        'as' => 'apptsetting.requestFollowUp',
        'middleware' => ['acl:appointment_read']
    ]);
         
    Route::post('/apptsetting/editRequestfollowup/', [
        'uses' => 'ApptSettingController@editRequestfollowup',
        'as' => 'apptsetting.editRequestfollowup',
       'middleware' => ['acl:apptsetting_setting_write']
    ]);
     
      Route::post('/appointment/editappointment', [
        'uses' => 'AppointmentController@editappointment',
        'as' => 'appointment.editappointment',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::post('/apptsetting/saveRequestFollowUp', [
        'uses' => 'ApptSettingController@saveRequestFollowUp',
        'as' => 'apptsetting.saveRequestFollowUp',
        'middleware' => ['acl:appointment_write']
    ]);
    
   Route::post('/apptsetting/anotherAppointment', [
        'uses' => 'ApptSettingController@anotherAppointment',
        'as' => 'apptsetting.anotherAppointment',
        //'middleware' => ['acl:appointment_read']
    ]);

    Route::get('/apptsetting/directWalkins', [
        'uses' => 'ApptSettingController@directWalkins',
        'as' => 'ApptSettingController@directWalkins',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::get('/apptsetting/showAccessData', [
        'uses' => 'ApptSettingController@showAccessData',
        'as' => 'ApptSettingController@showAccessData',
        //'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::get('/sale/index', [
        'uses' => 'SaleController@index',
        'as' => 'SaleController@index',
        //'middleware' => ['acl:appointment_setting_write']
    ]);

    Route::get('/sale/checkout/{id}', [
        'uses' => 'SaleController@checkout',
        'as' => 'SaleController@checkout',
        //'middleware' => ['acl:appointment_setting_write']
    ]);
    Route::get('/sale/confirmation/{id}', [
            'uses' => 'SaleController@confirmation',
            'as' => 'SaleController@confirmation',
            //'middleware' => ['acl:appointment_setting_write']
        ]);
    Route::post('/sale/confirmation/{id}', [
            'uses' => 'SaleController@confirmation',
            'as' => 'SaleController@confirmation',
            //'middleware' => ['acl:appointment_setting_write']
        ]);
    Route::post('/sale/makePayment', [
            'uses' => 'SaleController@makePayment',
            'as' => 'SaleController@makePayment',
            //'middleware' => ['acl:appointment_setting_write']
        ]);
    Route::get('/sale/paymentDetails/{id}', [
            'uses' => 'SaleController@paymentDetails',
            'as' => 'SaleController@paymentDetails',
            //'middleware' => ['acl:appointment_setting_write']
        ]);
    // Route for PatientController in POS Module
    Route::get('/patient', [
        'uses' => 'PatientController@index',
        'as' => 'patient',
        'middleware' => ['acl:pos_read']
    ]);

    Route::get('/patient/addpatient', [
        'uses' => 'PatientController@addPatient',
        'as' => 'patient.addpatient',
        'middleware' => ['acl:pos_write']
    ]);

    Route::get('/patient/edit/{id}', [
        'uses' => 'PatientController@edit',
        'as' => 'patient.edit',
        'middleware' => ['acl:pos_write']
    ]);

    Route::get('/patient/delete/{id}', [
        'uses' => 'PatientController@delete',
        'as' => 'patient.delete',
        'middleware' => ['acl:pos_write']
    ]);

    Route::get('/patient/view/{id}', [
        'uses' => 'PatientController@view',
        'as' => 'patient.view',
        'middleware' => ['acl:pos_read']
    ]);

    Route::post('/patient/savePatient', [
        'uses' => 'PatientController@save',
        'as' => 'patient.savePatient',
        'middleware' => ['acl:pos_write']
    ]);

    Route::post('/patient/updatePatient/{id}', [
        'uses' => 'PatientController@updatePatient',
        'as' => 'patient.updatePatient',
        'middleware' => ['acl:pos_write']
    ]);
    
    
    // Route for DoctorController in POS Module
    Route::get('/doctor', [
        'uses' => 'DoctorController@index',
        'as' => 'doctor',
        'middleware' => ['acl:pos_read']
    ]);
    
    Route::get('/doctor/addDoctor', [
        'uses' => 'DoctorController@addDoctor',
        'as' => 'doctor.addDoctor',
        'middleware' => ['acl:pos_write']
    ]);
    
    Route::post('/doctor/saveDoctor', [
        'uses' => 'DoctorController@create',
        'as' => 'doctor.saveDoctor',
        'middleware' => ['acl:pos_write']
    ]);
    
    Route::get('/doctor/edit/{id}', [
        'uses' => 'DoctorController@edit',
        'as' => 'doctor.edit',
        'middleware' => ['acl:pos_write']
    ]);
    
       
    Route::post('/doctor/updateDoctor/{id}', [
        'uses' => 'DoctorController@update',
        'as' => 'doctor.updateDoctor',
        'middleware' => ['acl:pos_write']
    ]);
    
    Route::get('/doctor/delete/{id}', [
        'uses' => 'DoctorController@delete',
        'as' => 'doctor.delete',
        'middleware' => ['acl:pos_write']
    ]);
    
    Route::get('/doctor/view/{id}', [
        'uses' => 'doctorController@view',
        'as' => 'doctor.view',
        'middleware' => ['acl:pos_read']
    ]);

    
    // Route for AppointmentController in Appointment Setting Module
    Route::get('/appointment/newAppointment/{id?}', [
        'uses' => 'AppointmentController@index',
        'as' => 'appointment.newAppointment',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::get('/appointment/listappointment', [
        'uses' => 'AppointmentController@listappointment',
        'as' => 'appointment.listappointment',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::get('/appointment/viewappointment', [
        'uses' => 'AppointmentController@viewappointment',
        'as' => 'appointment.viewappointment',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::post('/appointment/addappointment', [
        'uses' => 'AppointmentController@addappointment',
        'as' => 'appointment.addappointment',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::get('/appointment/show', [
        'uses' => 'AppointmentController@viewappointment',
        'as' => 'appointment.show',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::post('/appointment/editappointment', [
        'uses' => 'AppointmentController@editappointment',
        'as' => 'appointment.editappointment',
        'middleware' => ['acl:appointment_setting_write']
    ]);
   
    Route::post('/appointment/saveappointment', [
        'uses' => 'AppointmentController@saveappointment',
        'as' => 'appointment.saveappointment',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::get('/appointment/delete/{id}', [
        'uses' => 'AppointmentController@deleteappointment',
        'as' => 'appointment.delete',
        'middleware' => ['acl:appointment_setting_write']
    ]);
		
    Route::get('/appointment/followup/delete/{id}', [
        'uses' => 'AppointmentController@deletefollowup',
        'as' => 'appointment.followup.delete',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::post('/appointment/editpatientappointment', [
        'uses' => 'AppointmentController@editpatientappointment',
        'as' => 'appointment.editpatientappointment',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::get('/appointment/uniquePatientEmail/{email?}', [
        'uses' => 'AppointmentController@uniquePatientEmail',
        'as' => 'appointment.uniquePatientEmail',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::post('/appointment/addPatAppointment', [
        'uses' => 'AppointmentController@addPatAppointment',
        'as' => 'appointment.addPatAppointment',
        'middleware' => ['acl:appointment_setting_write']
    ]); 
    
    Route::post('/appointment/saveAppointmentFolloup', [
        'uses' => 'AppointmentController@saveAppointmentFolloup',
        'as' => 'appointment.saveAppointmentFolloup',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::post('/appointment/checkList', [
        'uses' => 'AppointmentController@checkList',
        'as' => 'appointment.checkList',
        //'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::post('/appointment/savePatientStatus', [
        'uses' => 'AppointmentController@savePatientStatus',
        'as' => 'appointment.savePatientStatus',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    Route::get('/appointment/labAppointments', [
        'uses' => 'AppointmentController@labAppointments',
        'as' => 'appointment.labAppointments',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::get('/appointment/followup', [
        'uses' => 'AppointmentController@followup',
        'as' => 'appointment.followup',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::get('/appointment/viewFollowup/{id}', [
        'uses' => 'AppointmentController@viewfollowup',
        'as' => 'appointment.viewFollowup',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::get('/appointment/patientMedical/{id}', [
        'uses' => 'AppointmentController@patientMedical',
        'as' => 'appointment.patientMedical',
        'middleware' => ['acl:appointment_setting_write']
    ]);
    
    // Do not add middleware to this route
    Route::get('/appointment/patientMedical/{id}/hash/{hash}', [
        'uses' => 'AppointmentController@patientMedical',
        'as' => 'appointment.patientMedicalWithHash',
        //'middleware' => ['acl:followupappointment_read']
    ]);
    
    Route::post('/getdoctorschedule', [
        'uses' => 'AppointmentController@getdoctorschedule',
        'as' => 'doctor.getSchedule',
        'middleware' => ['acl:appointment_setting_write']
    ]);

    Route::get('/appointment/upcomingappointments', [
        'uses' => 'AppointmentController@upcomingappointments',
        'as' => 'appointment.upcomingappointments',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::get('/appointment/todayVisits', [
        'uses' => 'AppointmentController@todayVisits',
        'as' => 'appointment.todayVisits',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
     Route::post('/appointment/savePatientMedicalRecord/{id}', [
        'uses' => 'AppointmentController@savePatientMedicalRecord',
        'as' => 'appointment.savePatientMedicalRecord',
    ]);
    
      Route::post('/appointment/countAppointments', [
        'uses' => 'AppointmentController@countAppointments',
        'as' => 'appointment.countAppointments',
        'middleware' => ['acl:appointment_write']
    ]);
      
    Route::get('/appointment/labReadyAppointments', [
        'uses' => 'AppointmentController@labReadyAppointments',
        'as' => 'appointment.labReadyAppointments',
        'middleware' => ['acl:appointment_read']
    ]);
    
    Route::get('/appointment/appointmentAfterReport', [
        'uses' => 'AppointmentController@appointmentAfterReport',
        'as' => 'appointment.appointmentAfterReport',
       // 'middleware' => ['acl:appointment_write']
    ]);
    
    // route for ACL
    Route::get('/acl/listRole', [
        'uses' => 'AclController@listRoles',
        'as' => 'acl.listRole',
        'middleware' => ['acl:acl_management_read']
    ]);
    
    Route::get('/acl/addRole', [
        'uses' => 'AclController@addRole',
        'as' => 'acl.addRole',
        'middleware' => ['acl:acl_management_write']
    ]);
    
    Route::post('/acl/saveRole', [
        'uses' => 'AclController@saveRole',
        'as' => 'acl.saveRole',
        'middleware' => ['acl:acl_management_write']
    ]);
    
    Route::get('/acl/deleteRole/{id}', [
        'uses' => 'AclController@deleteRole',
        'as' => 'acl.deleteRole',
        'middleware' => ['acl:acl_management_write']
    ]);
    
    Route::get('/acl/editRole/{id}', [
        'uses' => 'AclController@editRole',
        'as' => 'acl.editRole',
        'middleware' => ['acl:acl_management_write']
    ]);
    
    Route::post('/acl/updateRole/{id}', [
        'uses' => 'AclController@updateRole',
        'as' => 'acl.updateRole',
        'middleware' => ['acl:acl_management_write']
    ]);
    
    Route::get('/acl/listPermission/{id}', [
        'uses' => 'AclController@listPermissions',
        'as' => 'acl.listPermission',
        'middleware' => ['acl:acl_management_write']
    ]);
    
    Route::post('/acl/listPermission/updatePermission', [
        'uses' => 'AclController@updatePermission',
        'as' => 'acl.listPermission',
        'middleware' => ['acl:acl_management_write']
    ]);
    
    
    // Route for UserController in User Management
    Route::get('/user/addUser', [
        'uses' => 'UserController@addUser',
        'as' => 'user.addUser',
        'middleware' => ['acl:user_management_write']
    ]);
    
    Route::post('/user/saveUser', [
        'uses' => 'UserController@saveUser',
        'as' => 'user.saveUser',
        'middleware' => ['acl:user_management_write']
    ]);
    
    Route::get('/user/listUsers', [
        'uses' => 'UserController@listUsers',
        'as' => 'user.listUsers',
        'middleware' => ['acl:user_management_read']
    ]);
    
    Route::post('/user/updateUserStatus', [
        'uses' => 'UserController@updateUserStatus',
        'as' => 'user.updateUserStatus',
        'middleware' => ['acl:user_management_write']
    ]);
    
    Route::get('/user/deleteUser/{id}', [
        'uses' => 'UserController@deleteUser',
        'as' => 'user.deleteUser',
        'middleware' => ['acl:user_management_write']
    ]);
    
    Route::get('/user/editUser/{id}', [
        'uses' => 'UserController@editUser',
        'as' => 'user.editUser',
        'middleware' => ['acl:user_management_write']
    ]);
    
    Route::post('/user/updatedUser/{id}', [
        'uses' => 'UserController@updateUser',
        'as' => 'user.updatedUser',
        'middleware' => ['acl:user_management_write']
    ]);
    
    Route::get('/user/viewUser/{id}', [
        'uses' => 'UserController@viewUser',
        'as' => 'user.viewUser',
        'middleware' => ['acl:user_management_read']
    ]);
    

    // Route for CategoriesController in Products Categories
    Route::get('/categories/listCategories', [
        'uses' => 'CategoriesController@listCategories',
        'as' => 'categories.listCategories',
        'middleware' => ['acl:product_categories_read']
    ]);

    Route::get('/categories/categoryDetails/{id}', [
        'uses' => 'CategoriesController@categoryDetails',
        'as' => 'categories.categoryDetails',
        'middleware' => ['acl:product_categories_read']
    ]);
    
    Route::get('/categories/newCategory', [
        'uses' => 'CategoriesController@addNewCategory',
        'as' => 'categories.addNewCategory',
        'middleware' => ['acl:product_categories_write']
    ]);
       
    Route::get('/categories/addcategories', [
        'uses' => 'CategoriesController@addcategories',
        'as' => 'categories.addcategories',
        'middleware' => ['acl:product_categories_write']
    ]);
    
    Route::post('/categories/saveCategories', [
        'uses' => 'CategoriesController@saveCategories',
        'as' => 'categories.savecategories',
        'middleware' => ['acl:product_categories_write']	
    ]);
    
    Route::post('/categories/saveCategory', [
        'uses' => 'CategoriesController@saveCategory',
        'as' => 'CategoriesController.saveCategory',
        'middleware' => ['acl:product_categories_write']
    ]);

    Route::get('/web_lead', function(){
        $table = WebLead::webLeads();
        $filename = "web-leads.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Sr. No.','Name','Email','Phone','Location','Requested Time'));

        foreach($table as $row) {
                fputcsv($handle, array($row['id'], $row['first_name']['last_name'], $row['email'], $row['phone'], $row['location'], $row['requested_time']));
        }

        fclose($handle);

        $headers = array(
                'Content-Type' => 'text/csv',
        );
        return Response::download($filename, 'web-leads.csv', $headers);
    });
    
    // Route for CartController in Shop Module.
    Route::post('/cart/addProduct', [
        'uses' => 'CartController@addItem',
        'as' => 'cart.ddItem',
        //'middlaware' => ['acl:user_write']
    ]);
    
    Route::get('/cart/removeItem/{cartId}', [
        'uses' => 'CartController@removeItem',
        'as' => 'cart.removeItem',
        //'middleware' => ['acl:user_write']
    ]);
    
    Route::get('/cart/emptyCart/{patientId}', [
        'uses' => 'CartController@emptyCart',
        'as' => 'cart.removeItem',
        //'middleware' => ['acl:user_write']
    ]);
    
    Route::get('/cart/cart/{patientId}', [
        'uses' => 'CartController@showCart',
        'as' => 'cart.showCart',
        //'middleware' => ['acl:user_write']
    ]);
    
    Route::post('/cart/countCartItem/{id}', [
        'uses' => 'CartController@countCartItem',
        'as' => 'cart.countCartItem',
        //'middlaware' => ['acl:user_write']
    ]);
    
    // Route for ProductsController in Products Imports
    Route::get('/products/addproducts', [
        'uses' => 'ProductsController@addproducts',
        'as' => 'products.addproducts',
        'middleware' => ['acl:product_imports_write']
    ]);

    Route::post('/products/saveProducts', [
        'uses' => 'ProductsController@saveProducts',
        'as' => 'products.saveproducts',
        'middleware' => ['acl:product_imports_write']
    ]);
    
     Route::get('/product/inventory', [
        'uses' => 'ProductsController@showInventory',
        'as' => 'products.showInventory',
        'middleware' => ['acl:product_categories_read']
    ]);
		
    Route::post('/product/updateProduct', [
        'uses' => 'ProductsController@updateProduct',
        'as' => 'products.updateProduct',
        'middleware' => ['acl:product_categories_write']
    ]);
    
    
    Route::get('/product/create', [
        'uses' => 'ProductsController@create',
        'as' => 'products.create',
        //'middleware' => ['acl:accounting_write']	
    ]);
    
    Route::post('/product/store', [
        'uses' => 'ProductsController@store',
        'as' => 'products.store',
        //'middleware' => ['acl:accounting_write']	
    ]);
    
     /*
     * for invoice section
     */
    Route::get('/products/generateInvoice', [
        'uses' => 'ProductsController@generateInvoice',
        'as' => 'products.generateInvoice',
        //'middleware' => ['acl:save_categories']	
    ]);

    /*
     * for sending email with invoice
     */ 
    Route::get('/products/emailInvoice/{invoice_id}', [
        'uses' => 'ProductsController@emailInvoice',
        'as' => 'products.emailInvoice',
        //'middleware' => ['acl:save_categories']	
    ]);
    
    /*
     * for payment after checkout
     */ 
    Route::get('/products/paymentForm/', [
        'uses' => 'ProductsController@paymentForm',
        'as' => 'products.paymentForm',
        //'middleware' => ['acl:save_categories']	
    ]);
	
    Route::get('/categories/addcategories', [
        'uses' => 'CategoriesController@addcategories',
        'as' => 'categories.addcategories',
        //'middleware' => ['acl:add_categories']	
    ]);	

    Route::post('/categories/saveCategories', [
        'uses' => 'CategoriesController@saveCategories',
        'as' => 'categories.savecategories',
        //'middleware' => ['acl:save_categories']   
    ]);

    Route::get('pdf/{invoice_id}', function($invoice_id) {
        $item = [
            //'middleware' => ['acl:save_products']
            'items' => App\Products::all(),
            'bag' => App\CartItem::where('invoice_id', $invoice_id)->first()
        ];
        
        return PDF::loadView('invoice.pdf', $factory)->stream();
    });
    
    /*
     * Route for AccountingController in Accounting Module
     */ 
    Route::get('/accounting/dailySalesReport', [
        'uses' => 'AccountingController@dailySalesReport',
        'as' => 'accounting.dailySalesReport',
        'middleware' => ['acl:accounting_read']	
    ]);
    
    Route::get('/accounting/weeklySalesReport', [
        'uses' => 'AccountingController@weeklySalesReport',
        'as' => 'accounting.weeklySalesReport',
        'middleware' => ['acl:accounting_read']	
    ]);
    
    Route::get('/accounting/monthlySalesReport', [
        'uses' => 'AccountingController@monthlySalesReport',
        'as' => 'accounting.monthlySalesReport',
        'middleware' => ['acl:accounting_read']	
    ]);
    
    Route::get('/accounting/yearlySalesReport', [
        'uses' => 'AccountingController@yearlySalesReport',
        'as' => 'accounting.yearlySalesReport',
        'middleware' => ['acl:accounting_read']	
    ]);
    
    Route::get('/accounting/destroy/{id}', [
        'uses' => 'AccountingController@destroy',
        'as' => 'accounting.destroy',
        'middleware' => ['acl:accounting_write']	
    ]);
    
    Route::get('/accounting/show/{id}', [
        'uses' => 'AccountingController@show',
        'as' => 'accounting.show',
        'middleware' => ['acl:accounting_read']	
    ]);
    
    Route::get('/accounting/create', [
        'uses' => 'AccountingController@create',
        'as' => 'accounting.create',
        'middleware' => ['acl:accounting_write']	
    ]);
    
    Route::post('/accounting/store', [
        'uses' => 'AccountingController@store',
        'as' => 'accounting.store',
        //'middleware' => ['acl:accounting_write']	
    ]);
    
    Route::get('/accounting/listCashLogs', [
        'uses' => 'AccountingController@listCashLogs',
        'as' => 'accounting.listCashLogs',
        //'middleware' => ['acl:accounting_write']	
    ]);
    
    /*
     * Adding duplicate Menu Items into ApptSetting
     */
    Route::get('/appointmentApptSetting/followup', [
       'uses' => 'AppointmentController@followup',
       'as' => 'appointment.followup',
       'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::get('/appointmentApptSetting/upcomingappointments', [
        'uses' => 'AppointmentController@upcomingappointments',
        'as' => 'appointment.upcomingappointments',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::get('/appointmentApptSetting/todayVisits', [
        'uses' => 'AppointmentController@todayVisits',
        'as' => 'appointment.todayVisits',
        'middleware' => ['acl:appointment_setting_read']
    ]);
    
    Route::get('/appointmentApptSetting/labAppointments', [
        'uses' => 'AppointmentController@labAppointments',
        'as' => 'appointment.labAppointments',
        'middleware' => ['acl:appointment_setting_read']
    ]);
               
    Route::get('/appointmentApptSetting/appointmentAfterReport', [
        'uses' => 'AppointmentController@appointmentAfterReport',
        'as' => 'appointment.appointmentAfterReport',
        'middleware' => ['acl:appointment_write']
    ]);
             
    Route::get('/appointmentApptSetting/labReadyAppointments', [
        'uses' => 'AppointmentController@labReadyAppointments',
        'as' => 'appointment.labReadyAppointments',
        'middleware' => ['acl:appointment_read']
    ]);
             
    /*
     * To show the patient Inventory details
     */
    Route::get('/inventory/patientInventory', [
        'uses' => 'InventoryController@patientInventory',
        'as' => 'inventory.patientInventory',
        'middleware' => ['acl:patient_inventory_read']
    ]);
           
    /*
     * To show the patient Doses details
     */
    Route::get('/doses/doseManagement', [
        'uses' => 'DoseManagmentController@index',
        'as' => 'doses.doseManagement',
        //'middleware' => ['acl:doseManagement_read']
    ]);
          
    Route::post('/doseManagement/getPatientDetails/{patient_id}', [
        'uses' => 'DoseManagmentController@getPatientDetails',
        'as' => 'doses.doseManagement',
       //'middleware' => ['acl:doseManagement_read']
          
    ]);
    
    Route::post('/doses/store', [
       'uses' => 'DoseManagmentController@store',
        'as' => 'doses.doseManagement',
        //'middleware' => ['acl.doseManagement_read']
    ]);

    Route::get('/document/baseurl', [     //    remove this if document base url is not used
       'uses' => 'Dcoumentsign@baseurl',
        'as' => 'Dcoumentsign.baseurl',
        //'middleware' => ['acl.doseManagement_read']
    ]);

    Route::get('/apptsetting/pdfList', function() {
        return view('apptsetting.pdf_list');
    });

     /*
     * To save feedback of the patient Doses details
     */
 
    Route::post('/doses/storeFeedback', [
       'uses' => 'DoseManagmentController@storeFeedback',
        'as' => 'doses.doseManagement',
        //'middleware' => ['acl.doseManagement_read']
    ]);
});
