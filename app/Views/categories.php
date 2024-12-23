<?php  echo $this->extend('template/layout'); ?>
<style>
    .search-container {
      margin-bottom: 15px;
    }
    .filter-list {
      list-style-type: none !important;
      padding-left: 0 !important;
    }
    .filter-list li {
      margin-bottom: 10px;
    }

    ul{
        list-style-type: none;
        padding: 0px
    }
  </style>
<?php  echo $this->section("content"); ?>
<?php 
// Inicia un contador global
$globalCounter = 0;
?>
    <!--=====================================
    Breadcrumb
    ======================================-->  
	
	<div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="index.html">Home</a></li>

                <li>Categories</li>

                <li><?php echo $category ?? ''; ?></li>

            </ul>

        </div>

    </div>

    <!--=====================================
    Categories Content
    ======================================--> 

    <div class="container-fuid bg-white my-4">

	    <div class="container">

	    	<!--=====================================
			Layout Categories
			======================================--> 
            <div class="row mb-3">
            	<!--=====================================
                BANNER Categories
                ======================================--> 
                <?php if(count($bannerImg) > 0){ ?>

                    <div class="col-lg-6">

                        <div class="ps-block__slider">

                            <div class="ps-carousel--product-box owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="500" data-owl-mousedrag="off">

                            <?php 
                                foreach($bannerImg as $key => $value){
                                    echo '<a href="#"><img src="'.$value->image.'" alt=""></a>';
                                } 
                            ?>

                            </div>

                        </div>

                    </div>
                <?php }; ?>

                <!--=====================================
                BRANDS IMAGES Categories
                ======================================--> 
                <div class="col-lg-6">

                    <div>

                        <h3 class="mt-3 mb-3" style="font-weight: 400; font-size: 24px; color: #000;">Busca por marcas</h3>

                        <nav class="brands">

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/motorola-1.svg" alt="">
                                <p>Motorola</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/vivo-1.svg" alt="">
                                <p>VIVO</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/zte-1.svg" alt="">
                                <p>ZTE</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/iphone-1.svg" alt="">
                                <p>IPHONE</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/samsung-1.svg" alt="">
                                <p>SAMSUNG</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/honor-1.svg" alt="">
                                <p>HONOR</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/xiaomi-logo-33.svg" alt="">
                                <p>XIAOMI</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2024/marcas/oppo/v2/LOGO-OPPO-150px-x-150px.svg" alt="">
                                <p>OPPO</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/tecno-1.svg" alt="">
                                <p>TECNO</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/realme-2.svg" alt="">
                                <p>REALME</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/kalley-1.svg" alt="">
                                <p>KELLEY</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/huawei-1.svg" alt="">
                                <p>HUAWEI</p>
                            </a>

                            
                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/tcl-1.svg" alt="">
                                <p>TCL</p>
                            </a>

                            <a class="brand-logo">
                                <img src="https://media.aws.alkomprar.com/ymarketingcolcomercio/Alkosto/2023/celulares/primer-nivel/marcas/logo-infinix.svg" alt="">
                                <p>INFINIX</p>
                            </a>

                        </nav>

                        <p class="mt-3 mb-3 text-center">Échale un vistazo a nuestros últimos lanzamientos</p>
                    
                    </div>

                </div>

            </div>

		    <div class="ps-layout--shop">
	        
		        <section>

		        	<!--=====================================
    				Best Sale Items
    				======================================--> 

                    <div class="ps-block--shop-features">

                        <div class="ps-block__header">

                            <h3>Best Sale Items</h3>

                            <div class="ps-block__navigation">

                            	<a class="ps-carousel__prev" href="#recommended1">
                            		<i class="icon-chevron-left"></i>
                            	</a>

                            	<a class="ps-carousel__next" href="#recommended1">
                            		<i class="icon-chevron-right"></i>
                            	</a>

                            </div>

                        </div>
  
                        <div class="ps-block__content">

                            <div class="owl-slider" id="recommended1" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">

                            	<!--=====================================
    							Product
    							======================================--> 
                                <?php

                                     foreach($productsCategory as $key => $product){

                                        $uniqueId = $globalCounter++;
                                        
                                        echo '<div class="ps-product">

                                        <div class="ps-product__thumbnail">
    
                                            <a href="'.base_url().'product/'.$product->slug.'">

                                                <img src='.base_url().$product->image.' alt='.$product->keywords.'>
                                            
                                                </a>
    
                                            <ul class="ps-product__actions">
    
                                                <li>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                        <i class="icon-bag2"></i>
                                                    </a>
                                                </li>
    
                                                <li>
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                </li>
    
                                                <li>
                                                      <a    id="heart-icon-'.$product->id.$uniqueId.'"
                                                            onClick="addHeart('.$product->id.','.$uniqueId.');"
                                                            data-toggle="tooltip" 
                                                            data-placement="top" 
                                                            title="Add to Whishlist 1">
                                                            <i class="icon-heart"></i>
                                                      </a>
                                                     
                                                </li>     
                                                
                                                <li id="loading-icon-'.$product->id.$uniqueId.'" class="removeloadingwishCategory d-none" style="width:15px !important; height:15px !important; display:flex; justify-content:center; align-items:center;">
                                                    <img src="'.base_url().'assets/img/ajax_clock_small.gif'.'" alt="" style="max-width:100%; max-height:100%;">
                                                </li>
    
                                            </ul>
    
                                        </div>
    
                                        <div class="ps-product__container">
    
                                            <a class="ps-product__vendor" href="#">Young Shop</a>
    
                                            <div class="ps-product__content">
    
                                                <a class="ps-product__title" href='.base_url().'product/'.$product->slug.'>
                                                    '.$product->name.'
                                                </a>
    
                                                <div class="ps-product__rating">
    
                                                    <select class="ps-rating" data-read-only="true">
    
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select>
    
                                                    <span>01</span>
    
                                                </div>
    
                                                <p class="ps-product__price">$'.number_format($product->sale_price).' - <del>$'.number_format($product->originalPrice).'</del>
    
                                            </div>
    
                                            <div class="ps-product__content hover">
    
                                                <a class="ps-product__title" href='.base_url().'product/'.$product->slug.'>'.$product->name.'</a>
    
                                                <p class="ps-product__price">$'.number_format($product->sale_price).' - <del>$'.number_format($product->originalPrice).'</del>
                                            </div>
    
                                        </div>
    
                                    </div><!-- End Product -->';
                                     }
                                
                                ?>
                                
                            </div>

                        </div>

                    </div><!-- End Best Sales Items -->

                    <!--=====================================
    				Recommended Items
    				======================================--> 

                    <div class="ps-block--shop-features">

                        <div class="ps-block__header">

                            <h3>Filtrar por</h3>

                            <div class="ps-block__navigation">

                            	<a class="ps-carousel__prev" href="#recommended">
                            		<i class="icon-chevron-left"></i>
                            	</a>

                            	<a class="ps-carousel__next" href="#recommended">
                            		<i class="icon-chevron-right"></i>
                            	</a>

                            </div>

                        </div>
                        
                  

                            <!--<div class="col-lg-2 p-0">
                             
                                <div class="mt-4">
                                   
                                    <div class="search-container">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar marca..." onkeyup="filterBrands()">
                                    </div>

                                 
                                    <ul id="brandList" class="filter-list" style="list-style-type: none !important; padding: 0;">
                                        <?php
                                            foreach($subcategories as $key => $value){
                                                echo '
                                                     <li style="display: flex; align-items: center; gap: 8px; margin: 5px 0;">
                                                        <input style="margin: 0; width: 16px; height: 16px;" type="checkbox" id="brand1" value="'.$value->name.'">
                                                        <label style="margin: 0; line-height: 1;" for="brand1">'.$value->name.'</label>
                                                    </li>
                                                ';
                                            }
                                        ?>
                                    </ul>

                                    <div>
                                        <button class="btn btn-block btn-primary">Buscar</button>
                                    </div>

                                </div>

                            </div>-->

                          
                                
                                <div class="ps-block__content">

                                    <div class="owl-slider" id="recommended" data-owl-auto="true" data-owl-loop="true" 
                                         data-owl-speed="10000" 
                                         data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" 
                                         data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" 
                                         data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">

                                        <!--=====================================
                                        Product
                                        ======================================--> 

                                        <?php
                                            foreach($products as $key => $product){
                                                
                                                $uniqueId = $globalCounter++;

                                                echo '<div class="ps-product">

                                                <div class="ps-product__thumbnail">

                                                    <a href="'.base_url().'product/'.$product->slug.'">
                                                        <img src="'.base_url().$product->image.'" alt='.$product->keywords.'>
                                                    </a>

                                                    <ul class="ps-product__actions">

                                                        <li>
                                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                                <i class="icon-bag2"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
                                                                <i class="icon-eye"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a  id="heart-icon-'.$product->id.$uniqueId.'"
                                                                onClick="addHeart('.$product->id.','.$uniqueId.');"
                                                                data-toggle="tooltip" 
                                                                data-placement="top" 
                                                                title="Add to Whishlist 2">
                                                                <i class="icon-heart"></i>
                                                            </a>
                                                            
                                                        </li> 
                                                        
                                                        <li id="loading-icon-'.$product->id.$uniqueId.'" class="removeloadingwishCategory d-none" style="width:15px !important; height:15px !important; display:flex; justify-content:center; align-items:center;">
                                                            <img src="'.base_url().'assets/img/ajax_clock_small.gif'.'" alt="" style="max-width:100%; max-height:100%;">
                                                        </li>

                                                    </ul>

                                                </div>

                                                <div class="ps-product__container">

                                                    <a class="ps-product__vendor" href="#">Young Shop</a>

                                                    <div class="ps-product__content">

                                                        <a class="ps-product__title" href="'.base_url().'product/'.$product->slug.'">
                                                        '.$product->name.'
                                                        </a>

                                                        <div class="ps-product__rating">

                                                            <select class="ps-rating" data-read-only="true">

                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select>

                                                            <span>01</span>

                                                        </div>

                                                        <p class="ps-product__price">$'.number_format($product->sale_price).' - <del>$'.number_format($product->originalPrice).'</del>

                                                    </div>

                                                    <div class="ps-product__content hover">

                                                        <a class="ps-product__title" href="'.base_url().'product/'.$product->slug.'">
                                                        '.$product->name.'
                                                        </a>

                                                        <p class="ps-product__price">$'.number_format($product->sale_price).' - <del>$'.number_format($product->originalPrice).'</del>

                                                    </div>

                                                </div>

                                            </div><!-- End Product -->';
                                            }
                                        
                                        ?>
                                    </div>
                                </div>
                           
                        
    

                    </div><!-- End Recommended Items -->

                    <!--=====================================
    				Products found
    				======================================--> 

                    <div class="ps-shopping ps-tab-root">

                    	<!--=====================================
    					Shoping Header
    					======================================--> 

                        <div class="ps-shopping__header">

                            <p><strong> 36</strong> Products found</p>

                            <div class="ps-shopping__actions">

                                <select class="ps-select" data-placeholder="Sort Items">

                                    <option>Sort by latest</option>
                                    <option>Sort by popularity</option>
                                    <option>Sort by average rating</option>
                                    <option>Sort by price: low to high</option>
                                    <option>Sort by price: high to low</option>

                                </select>

                                <div class="ps-shopping__view">

                                    <p>View</p>

                                    <ul class="ps-tab-list">

                                        <li class="active">
                                        	<a href="#tab-1">
                                        		<i class="icon-grid"></i>
                                        	</a>
                                        </li>

                                        <li>
                                        	<a href="#tab-2">
                                        		<i class="icon-list4"></i>
                                        	</a>
                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <!--=====================================
    					Shoping Body
    					======================================--> 

                        <div class="ps-tabs">

                        	<!--=====================================
    						Grid View
    						======================================--> 

                            <div class="ps-tab active" id="tab-1">

                                <div class="ps-shopping-product">

                                    <div class="row">

                                    	<!--=====================================
    									Product
    									======================================--> 
                                        <?php
                                            foreach($productsCategory as $key => $product){
                                                
                                                $uniqueId = $globalCounter++;

                                                echo '<div class="col-lg-2 col-md-4 col-6">

                                                <div class="ps-product">
    
                                                    <div class="ps-product__thumbnail">
    
                                                        <a href='.base_url().'product/'.$product->slug.'>
                                                            <img src='.base_url().$product->image.' alt='.$product->keywords.'>
                                                        </a>';

                                                        if($product->discount != NULL && $product->discount != ""){
                                                            echo '<div class="ps-product__badge">'.$product->discount.'% OFF</div>';
                                                        }
                                                     
                                                        echo'<ul class="ps-product__actions">
    
                                                            <li>
                                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                                                                    <i class="icon-bag2"></i>
                                                                </a>
                                                            </li>
    
                                                            <li>
                                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View">
                                                                    <i class="icon-eye"></i>
                                                                </a>
                                                            </li>
    
                                                            <li>
                                                               <a  id="heart-icon-'.$product->id.$uniqueId.'"
                                                                    onClick="addHeart('.$product->id.','.$uniqueId.');"
                                                                    data-toggle="tooltip" 
                                                                    data-placement="top" 
                                                                    title="Add to Whishlist 3">
                                                                    <i class="icon-heart"></i>
                                                                </a>
                                                            </li>

                                                            <li id="loading-icon-'.$product->id.$uniqueId.'" class="removeloadingwishCategory d-none" style="width:15px !important; height:15px !important; display:flex; justify-content:center; align-items:center;">
                                                                <img src="'.base_url().'assets/img/ajax_clock_small.gif'.'" alt="" style="max-width:100%; max-height:100%;">
                                                            </li>
    
                                                        </ul>
    
                                                    </div>
    
                                                    <div class="ps-product__container">
    
                                                     
    
                                                        <div class="ps-product__content">
    
                                                            <a class="ps-product__title" href='.base_url().'product/'.$product->slug.'>
                                                            '.$product->name.'
                                                            </a>
    
                                                             <p class="ps-product__price">$'.number_format($product->sale_price).' - <del>$'.number_format($product->originalPrice).'</del>
    
                                                        </div>
    
                                                        <div class="ps-product__content hover">
    
                                                            <a class="ps-product__title" href='.base_url().'product/'.$product->slug.'>
                                                            '.$product->name.'</a>
    
                                                            <p class="ps-product__price">$'.number_format($product->sale_price).'</p>
    
                                                        </div>
    
                                                    </div>
    
                                                </div>
    
                                            </div><!-- End Product -->';

                                            }
                                     

                                        ?>
                                           
                                    </div>

                                </div>

                                <div class="ps-pagination">

                                    <ul class="pagination">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">Next Page<i class="icon-chevron-right"></i></a></li>
                                    </ul>

                                </div>

                            </div><!-- End Grid View-->

                            <!--=====================================
    						List View
    						======================================--> 

                            <div class="ps-tab" id="tab-2">

                                <div class="ps-shopping-product">

                                    <!--=====================================
    								Product
    								======================================--> 
                                    <?php 
                                    
                                        foreach($productsCategory as $key => $product){
                                            
                                            $uniqueId = $globalCounter++;

                                            echo '<div class="ps-product ps-product--wide">

                                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src='.base_url().$product->image.' alt='.$product->keywords.'></a>
                                           
                                            </div>

                                            <div class="ps-product__container">
                                                <div class="ps-product__content"><a class="ps-product__title" href='.base_url().'product/'.$product->slug.'>'.$product->name.'</a>
                                                   
                                                    <ul class="ps-product__desc">
                                                        <li> 1 Unrestrained and portable active stereo speaker</li>
                                                        <li> 2 Free from the confines of wires and chords</li>
                                                        <li> 3 20 hours of portable capabilities</li>
                                                        <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                        <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                    </ul>
                                                </div>
                                                <div class="ps-product__shopping">
                                                    <p class="ps-product__price">$'.number_format($product->sale_price).'</p><a class="ps-btn" href="#">Add to cart</a>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="'.base_url().'product/'.$product->slug.'"><i class="icon-eye"></i>View</a></li>
                                                        <li>
                                                              <a    id="heart-icon-'.$product->id.$uniqueId.'"
                                                                    onClick="addHeart('.$product->id.', '.$uniqueId.');"
                                                                    data-toggle="tooltip" 
                                                                    data-placement="top" 
                                                                    title="Add to Whishlist 4">
                                                                    <i class="icon-heart"></i>
                                                            </a>
                                                        </li>   
                                                        
                                                        <li id="loading-icon-'.$product->id.$uniqueId.'" class="removeloadingwishCategory d-none" style="width:15px !important; height:15px !important; display:flex; justify-content:center; align-items:center;">
                                                            <img src="'.base_url().'assets/img/ajax_clock_small.gif'.'" alt="" style="max-width:100%; max-height:100%;">
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->';
                                        }
                                    ?>
           
                                </div>

                                <div class="ps-pagination">

                                    <ul class="pagination">

                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">Next Page<i class="icon-chevron-right"></i></a></li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

            </div><!-- End Layout Categories -->

		</div><!-- End Container -->

	</div><!-- End Container Fluid -->

    <!--=====================================
	Newletter
	======================================-->  

    <div class="ps-newsletter">

        <div class="container">

            <form class="ps-form--newsletter" action="do_action" method="post">

                <div class="row">

                    <div class="col-xl-5 col-12 ">
                        <div class="ps-form__left">
                            <h3>Newsletter</h3>
                            <p>Subcribe to get information about products and coupons</p>
                        </div>
                    </div>

                    <div class="col-xl-7 col-12 ">

                        <div class="ps-form__right">

                            <div class="form-group--nest">

                                <input class="form-control" type="email" placeholder="Email address">
                                <button class="ps-btn">Subscribe</button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!--=====================================
	Footer
	======================================-->  
<script type="text/javascript">
    const BASE_URL = "<?= base_url(); ?>";
</script>

<script src="<?php echo base_url().'/assets/js/customers.js';?>"></script>
<script src="<?php echo base_url().'/assets/js/product.js';?>"></script>


<script>
    function filterBrands() {
      var input, filter, ul, li, label, i;
      input = document.getElementById('searchInput');
      filter = input.value.toUpperCase();
      ul = document.getElementById('brandList');
      li = ul.getElementsByTagName('li');

      for (i = 0; i < li.length; i++) {
        label = li[i].getElementsByTagName("label")[0];
        if (label) {
          if (label.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
          } else {
            li[i].style.display = "none";
          }
        }
      }
    }
  </script>
<?php  echo $this->endSection("content"); ?>