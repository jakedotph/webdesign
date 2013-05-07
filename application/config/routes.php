<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login";
$route['404_override'] = '';
$route["login"] = "login/login_main";
$route["login/validate"] = "login/login_user";
$route["register"] = "login/register_user/register";
$route["registration"] = "login/register_user";
$route["login/relogin"] = "login/login_user/session_expired";
$route["login/retry"] = "login/login_user/authentication_failed";
$route["login/notify"] = "login/login_user/notify_activation";
$route["designer"] = "main/main";
$route["designer/home"] = "main/main";
$route["designer/logout"] = "main/main/logout";
$route["designer/gallery"] = "main/main/load_gallery";
$route["designer/request"] = "main/main/load_request";
$route["designer/upload"] = "main/main/gallery_upload";
$route["designer/modifyimage"] = "main/main/modify_image";
$route["designer/deleteimage"] = "main/main/delete_image";
$route["logout"] = "login/logout";

/* End of file routes.php */
/* Location: ./application/config/routes.php */