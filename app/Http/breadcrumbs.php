<?php

// Home / Appt. Settings / Create Appointment
Breadcrumbs::register('apptsetting.index', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Create Appointment', route('apptsetting.index'));
});

// Home / Appt. Settings / Create Appointment
Breadcrumbs::register('apptsetting.marketingCall', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Create Appointment', route('apptsetting.marketingCall'));
});

// Home / Appt. Settings / Missed Call List
Breadcrumbs::register('apptsetting.missedCall', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Missed Call List', route('apptsetting.missedCall'));
});

// Home / Appt. Settings / Web Leads
Breadcrumbs::register('apptsetting.webLead', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Web Leads', route('apptsetting.webLead'));
});

// Home / Appt. Settings / Request Follow-up
Breadcrumbs::register('apptsetting.requestFollowUp', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Request Follow-up', route('apptsetting.requestFollowUp'));
});

// Home / Appt. Settings / Appointments / Add New Appointment
Breadcrumbs::register('appointment.newAppointment', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Appointments / Add New Appointment', route('appointment.newAppointment'));
});

// Home / Appt. Settings / Appointments / Appointments List
Breadcrumbs::register('appointment.listappointment', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Appointments / Appointments List', route('appointment.listappointment'));
});

// Home / Appt. Settings / Appointments / Appointments List / Patient Medical History
Breadcrumbs::register('appointment.patientMedical', function ($breadcrumbs, $patient) {
    $breadcrumbs->push(
        'Appt. Settings / Appointments / Appointments List / Patient Medical History',
        route('appointment.patientMedical', $patient->id)
    );
});

// Home / Appt. Settings / Appointments / View Appointments
Breadcrumbs::register('appointment.viewappointment', function ($breadcrumbs) {
    $breadcrumbs->push(
        'Appt. Settings / Appointments / View Appointments',
        route('appointment.viewappointment')
    );
});

// Home / Appt. Settings / Followup Appointments
Breadcrumbs::register('appointment.followup', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Followup Appointments', route('appointment.followup'));
});

// Home / Appt. Settings / Appointments Followup List / View Followup
Breadcrumbs::register('appointment.viewFollowup', function ($breadcrumbs, $followup) {
    $breadcrumbs->push(
        'Appt. Settings / Appointments Followup List / View Followup',
        route('appointment.viewFollowup', $followup->id)
    );
});

// Home / Appt. Settings / Upcoming Appointments
Breadcrumbs::register('appointment.upcomingappointments', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Upcoming Appointments', route('appointment.upcomingappointments'));
});

// Home / Appt. Settings / Today Visit
Breadcrumbs::register('appointment.todayVisits', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Today Visit', route('appointment.todayVisits'));
});

// Home / Appt. Settings / Lab Appointments
Breadcrumbs::register('appointment.labAppointments', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Lab Appointments', route('appointment.labAppointments'));
});

// Home / Appt. Settings / Lab Ready Reports
Breadcrumbs::register('appointment.labReadyAppointments', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Lab Ready Reports', route('appointment.labReadyAppointments'));
});

// Home / Appt. Settings / Appointment After Report
Breadcrumbs::register('appointment.appointmentAfterReport', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Appointment After Report', route('appointment.appointmentAfterReport'));
});

// Home / POS / Patients / Add New Patient
Breadcrumbs::register('patient.addpatient', function ($breadcrumbs) {
    $breadcrumbs->push('POS / Patients / Add New Patient', route('patient.addpatient'));
});

// Home / POS / Patients / Patient Lists
Breadcrumbs::register('patient', function ($breadcrumbs) {
    $breadcrumbs->push('POS / Patients / Patient Lists', route('patient'));
});

// Home / POS / Patients / View Patient
Breadcrumbs::register('patient.view', function ($breadcrumbs, $patient) {
    $breadcrumbs->push('POS / Patients / View Patient', route('patient.view', $patient->id));
});

// Home / POS / Patients / Edit Patient
Breadcrumbs::register('patient.edit', function ($breadcrumbs, $patient) {
    $breadcrumbs->push('POS / Patients / Edit Patient', route('patient.edit', $patient->id));
});

// Home / POS / Doctors / Add New Doctor
Breadcrumbs::register('doctor.addDoctor', function ($breadcrumbs) {
    $breadcrumbs->push('POS / Doctors / Add New Doctor', route('doctor.addDoctor'));
});

// Home / POS / Doctors / Doctors List
Breadcrumbs::register('doctor', function ($breadcrumbs) {
    $breadcrumbs->push('POS / Doctors / Doctors List', route('doctor'));
});

// Home / POS / Doctors / Edit Doctor
Breadcrumbs::register('doctor.edit', function ($breadcrumbs, $doctor) {
    $breadcrumbs->push('POS / Doctors / Edit Doctor', route('doctor.edit', $doctor->id));
});

// Home / POS / Doctors / View Doctor
Breadcrumbs::register('doctor.view', function ($breadcrumbs, $doctor) {
    $breadcrumbs->push('POS / Doctors / View Doctor', route('doctor.view', $doctor->id));
});

// Home / ACL Management / Roles
Breadcrumbs::register('acl.listRole', function ($breadcrumbs) {
    $breadcrumbs->push('ACL Management / Roles', route('acl.listRole'));
});
        
// Home / ACL Management / Add New Role
Breadcrumbs::register('acl.addRole', function ($breadcrumbs) {
    $breadcrumbs->push('ACL Management / Add New Role', route('acl.addRole'));
});

// Home / ACL Management / Edit Role
Breadcrumbs::register('acl.editRole', function ($breadcrumbs, $role) {
    $breadcrumbs->push('ACL Management / Edit Role', route('acl.editRole', $role->id));
});

// Home / ACL Management / Permission Setting
Breadcrumbs::register('acl.listPermission', function ($breadcrumbs, $roleId) {
    $breadcrumbs->push('ACL Management / Permission Setting', route('acl.listPermission', $roleId));
});

// Home / User Management / Add New User
Breadcrumbs::register('user.addUser', function ($breadcrumbs) {
    $breadcrumbs->push('User Management / Add New User', route('user.addUser'));
});

// Home / User Management / Users List
Breadcrumbs::register('user.listUsers', function ($breadcrumbs) {
    $breadcrumbs->push('User Management / Users List', route('user.listUsers'));
});

// Home / User Management / Edit User
Breadcrumbs::register('user.editUser', function ($breadcrumbs, $id) {
    $breadcrumbs->push('User Management / Edit User', route('user.editUser', $id));
});

// Home / User Management / View User
Breadcrumbs::register('user.viewUser', function ($breadcrumbs, $id) {
    $breadcrumbs->push('User Management / View User', route('user.viewUser', $id));
});

// Home / Product Categories / Add New Category
Breadcrumbs::register('categories.addNewCategory', function ($breadcrumbs) {
    $breadcrumbs->push('Product Categories / Add New Category', route('categories.addNewCategory'));
});

// Home / Product Categories / Categories List
Breadcrumbs::register('categories.listCategories', function ($breadcrumbs) {
    $breadcrumbs->push('Product Categories / Categories List', route('categories.listCategories'));
});

// Home / Product Categories / Package Details
Breadcrumbs::register('categories.categoryDetails', function ($breadcrumbs, $id) {
    $breadcrumbs->push('Product Categories / Package Details', route('categories.categoryDetails', $id));
});

// Home / Imports Product
Breadcrumbs::register('categories.addcategories', function ($breadcrumbs) {
    $breadcrumbs->push('Imports Product', route('categories.addcategories'));
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