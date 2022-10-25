<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['logout'] = 'login/logout';


$route['attendance/(:any)'] = 'attendance/index/$1';
$route['newpassword'] = 'login/changepassword';
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
