<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'MainePageController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['categories/create'] = 'CategoryController/create';
$route['shoppingItems/create'] = 'ShoppingItemController/create';