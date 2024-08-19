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
$routes->get('/register',               'Home::pageRegisterCustomer');

#Validate email
$routes->post('/validateEmail',           'CustomersController::validateEmail');
$routes->post('/authenticationCustomer',  'CustomersController::authenticationCustomer');
$routes->post('/createCustomer',          'CustomersController::createCustomer');
$routes->post('/cerrarSession',           'CustomersController::cerrarSession');
$routes->post('/forgetPasswordCustomer',  'CustomersController::forgetPasswordCustomer');

#WISHES
$routes->get('/wishes',         'WishesController::index');
$routes->get('/shopping',       'ShoppingController::index');
$routes->post('/addWish',       'WishesController::addWish');
$routes->delete('/removeWish',  'WishesController::removeWish');

#Citys
$routes->post('/city',                    'CityController::city');

#PAYU
$routes->get('/response',        'PayuController::response');
$routes->post('/confirmation',   'PayuController::confirmation');

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
    START APIS CATEGORIES
=============================================== */
$routes->get('api/listAllCategories',       'Api\CategoriesController::listAllCategories');
$routes->get('api/showCategory/(:num)',     'Api\CategoriesController::showCategory/$1');
$routes->post('api/createCategory',         'Api\CategoriesController::createCategory');
$routes->post('api/createCategoryMany',     'Api\CategoriesController::createCategoryMany');
$routes->post('api/updateCategory/(:num)',  'Api\CategoriesController::updateCategory/$1');
$routes->delete('api/deleteCategory/(:num)','Api\CategoriesController::deleteCategory/$1');
$routes->post('api/saveCategoryImage',      'Api\CategoriesController::saveCategoryImage');
$routes->get('api/listAllOptionsCategories','Api\CategoriesController::options');


/* ============================================
    START APIS SUBCATEGORIES
=============================================== */
$routes->get('api/listAllSubCategories',        'Api\SubCategoriesController::listAll');
$routes->get('api/showSubCategories/(:num)',    'Api\SubCategoriesController::show/$1');
$routes->post('api/createSubCategory',          'Api\SubCategoriesController::create');
$routes->post('api/createManySubCategory',      'Api\SubCategoriesController::createMany');
$routes->post('api/updateSubCategory/(:num)',   'Api\SubCategoriesController::update/$1');
$routes->delete('api/deleteSubCategory/(:num)', 'Api\SubCategoriesController::delete/$1');
$routes->get('api/listAllOptionsSubCategories/(:num)', 'Api\SubCategoriesController::options/$1');

/* ============================================
    START APIS PRODUCTS
=============================================== */
$routes->post('api/createProduct',          'Api\ProductsController::create');
$routes->post('api/updateProduct/(:num)',   'Api\ProductsController::updateProduct/$1');
$routes->get('api/listAllProduct',          'Api\ProductsController::listAll');
$routes->get('api/showProduct/(:num)',      'Api\ProductsController::show/$1');
$routes->get('api/showColor/(:num)',        'Api\ProductsController::showColor/$1');
$routes->get('api/showQuantity/(:num)',     'Api\ProductsController::showQuantity/$1');
$routes->delete('api/deletesizeproduct/(:num)/(:num)/(:num)', 'Api\ProductsController::deleteSize/$1/$2/$3');
$routes->delete('api/deleteimageproduct/(:num)', 'Api\ProductsController::deleteImage/$1');
$routes->delete('api/deleteproduct/(:num)',        'Api\ProductsController::deleteProduct/$1');


/* ============================================
    SLIDER APIS PRODUCTS
=============================================== */
$routes->get('api/listAllSlider',          'Api\SliderController::listAll');
$routes->get('api/showSlider/(:num)',      'Api\SliderController::show/$1');
$routes->post('api/createSlider',          'Api\SliderController::create');
$routes->post('api/updateSlider/(:num)',   'Api\SliderController::update/$1');
$routes->delete('api/deleteslider/(:num)', 'Api\SliderController::delete/$1');


/* ============================================
    BANNER APIS PRODUCTS
=============================================== */
$routes->get('api/listAllBanner',          'Api\BannerController::listAll');
$routes->get('api/showBanner/(:num)',      'Api\BannerController::show/$1');
$routes->post('api/createBanner',          'Api\BannerController::create');
$routes->post('api/updateBanner/(:num)',   'Api\BannerController::update/$1');
$routes->delete('api/deletebanner/(:num)', 'Api\BannerController::delete/$1');


/* ============================================
    SOCIAL NETWORK APIS
=============================================== */
$routes->get('api/listAllSocialNetwork',          'Api\SocialNetworkController::listAll');
$routes->get('api/showSocialNetwork/(:num)',      'Api\SocialNetworkController::show/$1');
$routes->post('api/createSocialNetwork',          'Api\SocialNetworkController::create');
$routes->post('api/updateSocialNetwork/(:num)',   'Api\SocialNetworkController::update/$1');
$routes->delete('api/deleteSocialNetwork/(:num)', 'Api\SocialNetworkController::delete/$1');


$routes->post('api/email', 'Api\EnqueueEmailController::enqueueEmail');