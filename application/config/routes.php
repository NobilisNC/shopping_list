<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

$route['API/start/(:num)'] = 'API_smartphone/useList/$1';
$route['API/stop/(:num)'] = 'API_smartphone/stopList/$1';
$route['API/info/(:num)'] = 'API_smartphone/getList/$1';
$route['API/list/(:num)/check/(:num)'] = 'API_smartphone/checkProduct/$1/$2';
$route['API/list/(:num)/uncheck/(:num)'] = 'API_smartphone/uncheckProduct/$1/$2';
$route['API/list/(:num)/sortWeight'] = 'API_smartphone/sortWeight/$1';
$route['API/list/(:num)/sortColdness'] = 'API_smartphone/sortColdness/$1';
$route['API/list/(:num)/sortShop/(:num)'] = 'API_smartphone/sortShop/$1/$2';
$route['API/list/all'] = 'API_smartphone/all_lists';
$route['API/shop/all'] = 'API_smartphone/all_shops';

$route['useList/show/(:num)'] = 'useList/showUseList/$1';
$route['useList/(:num)/add/(:num)/amount/(:num)'] = 'useList/addProduct/$1/$2/$3';

$route['admin/product'] = 'Admin/product_index';
$route['admin/product/deleteProduct/(:num)'] = 'Admin/deleteProduct/$1';
$route['admin/product/get'] = 'Admin/getProduct';
$route['admin/product/(:num)/title'] = 'Admin/updateProductName/$1';
$route['admin/product/(:num)/coldness'] = 'Admin/updateProductColdness/$1';
$route['admin/product/(:num)/weight'] = 'Admin/updateProductWeight/$1';
$route['admin/shop'] = 'Admin/shop_index';
$route['admin/shop/delete/(:num)'] = 'Admin/deleteShop/$1';
$route['admin/shop/addShop'] = 'Admin/addShop';
$route['admin/shop/(:num)/name'] = 'Admin/updateShopName/$1';
$route['admin/shop/(:num)/location'] = 'Admin/updateShopLocation/$1';
$route['admin/users'] = 'Admin/user_management_index';
$route['admin/users/rankup/(:num)'] = 'Admin/switchUserRank/$1';
$route['admin/users/rankdown/(:num)'] = 'Admin/switchUserRank/$1';
$route['admin/users/delete/(:num)'] = 'Admin/deleteUser/$1';

$route['admin/users/(:num)/login'] = 'Admin/updateUserLogin/$1';
$route['admin/shop/show/(:num)'] = 'ShopList/show/$1';
$route['admin/shop/(:num)/addProduct/(:num)'] = 'ShopList/addProduct/$1/$2';
$route['admin/shop/(:num)/deleteProduct/(:num)'] = 'ShopList/deleteProduct/$1/$2';


$route['home/shops'] = 'ShopList/index';
$route['home/shops/create'] = 'ShopList/createShop';
$route['home/shops/deleteFromMyShops/(:num)'] = 'ShopList/deleteFromMyShops/$1';
$route['home/shops/get'] = 'ShopList/getShops';
$route['home/shops/addToMyShops'] = 'ShopList/addToMyShops';
$route['home/index'] = 'Home/index';


$route['home/list/(:num)/note'] = 'ShoppingList/updateNote/$1';
$route['home/list/(:num)/product/(:num)/amount/(:num)'] = 'ShoppingList/updateAmount/$1/$2/$3';
$route['home/list/(:num)/deleteProduct/(:num)'] = 'ShoppingList/deleteProduct/$1/$2';
$route['home/list/(:num)/addProduct/(:num)'] = 'ShoppingList/addProduct/$1/$2';

$route['product/get/(.+)'] = 'ShoppingList/getProductsLike/$1';

$route['home/list/(:num)/title'] = 'ShoppingList/updateTitle/$1';
$route['home/list/show/(:num)'] = 'ShoppingList/showList/$1';
$route['home/list/delete/(:num)'] = 'ShoppingList/deleteList/$1';
$route['home/list/create'] = 'ShoppingList/createList';
$route['home/list'] = 'ShoppingList/index';

$route['home/sort'] = 'Sort/index';
$route['home/sort/show/(:num)'] = 'Sort/showListSort/$1';
$route['home/sort/sortWeight/(:num)'] = 'Sort/sortWeight/$1';
$route['home/sort/sortColdness/(:num)'] = 'Sort/sortColdness/$1';

$route['home/'] = 'home/index';
$route['accueil/'] = 'accueil/index';

$route['(:any)'] = 'accueil/index';
$route['default_controller'] = 'accueil';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
