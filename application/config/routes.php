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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['Tentang-kami'] = 'tentang_kami';
$route['Pencarian-cepat'] = 'pencarian/pencarian_cepat';
$route['Pencarian-detail'] = 'pencarian/pencarian_detail';
$route['pencarian-cepat-error'] = 'pencarian/pencarian_cepat_error';
$route['pencarian-detail-error'] = 'pencarian/pencarian_detail_error';
$route['agenda/detail'] = 'agenda';
$route['berita/detail'] = 'berita';
$route['berita/detail/(:any)'] = 'berita/detail/$1';
$route['agenda/detail/(:any)'] = 'agenda/detail/$1';
$route['Kontak-kami'] = 'kontak_kami';
$route['produk_hukum'] = 'home';
$route['Pencarian-produk-hukum/(:any)/(:any)'] = 'pencarian/pencarian_jenis_produk/$1/$2';
$route['Pencarian-Unit-Organisasi/(:any)'] = 'pencarian/pencarian_unor/$1';
$route['Pencarian-Unit-Substansi/(:any)'] = 'pencarian/pencarian_substansi/$1';
$route['pencarian/create_json_detail/(:any)']='home';
$route['pencarian/create_json_detail/(:any)/(:any)']='home';
$route['pencarian/create_json_detail/(:any)/(:any)/(:any)']='home';
$route['pencarian/create_json_detail/(:any)/(:any)/(:any)/(:any)']='home';
$route['pencarian/create_json_detail/(:any)/(:any)/(:any)/(:any)/(:any)']='home';
$route['pencarian/create_json_detail/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']='home';
$route['pencarian/create_json_detail/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']='home';
$route['pencarian/create_json_detail/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']='pencarian/create_json_detail/$1/$2/$3/$4/$5/$6/$7/$8';
$route['NoFile'] = 'NoFile/index/abstrak';
$route['NoFile/(:any)'] = 'NoFile/index/abstrak';

$route['detail-dokumen/(:any)/(:any)'] = 'produk_hukum/detail/$1/$2';

//$route['default_controller'] = 'pages/view';
//$route['(:any)'] = 'pages/view/$1';

$route['translate_uri_dashes'] = FALSE;
