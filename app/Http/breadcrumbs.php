<?php

// Home / My Profile
Breadcrumbs::register('homes.user_profile', function ($breadcrumbs) {
    $breadcrumbs->push('My Profile', route('homes.user_profile'));
});

// Home / Edit Profile
Breadcrumbs::register('homes.edit_user_profile', function ($breadcrumbs, $id) {
    $breadcrumbs->push('Edit Profile', route('homes.edit_user_profile', $id));
});

// Home / Appointment / Missed Call List
Breadcrumbs::register('apptsetting.missedCall', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Missed Call List', route('apptsetting.missedCall'));
});

// Home / Appointment / Create Appointment
Breadcrumbs::register('apptsetting.index', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Create Appointment', route('apptsetting.index'));
});

// Home / Appointment / Create Appointment
Breadcrumbs::register('apptsetting.marketingCall', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Create Appointment', route('apptsetting.marketingCall'));
});

// Home / Appointment / Web Leads
Breadcrumbs::register('apptsetting.webLead', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Web Leads', route('apptsetting.webLead'));
});

// Home / Appointment / Request Follow-up
Breadcrumbs::register('apptsetting.requestFollowUp', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Request Follow-up', route('apptsetting.requestFollowUp'));
});

// Home / Appt. Settings / Appointments / Add New Appointment
Breadcrumbs::register('appointment.newAppointment', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Appointments / Add New Appointment', route('appointment.newAppointment'));
});

// Home / Appointment / List Appointments
Breadcrumbs::register('appointment.listappointment', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / List Appointments', route('appointment.listappointment'));
});

// Home / Appointment / List Appointments / Patient Medical History
Breadcrumbs::register('appointment.patientMedical', function ($breadcrumbs, $patient) {
    $breadcrumbs->push(
        'Appointment / List Appointments / Patient Medical History',
        route('appointment.patientMedical', $patient->id)
    );
});

// Home / Appointment / View Appointments
Breadcrumbs::register('appointment.viewappointment', function ($breadcrumbs) {
    $breadcrumbs->push(
        'Appointment / View Appointments',
        route('appointment.viewappointment')
    );
});

// Home / Appointment / Follow-up Appointments
Breadcrumbs::register('appointment.followup', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Follow-up Appointments', route('appointment.followup'));
});

// Home / Appointment / Upcoming Appointments / View Upcoming
Breadcrumbs::register('appointment.viewFollowup', function ($breadcrumbs, $followup) {
    $breadcrumbs->push(
        'Appointment / Upcoming Appointments / View Upcoming',
        route('appointment.viewFollowup', $followup->id)
    );
});

// Home / Appointment / Upcoming Appointments
Breadcrumbs::register('appointment.upcomingappointments', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Upcoming Appointments', route('appointment.upcomingappointments'));
});

// Home / Appointment / Today Visit
Breadcrumbs::register('appointment.todayVisits', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Today Visit', route('appointment.todayVisits'));
});

// Home / Appointment / Lab Appointments
Breadcrumbs::register('appointment.labAppointments', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Lab Appointments', route('appointment.labAppointments'));
});

// Home / Appointment / Lab Ready Reports
Breadcrumbs::register('appointment.labReadyAppointments', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Lab Ready Reports', route('appointment.labReadyAppointments'));
});

// Home / Appointment / Appointment After Report
Breadcrumbs::register('appointment.appointmentAfterReport', function ($breadcrumbs) {
    $breadcrumbs->push('Appointment / Appointment After Report', route('appointment.appointmentAfterReport'));
});

// Home / Front Office / Create Appointment
Breadcrumbs::register('frontoffice.index', function ($breadcrumbs) {
    $breadcrumbs->push('Front Office / Create Appointment', route('frontoffice.index'));
});

// Home / Appt. Settings / Appointment / Follow-Up Appintments
Breadcrumbs::register('frontfollowup.followup', function ($breadcrumbs) {
    $breadcrumbs->push('Front Office / Appointment / Follow-Up Appintments ', route('frontfollowup.followup'));
});

// Home / Front Office /  Appointmebnt / Upcoming Appointment
Breadcrumbs::register('frontupcoming.upcomingappointments', function ($breadcrumbs) {
    $breadcrumbs->push('Front Office / Appointment / Upcoming Appointment', route('frontupcoming.upcomingappointments'));
});

