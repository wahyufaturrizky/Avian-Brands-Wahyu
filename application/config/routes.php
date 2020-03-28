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
// $route['default_controller'] = 'index';
$route['default_controller']                                              = 'new_index/index/';

//========================================== Front end web Routes ========================================================//

$route['404_override']                                                    = 'error';
$route['translate_uri_dashes']                                            = TRUE;

$route['logout']                                                          = "index/index/logout";
$route['beasiswajuara']                                                   = "index/beasiswajuara";

$route['avianbrand-mobileapp']                                            = "index/avianbrand_mobileapp";

$route['store/find/(:any)']                                               = 'store/store/index/$1';
$route['csr']                                                             = 'csr/index';
$route['csr/get-data']                                                    = 'csr/get-data';
$route['csr/(:any)']                                                      = 'csr/detail/$1';
$route['article/detail/csr/(:any)']                                       = 'article/detail/$1';
$route['manager']                                                         = "dashboard/dashboard_manager/index";
$route['manager/login']                                                   = "index/index_manager/login";
$route['manager/logout']                                                  = "index/index_manager/logout";
$route['manager/forgot-password']                                         = "index/index_manager/forgot-password";
$route['manager/reset-password/(:any)']                                   = "index/index_manager/reset-password/$1";
$route['manager/([a-zA-Z_-]+)/([a-zA-Z_-]+)/([a-zA-Z_-]+)/([a-zA-Z_-]+)'] = '$1/$2_manager/$3/$4';
$route['manager/([a-zA-Z_-]+)/([a-zA-Z_-]+)/([a-zA-Z_-]+)/(:any)']        = '$1/$2_manager/$3/$4';
$route['manager/([a-zA-Z_-]+)/([a-zA-Z_-]+)/([a-zA-Z_-]+)']               = '$1/$2_manager/$3';
$route['manager/([a-zA-Z_-]+)/(:any)/(:any)']                             = '$1/$1_manager/$2/$3';
$route['manager/([a-zA-Z_-]+)/(:any)']                                    = '$1/$1_manager/$2';
$route['manager/([a-zA-Z_-]+)']                                           = '$1/$1_manager/index';

//======================================= Front end web Routes ===========================================================//

$route['history']                =  'new_sejarah/Sejarah/index';
$route['vision']                 =  'new_vision/Vision/index';
$route['award']                  =  'new_award/Award/index';
$route['news']              	 =  'new_article/Article/index';
$route['articles']               =  'new_article/Article/artikel';
$route['pers']              	 =  'new_article/Article/artikel';
$route['karir']                  =  'new_career/Careers/index/avian';
$route['karir/detail/(:num)']    =  'new_career/Careers/detail/$1';
$route['karir/avian']            =  'new_career/Careers/index/avian';
$route['karir/tirta']            =  'new_career/Careers/index/tirta';
$route['color']                  =  'new_color/Color/index';
$route['color/detail']           =  'new_color/Color/detail';
$route['avian_tower']            =  'new_avian_tower/Avian_tower/index';
$route['aic']                    =  'new_aic/Aic/index';
$route['products']               =  'new_product/Product/index';
$route['products/detail/(:any)'] =  'new_product/Product/listdetail/$1';
$route['products/items/(:any)']  =  'new_product/Product/itemdetail/$1';
$route['shop'] 					 =  'new_shop/Store/index';
$route['branch'] 				 =  'new_shop/Store/cabang';
$route['peduli'] 				 =  'new_csr/Csr/index';
$route['test_php'] 				 =  'new_shop/Store/test_php';

