<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>

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
                                     foreach($products as $key => $product){
                                        echo '<div class="ps-product">

                                        <div class="ps-product__thumbnail">
    
                                            <a href="product-default.html">
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
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist">
                                                        <i class="icon-heart"></i>
                                                    </a>
                                                </li>                                           
    
                                            </ul>
    
                                        </div>
    
                                        <div class="ps-product__container">
    
                                            <a class="ps-product__vendor" href="#">Young Shop</a>
    
                                            <div class="ps-product__content">
    
                                                <a class="ps-product__title" href='.base_url().$product->slug.'>
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
    
                                                <p class="ps-product__price">$'.number_format($product->sale_price).' - $32.99</p>
    
                                            </div>
    
                                            <div class="ps-product__content hover">
    
                                                <a class="ps-product__title" href='.base_url().$product->slug.'>
                                                '.$product->name.'</a>
    
                                                <p class="ps-product__price">$'.number_format($product->sale_price).' - $32.99</p>
    
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

                            <h3>Recommended Items</h3>

                            <div class="ps-block__navigation">

                            	<a class="ps-carousel__prev" href="#recommended">
                            		<i class="icon-chevron-left"></i>
                            	</a>

                            	<a class="ps-carousel__next" href="#recommended">
                            		<i class="icon-chevron-right"></i>
                            	</a>

                            </div>

                        </div>

                        <div class="ps-block__content">

                            <div class="owl-slider" id="recommended" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">

                                <!--=====================================
    							Product
    							======================================--> 

                                <?php
                                     foreach($products as $key => $product){
                                        echo '<div class="ps-product">

                                        <div class="ps-product__thumbnail">
    
                                            <a href="product-default.html">
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
                                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist">
                                                        <i class="icon-heart"></i>
                                                    </a>
                                                </li>                                           
    
                                            </ul>
    
                                        </div>
    
                                        <div class="ps-product__container">
    
                                            <a class="ps-product__vendor" href="#">Young Shop</a>
    
                                            <div class="ps-product__content">
    
                                                <a class="ps-product__title" href="product-default.html">
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
    
                                                <p class="ps-product__price">$'.number_format($product->sale_price).' - $32.99</p>
    
                                            </div>
    
                                            <div class="ps-product__content hover">
    
                                                <a class="ps-product__title" href="'.$product->slug.'">
                                                '.$product->name.'
                                                </a>
    
                                                <p class="ps-product__price">$'.number_format($product->sale_price).' - $32.99</p>
    
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
                                            foreach($products as $key => $product){
                                                echo '<div class="col-lg-2 col-md-4 col-6">

                                                <div class="ps-product">
    
                                                    <div class="ps-product__thumbnail">
    
                                                        <a href="product-default.html">
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
                                                                <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist">
                                                                    <i class="icon-heart"></i>
                                                                </a>
                                                            </li>
    
                                                            
    
                                                        </ul>
    
                                                    </div>
    
                                                    <div class="ps-product__container">
    
                                                        <a class="ps-product__vendor" href="#">ROBERT’S STORE</a>
    
                                                        <div class="ps-product__content">
    
                                                            <a class="ps-product__title" href='.base_url().$product->slug.'>
                                                            '.$product->name.'
                                                            </a>
    
                                                            <p class="ps-product__price">$'.number_format($product->sale_price).'</p>
    
                                                        </div>
    
                                                        <div class="ps-product__content hover">
    
                                                            <a class="ps-product__title" href='.base_url().$product->slug.'>
                                                            '.$product->name.'</a>
    
                                                            <p class="ps-product__price">$'.number_format($product->sale_price).'</p>
    
                                                        </div>
    
                                                    </div>
    
                                                </div>
    
                                            </div><!-- End Product -->';
                                            }
                                     

                                        ?>


										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/1.jpg" alt=""></a>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Apple iPhone Retina 6s Plus 64GB</a>
                                                        <p class="ps-product__price">$1150.00</p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Apple iPhone Retina 6s Plus 64GB</a>
                                                        <p class="ps-product__price">$1150.00</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail">
                                                    <a href="product-default.html">
                                                        <img src="img/products/shop/2.jpg" alt="">
                                                    </a>

                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>

                                                <div class="ps-product__container">

                                                    <a class="ps-product__vendor" href="#">Go Pro</a>

                                                    <div class="ps-product__content">
                                                        <a class="ps-product__title" href="product-default.html">Marshall Kilburn Portable Wireless Speaker</a>
                                                        
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>01</span>
                                                        </div>
                                                        <p class="ps-product__price">$42.99 - $60.00</p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Marshall Kilburn Portable Wireless Speaker</a>
                                                        <p class="ps-product__price">$42.99 - $60.00</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/3.jpg" alt=""></a>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Go Pro</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Herschel Leather Duffle Bag In Brown Color</a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>01</span>
                                                        </div>
                                                        <p class="ps-product__price">$125.30</p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Herschel Leather Duffle Bag In Brown Color</a>
                                                        <p class="ps-product__price">$125.30</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/4.jpg" alt=""></a>
                                                    <div class="ps-product__badge hot">hot</div>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>01</span>
                                                        </div>
                                                        <p class="ps-product__price">$55.99</p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>
                                                        <p class="ps-product__price">$55.99</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/5.jpg" alt=""></a>
                                                    <div class="ps-product__badge">-37%</div>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>01</span>
                                                        </div>
                                                        <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>
                                                        <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/6.jpg" alt=""></a>
                                                    <div class="ps-product__badge">-5%</div>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Youngshop</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>01</span>
                                                        </div>
                                                        <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                                                        <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/7.jpg" alt=""></a>
                                                    <div class="ps-product__badge">-16%</div>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Youngshop</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>01</span>
                                                        </div>
                                                        <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>
                                                        <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/8.jpg" alt=""></a>
                                                    <div class="ps-product__badge">-16%</div>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young shop</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>02</span>
                                                        </div>
                                                        <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>
                                                        <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/9.jpg" alt=""></a>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young shop</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>02</span>
                                                        </div>
                                                        <p class="ps-product__price">$35.89</p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>
                                                        <p class="ps-product__price">$35.89</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/10.jpg" alt=""></a>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Go Pro</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>01</span>
                                                        </div>
                                                        <p class="ps-product__price">$29.39 - $39.99</p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                                    	<p class="ps-product__price">$29.39 - $39.99</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

										<!--=====================================
    									Product
    									======================================--> 

                                        <div class="col-lg-2 col-md-4 col-6">
                                            <div class="ps-product">
                                                <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/11.jpg" alt=""></a>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                                        <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                                       
                                                    </ul>
                                                </div>
                                                <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                                    <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Men’s Sports Runnning Swim Board Shorts</a>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="1">2</option>
                                                                <option value="1">3</option>
                                                                <option value="1">4</option>
                                                                <option value="2">5</option>
                                                            </select><span>01</span>
                                                        </div>
                                                        <p class="ps-product__price">$13.43</p>
                                                    </div>
                                                    <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Men’s Sports Runnning Swim Board Shorts</a>
                                                        <p class="ps-product__price">$13.43</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->

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

                                    <div class="ps-product ps-product--wide">

                                        <div class="ps-product__thumbnail">

                                        	<a href="product-default.html">
                                        		<img src="img/products/shop/1.jpg" alt="">
                                        	</a>

                                        </div>

                                        <div class="ps-product__container">

                                            <div class="ps-product__content">

                                            	<a class="ps-product__title" href="product-default.html">
                                            	Apple iPhone Retina 6s Plus 64GB</a>

                                                <p class="ps-product__vendor">Sold by:
                                                	<a href="#">ROBERT’S STORE</a>
                                                </p>

                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>

                                            </div>

                                            <div class="ps-product__shopping">

                                                <p class="ps-product__price">$1310.00</p>

                                                <a class="ps-btn" href="#">Add to cart</a>

                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                </ul>

                                            </div>

                                        </div>

                                    </div> <!-- End Product -->

                                    <!--=====================================
    								Product
    								======================================--> 
                                    <?php 
                                        foreach($products as $key => $product){
                                            echo '<div class="ps-product ps-product--wide">
                                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src='.base_url().$product->image.' alt='.$product->keywords.'></a>
                                            </div>
                                            <div class="ps-product__container">
                                                <div class="ps-product__content"><a class="ps-product__title" href='.base_url().$product->slug.'>'.$product->name.'</a>
                                                    <p class="ps-product__vendor">Sold by:<a href="#">Young Shop</a></p>
                                                    <ul class="ps-product__desc">
                                                        <li> Unrestrained and portable active stereo speaker</li>
                                                        <li> Free from the confines of wires and chords</li>
                                                        <li> 20 hours of portable capabilities</li>
                                                        <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                        <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                    </ul>
                                                </div>
                                                <div class="ps-product__shopping">
                                                    <p class="ps-product__price">$'.number_format($product->sale_price).'</p><a class="ps-btn" href="#">Add to cart</a>
                                                    <ul class="ps-product__actions">
                                                        <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                        <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- End Product -->';
                                        }
                                    ?>
                               

                                    <!--=====================================
    								Product
    								======================================--> 

                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/2.jpg" alt=""></a>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Marshall Kilburn Portable Wireless Speaker</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>01</span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="#">Go Pro</a></p>
                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price">$42.99 - $60.00</p><a class="ps-btn" href="#">Add to cart</a>
                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- End Product -->

                                    <!--=====================================
    								Product
    								======================================--> 

                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/3.jpg" alt=""></a>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Herschel Leather Duffle Bag In Brown Color</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>01</span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="#">Go Pro</a></p>
                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price">$125.30</p><a class="ps-btn" href="#">Add to cart</a>
                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- End Product -->

                                    <!--=====================================
    								Product
    								======================================--> 

                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/4.jpg" alt=""></a>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>01</span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="#">Global Office</a></p>
                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price">$55.99</p><a class="ps-btn" href="#">Add to cart</a>
                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- End Product -->

                                    <!--=====================================
    								Product
    								======================================--> 

                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/5.jpg" alt=""></a>
                                            <div class="ps-product__badge">-37%</div>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>01</span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="#">Robert's Store</a></p>
                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p><a class="ps-btn" href="#">Add to cart</a>
                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- End Product -->

                                    <!--=====================================
    								Product
    								======================================--> 

                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/6.jpg" alt=""></a>
                                            <div class="ps-product__badge">-5%</div>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>01</span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="#">Youngshop</a></p>
                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p><a class="ps-btn" href="#">Add to cart</a>
                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- End Product -->

                                    <!--=====================================
    								Product
    								======================================--> 

                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/7.jpg" alt=""></a>
                                            <div class="ps-product__badge">-16%</div>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>01</span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="#">Youngshop</a></p>
                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p><a class="ps-btn" href="#">Add to cart</a>
                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- End Product -->

                                    <!--=====================================
    								Product
    								======================================--> 

                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/8.jpg" alt=""></a>
                                            <div class="ps-product__badge">-16%</div>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>02</span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="#">Young shop</a></p>
                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p><a class="ps-btn" href="#">Add to cart</a>
                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- End Product -->

                                    <!--=====================================
    								Product
    								======================================--> 

                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/9.jpg" alt=""></a>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>02</span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="#">Young shop</a></p>
                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price">$35.89</p><a class="ps-btn" href="#">Add to cart</a>
                                                <ul class="ps-product__actions">
                                                	<li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>                       
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- End Product -->

                                    <!--=====================================
    								Product
    								======================================--> 

                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/10.jpg" alt=""></a>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Sleeve Linen Blend Caro Pane Shirt</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>01</span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="#">Go Pro</a></p>
                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price">$29.39 - $39.99</p><a class="ps-btn" href="#">Add to cart</a>
                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- End Product -->

                                    <!--=====================================
    								Product
    								======================================--> 

                                    <div class="ps-product ps-product--wide">
                                        <div class="ps-product__thumbnail"><a href="product-default.html"><img src="img/products/shop/11.jpg" alt=""></a>
                                        </div>
                                        <div class="ps-product__container">
                                            <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Men’s Sports Runnning Swim Board Shorts</a>
                                                <div class="ps-product__rating">
                                                    <select class="ps-rating" data-read-only="true">
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>
                                                    </select><span>01</span>
                                                </div>
                                                <p class="ps-product__vendor">Sold by:<a href="#">Robert's Store</a></p>
                                                <ul class="ps-product__desc">
                                                    <li> Unrestrained and portable active stereo speaker</li>
                                                    <li> Free from the confines of wires and chords</li>
                                                    <li> 20 hours of portable capabilities</li>
                                                    <li> Double-ended Coil Cord with 3.5mm Stereo Plugs Included</li>
                                                    <li> 3/4″ Dome Tweeters: 2X and 4″ Woofer: 1X</li>
                                                </ul>
                                            </div>
                                            <div class="ps-product__shopping">
                                                <p class="ps-product__price">$13.43</p><a class="ps-btn" href="#">Add to cart</a>
                                                <ul class="ps-product__actions">
                                                    <li><a href="#"><i class="icon-eye"></i>View</a></li>
                                                    <li><a href="#"><i class="icon-heart"></i> Wishlist</a></li>       
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- End Product -->
           
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

<script src="<?php echo base_url().'/assets/js/customers.js';?>"></script>
<?php  echo $this->endSection("content"); ?>