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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'C_Login';
$route['user-add'] = 'C_User/add';
$route['user'] = 'C_User';
$route['user-edit/(:any)'] = 'C_User/edit/$1';
$route['user-view/(:any)'] = 'C_User/view/$1';
$route['user-konfirm/(:any)'] = 'C_User/konfirm/$1';
$route['Korwil'] = 'C_Korwil';
$route['korwil-add'] = 'C_Korwil/add';
$route['korwil-view/(:any)'] = 'C_Korwil/view/$1';
$route['korwil-edit/(:any)'] = 'C_Korwil/edit/$1';
$route['korwil-p/(:any)'] = 'C_Korwil/pengurus/$1';
$route['korwil-pe/(:any)'] = 'C_Korwil/penguruse/$1';
$route['korwil-ph/(:any)/(:any)'] = 'C_Korwil/pengurush/$1/$2';
$route['pengurus'] = 'C_Pengurus';
$route['pengurus-add'] = 'C_Pengurus/add';
$route['pengurus-view/(:any)'] = 'C_Pengurus/view/$1';
$route['pengurus-edit/(:any)'] = 'C_Pengurus/edit/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;