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
//$route['invoice'] = "invoice/index";
$route['orders'] = "invoice/index";
$route['orders/(:num)'] = "invoice/index";

//$route['invoice'] = "invoice/index";
$route['invoice/save'] = "invoice/saveInvoice";
$route['invoice/construct-invoice'] = "invoice/constructInvoice";
$route['invoice/details/(:num)'] = "invoice/invoiceDetails";

$route['company'] = "company/index";
$route['company/(:num)'] = "company/index";
$route['company/add'] = "company/add";
$route['company/edit/(:num)'] = "company/edit";

$route['users'] = "user/index";
$route['users/(:num)'] = "user/index";
$route['users/add'] = "user/add";
$route['users/edit/(:num)'] = "user/edit";
$route['users/change-password/(:num)'] = "user/change_password";
$route['users/companies/user/(:num)'] = "user/company";
$route['users/company/delete/(:num)/(:num)'] = "user/delete_company";
$route['users/companies/add/(:num)'] = "user/add_company";

$route['product'] = "product/index";
$route['product/(:num)'] = "product/index";
$route['product/add'] = "product/add";
$route['product/edit/(:num)'] = "product/edit";
$route['product/quantity/(:num)'] = "product/add_quantity";



$route['login'] = "auth";
$route['logout'] = "auth/logout";
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
