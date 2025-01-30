<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Routing untuk Admin
$route['admin'] = 'admin/dashboard';
$route['admin/users'] = 'admin/users';
$route['admin/add_user'] = 'admin/add_user';
$route['admin/save_user'] = 'admin/save_user';
$route['admin/edit_user/(:num)'] = 'admin/edit_user/$1';
$route['admin/update_user/(:num)'] = 'admin/update_user/$1';
$route['admin/delete_user/(:num)'] = 'admin/delete_user/$1';
$route['admin/dashboard'] = 'dashboard/index';

// Routing untuk Pasien
$route['admin/patients'] = 'admin/patients';
// $route['admin/add_patient'] = 'admin/add_patient';
$route['admin/save_patient'] = 'admin/save_patient';
$route['admin/edit_patient/(:num)'] = 'admin/edit_patient/$1';
$route['admin/update_patient/(:num)'] = 'admin/update_patient/$1';
$route['admin/delete_patient/(:num)'] = 'admin/delete_patient/$1';
$route['admin/register_patient'] = 'admin/register_patient';


// Routing untuk Dokter
$route['doctor'] = 'doctor/dashboard';
$route['doctor/records'] = 'doctor/records';
$route['doctor/add_record'] = 'doctor/add_record';
$route['doctor/save_record'] = 'doctor/save_record';
$route['doctor/edit_record/(:num)'] = 'doctor/edit_record/$1';
$route['doctor/delete_record/(:num)'] = 'doctor/delete_record/$1';
$route['doctor/update_record/(:num)'] = 'doctor/update_record/$1';
$route['doctor/dashboard'] = 'doctor_dashboard/index';
$route['doctor/edit_record/(:num)'] = 'doctor/edit_record/$1';


$route['icd/search'] = 'ICD_API/search_icd';

$route['icd/search_icd'] = 'ICD_API/search_icd';
$route['icd/get_access_token'] = 'ICD_API/get_access_token';




