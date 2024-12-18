<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/register',              'CustomersController::register');

$routes->get('/categories',             'CategoriesController::index');
$routes->get('/category/(:segment)',    'CategoriesController::category/$1');

$routes->get('/subcategory/(:segment)', 'SubCategoriesController::index/$1');

$routes->get('/product/(:segment)',     'ProductsController::showProduct/$1');
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
$routes->post('/addWish',       'WishesController::addWish');
$routes->delete('/removeWish',  'WishesController::removeWish');

#CUSTOMER SHOOPING
$routes->get('/shopping',       'ShoppingController::index');

#CUSTOMER ACCOUNT
$routes->get('/account',        'AccountController::index');
$routes->post('/updateaccount', 'AccountController::updateaccount');
$routes->post('/updatepassword','AccountController::updatepassword');


#RATINGS COMMENTS
$routes->post('/addratingscommet', 'RatingsCommentsController::addRatingsCommet');

#Citys
$routes->post('/city',                    'CityController::city');

#PAYU
$routes->get('/response',        'PayuController::response');
$routes->post('/confirmation',   'PayuController::confirmation');

#ERROR 404
$routes->set404Override(static function () {
    // Instancia del controlador Home
    $homeController = new Home();
    $pageInfo       = $homeController->pageInfo();
    $categories     = $homeController->listCategories();
    $footer         = $homeController->footer();
    $header         = $homeController->header();

    // Datos a pasar a la vista 404
    $data = [
        'pageInfo'      => $pageInfo,
        'categories'    => $categories,
        'header'        => $header,
        'footer'        => $footer,
    ];

    // Carga la vista personalizada 404
    return view('404-page', $data);
});

#FACTURA
$routes->get("factura/(:num)", "FacturaController::index/$1");
$routes->get("/factura/pdf","FacturaController::pdf");

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
$routes->delete('api/deleteImageBannerCategory/(:num)','Api\CategoriesController::deleteImageBannerCategory/$1');
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
    START APIS BRANDS
=============================================== */
$routes->post('api/createBrands',         'Api\BrandsController::create');
$routes->post('api/createManyBrands',     'Api\BrandsController::createMany');
$routes->get('api/listAllBrands',         'Api\BrandsController::listAll');
$routes->get('api/showBrands/(:num)',     'Api\BrandsController::show/$1');
$routes->post('api/updateBrands/(:num)',  'Api\BrandsController::update/$1');
$routes->delete('api/deleteBrands/(:num)','Api\BrandsController::delete/$1');
$routes->get('api/getBrandsByCategory/(:num)/(:num)','Api\BrandsController::getBrandsByCategory/$1/$2');



/* ============================================
    START APIS GENDERS
=============================================== */
$routes->post('api/createGender',         'Api\GendersController::create');
$routes->get('api/listAllGenders',        'Api\GendersController::listAll');
$routes->get('api/showGender/(:num)',     'Api\GendersController::show/$1');
$routes->post('api/updateGender/(:num)',  'Api\GendersController::update/$1');
$routes->delete('api/deleteGender/(:num)','Api\GendersController::delete/$1');
$routes->get('api/getGenderByCategory/(:num)/(:num)','Api\GendersController::getGenderByCategory/$1/$2');

/* ============================================
    START APIS PRODUCTS
=============================================== */
$routes->post('api/createProduct',                          'Api\ProductsController::create');
$routes->post('api/updateProduct/(:num)',                   'Api\ProductsController::updateProduct/$1');
$routes->post('api/updateOnlyProduct/(:num)',               'Api\ProductsController::updateOnlyProduct/$1');
$routes->post('api/updateAddValueattributes/(:num)/(:num)', 'Api\ProductsController::updateAddValueattributes/$1/$2');
$routes->post('api/updateDescriptionProduct/(:num)',        'Api\ProductsController::updateDescriptionProduct/$1');
$routes->post('api/updateDetailsProduct/(:num)',            'Api\ProductsController::updateDetailsProduct/$1');
$routes->get('api/listAllProduct',           'Api\ProductsController::listAll');
$routes->get('api/showProduct/(:num)',       'Api\ProductsController::show/$1');
$routes->get('api/showColor/(:num)',         'Api\ProductsController::showColor/$1');
$routes->get('api/showQuantity/(:num)',      'Api\ProductsController::showQuantity/$1');
$routes->delete('api/deletesizeproduct/(:num)/(:num)/(:num)',   'Api\ProductsController::deleteSize/$1/$2/$3');
$routes->delete('api/deleteimageproduct/(:num)',                'Api\ProductsController::deleteImage/$1');
$routes->delete('api/deleteproduct/(:num)',                     'Api\ProductsController::deleteProduct/$1');


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


/* ============================================
    ORDERS APIS
=============================================== */
$routes->get('api/listAllOrdenes',      'Api\OrdenesController::listAll');
$routes->get('api/showOrden/(:num)',    'Api\OrdenesController::show/$1');


/* ============================================
    ORDERS STATES APIS
=============================================== */
//$routes->get('api/listAllOrdenesState',     'Api\OrdenesStateController::listAll');
$routes->get('api/showOrdenState/(:num)',   'Api\OrdenesStateController::show/$1');
$routes->post('api/createOrdenState',       'Api\OrdenesStateController::create');


/* ============================================
    TRANSACTIONS APIS
=============================================== */
$routes->get('api/listAllTransactions',        'Api\TransactionsController::listAll');
$routes->get('api/showAllTransactions/(:num)', 'Api\TransactionsController::show/$1');


/* ============================================
    COMERCIO APIS
=============================================== */
$routes->get('api/listAllComercio',        'Api\ComercioController::listAll');
$routes->get('api/showComercio/(:num)',    'Api\ComercioController::show/$1');
$routes->get('api/activateTrade/(:num)',   'Api\ComercioController::activateTrade/$1');

/* ============================================
    COMERCIO APIS
=============================================== */ 
$routes->get('api/listAllFeature',          'Api\FeatureController::listAll');
$routes->get('api/showFeature/(:num)',      'Api\FeatureController::show/$1');
$routes->post('api/createFeature',          'Api\FeatureController::create');
$routes->post('api/updateFeature/(:num)',   'Api\FeatureController::update/$1');
$routes->delete('api/deleteFeature/(:num)', 'Api\FeatureController::delete/$1');


/* ============================================
    SEND WHATSAPP APIS
=============================================== */ 
$routes->group('whatsapp', function ($routes) {
    /*$routes->post('api/sendwhatsapp',    'Api\WhatsappAPIController::sendMessage');
    $routes->get('api/Welcom',           'Api\WhatsappAPIController::Welcom');*/
    $routes->get('',         'Api\WhatsappAPIController::VerifyToken');
    $routes->post('',        'Api\WhatsappAPIController::ReceivedMessage');
});



/* ============================================
    EMAIL APIS
=============================================== */ 
$routes->post('api/email',        'Api\EnqueueEmailController::enqueueEmail');