// Home / Front Office / Appointment / Today Visits
Breadcrumbs::register('fronttodayvisit.todayVisits', function ($breadcrumbs) {
    $breadcrumbs->push('Front Office / Appointment / Today Visits', route('fronttodayvisit.todayVisits'));
});

// Home / Front Office / Appointment / Lab Appointments
Breadcrumbs::register('frontlabappt.labAppointments', function ($breadcrumbs) {
    $breadcrumbs->push('Front Office / Appointment / Lab Appointments', route('frontlabappt.labAppointments'));
});

// Home / Front Office / Appointment / Lab Ready Reports
Breadcrumbs::register('frontlabreadyreport.labReadyAppointments', function ($breadcrumbs) {
    $breadcrumbs->push('Front Office / Appointment / Lab Ready Reports', route('frontlabreadyreport.labReadyAppointments'));
});

// Home / Front Office / Appointment / Appointment After Report
Breadcrumbs::register('frontapptafterreport.appointmentAfterReport', function ($breadcrumbs) {
    $breadcrumbs->push('Front Office / Appointment / Appointment After Report', route('frontapptafterreport.appointmentAfterReport'));
});

// Home / Front Office / Patients List
Breadcrumbs::register('patient', function ($breadcrumbs) {
    $breadcrumbs->push('Front Office / Patients List', route('patient'));
});

// Home / Front Office / View Patient
Breadcrumbs::register('patient.view', function ($breadcrumbs, $patient) {
    $breadcrumbs->push('Front Office / View Patient', route('patient.view', $patient->id));
});

// Home / Front Office / Edit Patient
Breadcrumbs::register('patient.edit', function ($breadcrumbs, $patient) {
    $breadcrumbs->push('Front Office / Edit Patient', route('patient.edit', $patient->id));
});

// Home / Front Office / Form
Breadcrumbs::register('frontpdfform.pdf_list', function ($breadcrumbs) {
    $breadcrumbs->push('Front Office / Form', route('frontpdfform.pdf_list'));
});

// Home / Sale / Front Office Sale
Breadcrumbs::register('sale.index', function ($breadcrumbs) {
    $breadcrumbs->push('Sale / Front Office Sale', route('sale.index'));
});

// Home / User Management / Add New User
Breadcrumbs::register('user.addUser', function ($breadcrumbs) {
    $breadcrumbs->push('User Management / Add New User', route('user.addUser'));
});

// Home / User Management / Users
Breadcrumbs::register('user.listUsers', function ($breadcrumbs) {
    $breadcrumbs->push('User Management / Users', route('user.listUsers'));
});

// Home / User Management / Edit User
Breadcrumbs::register('user.editUser', function ($breadcrumbs, $id) {
    $breadcrumbs->push('User Management / Edit User', route('user.editUser', $id));
});

// Home / User Management / View User
Breadcrumbs::register('user.viewUser', function ($breadcrumbs, $id) {
    $breadcrumbs->push('User Management / View User', route('user.viewUser', $id));
});

// Home / User Management / Add New Doctor
Breadcrumbs::register('doctor.addDoctor', function ($breadcrumbs) {
    $breadcrumbs->push('User Management / Add New Doctor', route('doctor.addDoctor'));
});

// Home / User Management / Doctors
Breadcrumbs::register('doctor', function ($breadcrumbs) {
    $breadcrumbs->push('User Management / Doctors', route('doctor'));
});

// Home / User Management / Edit Doctor
Breadcrumbs::register('doctor.edit', function ($breadcrumbs, $doctor) {
    $breadcrumbs->push('User Management / Edit Doctor', route('doctor.edit', $doctor->id));
});

// Home / User Management / View Doctor
Breadcrumbs::register('doctor.view', function ($breadcrumbs, $doctor) {
    $breadcrumbs->push('User Management / View Doctor', route('doctor.view', $doctor->id));
});

// Home / User Management / ACL / Roles
Breadcrumbs::register('acl.listRole', function ($breadcrumbs) {
    $breadcrumbs->push('User Management / ACL / Roles', route('acl.listRole'));
});
        
