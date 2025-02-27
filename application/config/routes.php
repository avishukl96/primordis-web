<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['fileupload'] = 'FileUploadController/index';
$route['fileupload/upload'] = 'FileUploadController/upload';
$route['fileupload/delete/(:num)'] = 'FileUploadController/delete/$1';

//Data Processor

$route['dataprocessor/faq'] = 'DataProcessorController/faq';
$route['dataprocessor'] = 'DataProcessorController/index';
$route['dataprocessor/save_data'] = 'DataProcessorController/save_data';
$route['dataprocessor/generate_report/(:num)'] = 'DataProcessorController/generate_report/$1';
$route['dataprocessor/load_model/'] = 'DataProcessorController/load_model/';
$route['dataprocessor/upload_data/(:num)'] = 'DataProcessorController/upload_data/$1';
$route['dataprocessor/delete/(:num)'] = 'DataProcessorController/delete/$1';
$route['dataprocessor/generate_report_plots/(:num)'] = 'DataProcessorController/generate_report_plots/$1';
$route['dataprocessor/generate_report_plots/(:num)(/:num)?'] = 'DataProcessorController/generate_report_plots/$1/$2';



// Admin Part
$route['admin/login'] = 'cp/admin/login';
$route['cp/admin/dashboard'] = 'cp/admin/dashboard';
$route['cp/admin/logout'] = 'cp/admin/logout';
$route['cp/admin/pending_users'] = 'cp/admin/pending_users';
$route['cp/admin/index/approve/'] = 'cp/admin/index/$1';
$route['cp/admin/reject/(:num)'] = 'cp/admin/reject/$1';







