<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/register',              'CustomersController::register');

$routes->get('/categories',             'CategoriesController::index');
$routes->get('/category/(:segment)',    'CategoriesController::category/$1');

$routes->get('/subcategory/(:segment)', 'SubCategoriesController::index/$1');

$routes->get('/product/(:segment)',     'ProductsController::index/$1');
$routes->post('/colors',                'ProductColorController::colors');
$routes->post('/quantity',              'ProductQuantityColorController::quantity');

$routes->get('/shoppingcart',           'ShoppingCartController::index');

$routes->get('/checkout',               'CheckoutController::index');


#Validate email
$routes->post('/validateEmail',           'CustomersController::validateEmail');
$routes->post('/authenticationCustomer',  'CustomersController::authenticationCustomer');
$routes->post('/createCustomer',          'CustomersController::createCustomer');

#Citys
$routes->post('/city',                    'CityController::city');

#PAYU
$routes->get('/payuconfirmation',          'PayuController::index');