// Home / User Management / ACL / Add New Role
Breadcrumbs::register('acl.addRole', function ($breadcrumbs) {
    $breadcrumbs->push('User Management / ACL / Add New Role', route('acl.addRole'));
});

// Home / User Management / ACL / Edit Role
Breadcrumbs::register('acl.editRole', function ($breadcrumbs, $role) {
    $breadcrumbs->push('User Management / ACL / Edit Role', route('acl.editRole', $role->id));
});

// Home / User Management / ACL / Permission Setting
Breadcrumbs::register('acl.listPermission', function ($breadcrumbs, $roleId) {
    $breadcrumbs->push('User Management / ACL / Permission Setting', route('acl.listPermission', $roleId));
});

// Home / Product Categories / Add New Category
Breadcrumbs::register('categories.addNewCategory', function ($breadcrumbs) {
    $breadcrumbs->push('Product Categories / Add New Category', route('categories.addNewCategory'));
});

// Home / Product Categories / Categories List
Breadcrumbs::register('categories.listCategories', function ($breadcrumbs) {
    $breadcrumbs->push('Product Categories / Categories', route('categories.listCategories'));
});

// Home / Product Categories / Package Details
Breadcrumbs::register('categories.categoryDetails', function ($breadcrumbs, $id) {
    $breadcrumbs->push('Product Categories / Product List', route('categories.categoryDetails', $id));
});

// Home / Product Categories / Imports Product
Breadcrumbs::register('categories.addcategories', function ($breadcrumbs) {
    $breadcrumbs->push('Product Categories / Imports Product', route('categories.addcategories'));
});

// Home / Accounting / Sales Reports / Daily Sales
Breadcrumbs::register('accounting.dailySalesReport', function ($breadcrumbs) {
    $breadcrumbs->push('Accounting / Sales Reports / Daily Sales', route('accounting.dailySalesReport'));
});

// Home / Accounting / Sales Reports / Weekly Sales
Breadcrumbs::register('accounting.weeklySalesReport', function ($breadcrumbs) {
    $breadcrumbs->push('Accounting / Sales Reports / Weekly Sales', route('accounting.weeklySalesReport'));
});

// Home / Accounting / Sales Reports / Monthly Sales
Breadcrumbs::register('accounting.monthlySalesReport', function ($breadcrumbs) {
    $breadcrumbs->push('Accounting / Sales Reports / Monthly Sales', route('accounting.monthlySalesReport'));
});

// Home / Accounting / Sales Reports / Yearly Sales
Breadcrumbs::register('accounting.yearlySalesReport', function ($breadcrumbs) {
    $breadcrumbs->push('Accounting / Sales Reports / Yearly Sales', route('accounting.yearlySalesReport'));
});

// Home / Accounting / Sales Reports / Order Details
Breadcrumbs::register('accounting.show', function ($breadcrumbs, $id) {
    $breadcrumbs->push('Accounting / Sales Reports / Order Details', route('accounting.show', $id));
});

// Home / Accounting / Petty Cash Log / Cash Voucher Form
Breadcrumbs::register('accounting.create', function ($breadcrumbs) {
    $breadcrumbs->push('Accounting / Petty Cash Log / Cash Voucher Form', route('accounting.create'));
});

// Home / Accounting / Petty Cash Log / Cash Log Lists
Breadcrumbs::register('accounting.listCashLogs', function ($breadcrumbs) {
    $breadcrumbs->push('Accounting / Petty Cash Log / Cash Log Lists', route('accounting.listCashLogs'));
});

// Home / Inventory / Inventory Imports
Breadcrumbs::register('products.create', function ($breadcrumbs) {
    $breadcrumbs->push('Inventory / Inventory Imports', route('products.create'));
});

// Home / Inventory / Product Inventory
Breadcrumbs::register('products.showInventory', function ($breadcrumbs) {
    $breadcrumbs->push('Inventory / Product Inventory', route('products.showInventory'));
});

// Home / Dose Management / Manage Dose
Breadcrumbs::register('doses.doseManagement', function ($breadcrumbs) {
    $breadcrumbs->push('Dose Management / Manage Dose', route('doses.doseManagement'));
});

// Home / API Integration
Breadcrumbs::register('api.setting', function ($breadcrumbs) {
    $breadcrumbs->push('API Integration', route('api.setting'));
});