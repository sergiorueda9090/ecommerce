<?php

namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\SliderModel;
use App\Models\CategoriesModel;
use App\Models\PageInfoModel;
use App\Models\ProductsModel;
use App\Models\SubCategoriesModel;
use App\Models\SocialNetworkModel;
use App\Models\DepartamentosModel;
use App\Models\WishesModel;

class Home extends BaseController
{   
    private $bannerModel;
    private $sliderModel;
    private $categoriesDataModel;
    private $pageInfoModel;
    private $productsModel;
    private $subCategoriesModel;
    private $socialNetworkModel;
    private $wishesModel;

    public function __construct() {
        // Inicialización de modelos
        $this->bannerModel = new BannerModel();
        $this->sliderModel = new SliderModel();
        $this->categoriesDataModel = new CategoriesModel();
        $this->pageInfoModel = new PageInfoModel();
        $this->productsModel = new ProductsModel();
        $this->subCategoriesModel = new SubCategoriesModel();
        $this->socialNetworkModel = new SocialNetworkModel();
        $this->wishesModel = new WishesModel();
    }

    public function index() {
        // Controlador de características (asegúrate de que exista)
        $feature = new FeatureController();

        // Obtiene todos los sliders
        $sliderAll = $this->sliderModel->findAll();

        // Obtiene todas las categorías
        $categoriesAll = $this->categoriesDataModel->select('categories.id, categories.id_user, categories.name, categories.slug, 
                                                            categories.description, categories.keywords, categories.icon,categoriesimages.image')
                                                   ->join('categoriesimages', 'categories.id = categoriesimages.id_categories')
                                                   ->where('categories.deleted_at', NULL)
                                                   ->get()
                                                   ->getResult();

        // Obtiene todas las subcategorías
        $subcategoriesAll = $this->subCategoriesModel->select('subcategories.id, subcategories.id_categories, subcategories.name, subcategories.slug, subcategoriesimages.image')
                                                     ->join('subcategoriesimages', 'subcategories.id = subcategoriesimages.id_subcategories', 'inner')
                                                     ->where('subcategories.deleted_at', NULL)
                                                     ->get()
                                                     ->getResult();

        // Obtiene imágenes de productos
        $productImages = $this->productsModel->join('productimages', 'productimages.id_product = products.id', 'inner')
                                             ->where('products.deleted_at', NULL)
                                             ->get()
                                             ->getResult();
        
        // Estructura de datos para la vista
        $data = [
            'sliderAll'        => $sliderAll,
            'categoriesAll'    => $categoriesAll,
            'subcategoriesAll' => $subcategoriesAll,
            'productImages'    => $productImages,
            'feature'          => $feature->showFeature(),
            'pageInfo'         => $this->pageInfo(),
            'categories'       => $this->listCategories(),
            'header'           => $this->header(),
            'footer'           => $this->footer()
        ];
        
        return view('ecommerce', $data);
    }

    public function listCategories() {
        // Devuelve todas las categorías
        return $this->categoriesDataModel->select('*')->get()->getResult();
    }

    public function header() {
        // Manejo de sesión
        $session = session();

        $socialNetworkResponse = $this->socialNetworkModel->get()->getResult();
        $resultwished = 0;

        if ($session->idUser) {
            // Cuenta los deseos del usuario
            $resultwishedData = $this->wishesModel->select('COUNT(*) as total')
                                                  ->where('id_customer', $session->idUser)
                                                  ->where('wishes.deleted_at', NULL)
                                                  ->get()
                                                  ->getResult();

            if (!empty($resultwishedData)) {
                $resultwished = $resultwishedData[0]->total;
            }
        }

        return [
            'resultwished' => $resultwished,
            'socialNetworkResponse' => $socialNetworkResponse
        ];
    }

    public function footer() {
        // Agrupación de subcategorías en el footer
        return $this->categoriesDataModel->select('categories.name, categories.slug, GROUP_CONCAT(s.name SEPARATOR ",") as subcategories')
                                         ->join('subcategories s', 'categories.id = s.id_categories', 'inner')
                                         ->groupBy('categories.id')
                                         ->get()
                                         ->getResult();
    }

    public function pageInfo() {
        // Información de la página
        return $this->pageInfoModel->select('*')->first();
    }

    public function pageRegisterCustomer() {
        // Controladores necesarios
        $departamentosCheckoutController = new CheckoutController();

        $data = [
            'pageInfo'   => $this->pageInfo(),
            'categories' => $this->listCategories(),
            'header'     => $this->header(),
            'footer'     => $this->footer(),
            'deparments' => $departamentosCheckoutController->departamentos()
        ];

        return view('register', $data);
    }
}
