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

#TOKEN
$routes->get('client', 'ClientController::index');
$routes->post('auth',   'AuthController::login');

#API's
/* ============================================
    START APIS USERS
=============================================== */
$routes->post('api/login',              'Api\AuthController::login');
$routes->post('api/createUser',         'Api\UsersController::createUser');
$routes->get('api/listAllUsers',        'Api\UsersController::listAllUsers');
$routes->get('api/showUser/(:num)',     'Api\UsersController::showUser/$1');
$routes->post('api/updateUser/(:num)',  'Api\UsersController::updateUser/$1');
$routes->delete('api/deleteUser/(:num)','Api\UsersController::deleteUser/$1');
/* ============================================
    END APIS USERS
=============================================== */


/* ============================================
    START APIS CATEGORIES
=============================================== */
$routes->get('api/listAllCategories',       'Api\CategoriesController::listAllCategories');
$routes->get('api/showCategory/(:num)',     'Api\CategoriesController::showCategory/$1');
$routes->post('api/createCategory',         'Api\CategoriesController::createCategory');
$routes->post('api/createCategoryMany',     'Api\CategoriesController::createCategoryMany');
$routes->post('api/updateCategory/(:num)',  'Api\CategoriesController::updateCategory/$1');
$routes->delete('api/deleteCategory/(:num)','Api\CategoriesController::deleteCategory/$1');
$routes->post('api/saveCategoryImage',      'Api\CategoriesController::saveCategoryImage');



/* ============================================
    START APIS SUBCATEGORIES
=============================================== */
$routes->get('api/listAllSubCategories',        'Api\SubCategoriesController::listAll');
$routes->get('api/showSubCategories/(:num)',    'Api\SubCategoriesController::show/$1');
$routes->post('api/createSubCategory',          'Api\SubCategoriesController::create');
