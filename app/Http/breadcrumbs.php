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

// Home / Appt. Settings / Appointments Followup List
Breadcrumbs::register('appointment.followup', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Appointments Followup List', route('appointment.followup'));
});

// Home / Appt. Settings / Appointments Followup List / View Followup
Breadcrumbs::register('appointment.viewFollowup', function ($breadcrumbs, $followup) {
    $breadcrumbs->push(
        'Appt. Settings / Appointments Followup List / View Followup',
        route('appointment.viewFollowup', $followup->id)
    );
});

// Home / Appt. Settings / Appointments Followup List / View Followup
Breadcrumbs::register('appointment.upcomingappointments', function ($breadcrumbs) {
    $breadcrumbs->push('Appt. Settings / Appointments Followup List / View Followup', route('appointment.upcomingappointments'));
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