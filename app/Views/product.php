<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>

    <!--=====================================
    Breadcrumb
    ======================================-->  
	
	<div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="index.html">Home</a></li>

                <li><a href="shop-default.html">Garden &amp; Kitchen</a></li>

                <li><a href="shop-default.html">Furniture</a></li>

                <li><?php echo $product->name; ?></li>

            </ul>

        </div>

    </div>

    <!--=====================================
    Product Content
    ======================================--> 

	<div class="ps-page--product">

        <div class="ps-container">

        	<!--=====================================
    		Product Container
    		======================================--> 

            <div class="ps-page__container">

        		<!--=====================================
    			Left Column
    			======================================--> 

                <div class="ps-page__left">

                    <div class="ps-product--detail ps-product--fullwidth">

                    	<!--=====================================
    					Product Header
    					======================================--> 

                        <div class="ps-product__header">

                        	<!--=====================================
    						Gallery
    						======================================--> 
                           
                            <div class="ps-product__thumbnail" data-vertical="true">

                                <figure>

                                    <div class="ps-wrapper">

                                        <div class="ps-product__gallery" data-arrow="true">
                                            <?php

                                                foreach ($productImage as $key => $image) {
                                                    echo '<div class="item">';
                                                    echo '<a href="' . base_url() . $image->image. '">';
                                                    echo '<img src="' . base_url() . $image->image. '" alt="">';
                                                    echo '</a>';
                                                    echo '</div>';
                                                }

                                            ?>
                                        </div>

                                    </div>

                                </figure>

                                <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">

                                    <?php

                                        foreach ($productImage as $key => $image) {
                                            echo '<div class="item">';
                                       
                                            echo '<img src="' . base_url() . $image->image. '" alt="">';
                                        
                                            echo '</div>';
                                        }

                                    ?>
                                  

                                </div>

                            </div><!-- End Gallery -->

                            <!--=====================================
    						Product Info
    						======================================--> 

                            <div class="ps-product__info">

                                <h1 class="nameProduct"><?php echo $product->name; ?></h1>
                                <h1 class="idProduct" style="display:none"><?php echo $product->id; ?></h1>

                                <div class="ps-product__meta">

                                    <div class="ps-product__rating">

                                        <select class="ps-rating" data-read-only="true">

                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>

                                        </select>

                                        <span>(0 review)</span>

                                    </div>

                                </div>

                                <h4 class="ps-product__price sale">$<?php echo number_format($product->purchase_price); ?>
                                    <del class="priceToPay"> $<?php echo number_format($product->sale_price); ?></del>
                                    
                                    <?php
                                        if($product->discount != NULL && $product->discount != ""){
                                            echo '<small> (-'.$product->discount.'%)</small>';
                                        }
                                    ?>
                                   
                                </h4>

                                <h4 class="ps-product__price">$<?php echo number_format($product->sale_price); ?></h4>

                                <div class="ps-product__desc">

                                    <p> 
                                    	Status:<a href="shop-default.html"><strong class="ps-tag--in-stock"> In stock</strong></a>
                                    </p>

                                    <?php echo $product->description; ?>

                                </div>

                                <div class="ps-product__variations">

                                    <figure>
                                        <figcaption>Size <strong> Choose an option</strong></figcaption>
                                       
                                        <?php
                                            foreach($productSize as $key => $value){
                                                echo '<div class="ps-variant ps-variant--size" 
                                                            onClick="callColor('.$value->id.');"
                                                            id="checkbox_'.trim($value->id).'">
                                                            <span class="ps-variant__tooltip">'.$value->size.'</span>
                                                            <span class="ps-variant__size">'.$value->size.'</span>
                                                    </div>';
                                            }
                                        ?>
                                    </figure>

                                    
                                    <div id="loaderColors" class="loaderColors" style="display:none;">
                                            <div class="loaderColors-inner">
                                                <div class="loaderColors-text">Cargando...</div>
                                            </div>
                                    </div>

                                    <figure class="figureColors">
                                    
                                       <figcaption>Color: <strong> Choose an option</strong></figcaption>

                                    </figure>

                                </div>

                                <div class="ps-product__countdown">

                                    <figure>

                                        <figcaption> Don't Miss Out! This promotion will expires in</figcaption>

                                        <ul class="ps-countdown" data-time="July 21, 2020 15:37:25">

                                            <li><span class="days"></span>
                                                <p>Days</p>
                                            </li>

                                            <li><span class="hours"></span>
                                                <p>Hours</p>
                                            </li>

                                            <li><span class="minutes"></span>
                                                <p>Minutes</p>
                                            </li>

                                            <li><span class="seconds"></span>
                                                <p>Seconds</p>
                                            </li>

                                        </ul>

                                    </figure>

                                    <figure>

                                        <figcaption>Sold Items</figcaption>

                                        <div class="ps-product__progress-bar ps-progress" data-value="28">

                                            <div class="ps-progress__value"><span></span></div>

                                            <p><b>20/85</b> Sold</p>

                                        </div>

                                    </figure>

                                </div>

                                <div class="ps-product__shopping">

                                    <figure>

                                        <div id="loaderQuantity" class="loaderQuantity" style="display:none;">
                                            <div class="loaderQuantity-inner">
                                                <div class="loaderQuantity-text">Cargando...</div>
                                            </div>
                                        </div>

                                        <figcaption class="Quantity">Quantity </figcaption>

                                        <div class="form-group--number" id="myDiv">

                                            <button class="up">
                                            	<i class="fa fa-plus" onClick="plus()"></i>
                                            </button>

                                            <button class="down">
                                            	<i class="fa fa-minus" onClick="minus()"></i>
                                            </button>

                                            <input class="form-control quantity" type="text" placeholder="0" disabled>

                                        </div>

                                    </figure>

                                    <a class="ps-btn ps-btn--black" type="button" onClick="addCar();">Add to cart</a>

                                    <a class="ps-btn" href="#">Buy Now</a>

                                    <div class="ps-product__actions">

                                    	<a href="#">
                                    		<i class="icon-heart"></i>
                                    	</a>

                                    </div>

                                </div>

                            </div> <!-- End Product Info -->

                        </div> <!-- End Product header -->

                    	<!--=====================================
    					Product Content
    					======================================--> 

                        <div class="ps-product__content ps-tab-root">

                            <div class="ps-block--bought-toggether">

                                <h4>Frequently Bought Together</h4>

                                <div class="ps-block__content">

                                    <div class="ps-block__items">

                                        <div class="ps-block__item">

                                            <div class="ps-product ps-product--simple">

                                                <div class="ps-product__thumbnail">

                                                	<a href="product-default.html">
                                                		<img src="<?php echo base_url().'assets/img/products/furniture/12.jpg'?>" alt="">
                                                	</a>

                                                </div>

                                                <div class="ps-product__container">

                                                    <div class="ps-product__content">
                                                    	<a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>

                                                        <p class="ps-product__price">$679.80</p>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="ps-block__item">

                                            <div class="ps-product ps-product--simple">

                                                <div class="ps-product__thumbnail">

                                                	<a href="product-default.html">
                                                		<img src="<?php echo base_url().'assets/img/products/furniture/13.jpg'?>" alt="">
                                                	</a>

                                                </div>

                                                <div class="ps-product__container">

                                                    <div class="ps-product__content">

                                                    	<a class="ps-product__title" href="product-default.html">Fabric Chair In Brown Color</a>

                                                        <p class="ps-product__price">$120.80</p>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="ps-block__item ps-block__total">

                                            <p>Total Price:<strong> $1000.30</strong></p>

                                            <a class="ps-btn" href="#">Add All to cart</a>
                                            <a class="ps-btn ps-btn--gray ps-btn--outline" href="#">Add All to whishlist</a>

                                        </div>

                                    </div>

                                    <div class="ps-block__footer">

                                        <div class="ps-checkbox">

                                            <input class="form-control" type="checkbox" id="product-bought-1" name="product-bought" checked>

                                            <label for="product-bought-1"><strong>This item: </strong> Korea Long Sofa Fabric In Blue Navy Color <span>$679.80</span></label>

                                        </div>

                                        <div class="ps-checkbox">

                                            <input class="form-control" type="checkbox" id="product-bought-2" name="product-bought" checked>

                                            <label for="product-bought-2">Fabric Chair In Brown Color <span>$120.80</span></label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <ul class="ps-tab-list">

                                <li class="active"><a href="#tab-1">Description</a></li>
                                <li><a href="#tab-2">Specification</a></li>
                                <li><a href="#tab-3">Vendor</a></li>
                                <li><a href="#tab-4">Reviews (1)</a></li>
                                <li><a href="#tab-5">Questions and Answers</a></li>
                                <li><a href="#tab-6">More Offers</a></li>

                            </ul>

                            <div class="ps-tabs">

                                <div class="ps-tab active" id="tab-1">

                                <?php echo $product->details; ?>

                                </div>

                                <div class="ps-tab" id="tab-2">

                                    <div class="table-responsive">

                                        <table class="table table-bordered ps-table ps-table--specification">

                                            <?php echo $product->specifications; ?>

                                        </table>

                                    </div>

                                </div>

                                <div class="ps-tab" id="tab-3">

                                    <h4>GoPro</h4>

                                    <p>Digiworld US, New York’s no.1 online retailer was established in May 2012 with the aim and vision to become the one-stop shop for retail in New York with implementation of best practices both online</p>

                                    <a href="#">More Products from gopro</a>

                                </div>

                                <div class="ps-tab" id="tab-4">

                                    <div class="row">

                                        <div class="col-lg-5 col-12 ">

                                            <div class="ps-block--average-rating">

                                                <div class="ps-block__header">

                                                    <h3>4.00</h3>

                                                    <select class="ps-rating" data-read-only="true">

                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="2">5</option>

                                                    </select>

                                                    <span>1 Review</span>

                                                </div>

                                                <div class="ps-block__star">

                                                	<span>5 Star</span>

                                                    <div class="ps-progress" data-value="100">

                                                    	<span></span>

                                                    </div>

                                                    <span>100%</span>

                                                </div>

                                                <div class="ps-block__star">

                                                	<span>4 Star</span>

                                                    <div class="ps-progress" data-value="0">

                                                    	<span></span>

                                                    </div>

                                                    <span>0</span>

                                                </div>

                                                <div class="ps-block__star">

                                                	<span>3 Star</span>

                                                    <div class="ps-progress" data-value="0">

                                                    	<span></span>

                                                    </div>

                                                    <span>0</span>

                                                </div>

                                                <div class="ps-block__star">

                                                	<span>2 Star</span>

                                                    <div class="ps-progress" data-value="0">
                                                    	<span></span>
                                                    </div>

                                                    <span>0</span>

                                                </div>

                                                <div class="ps-block__star">

                                                	<span>1 Star</span>

                                                    <div class="ps-progress" data-value="0">
                                                    	<span></span>
                                                    </div>

                                                    <span>0</span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 ">

                                            <form class="ps-form--review" action="index.html" method="get">

                                                <h4>Submit Your Review</h4>

                                                <p>Your email address will not be published. Required fields are marked<sup>*</sup></p>

                                                <div class="form-group form-group__rating">

                                                    <label>Your rating of this product</label>

                                                    <select class="ps-rating" data-read-only="false">

                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>

                                                    </select>

                                                </div>

                                                <div class="form-group">

                                                    <textarea class="form-control" rows="6" placeholder="Write your review here">
                                                    	
                                                    </textarea>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6 col-sm-12">

                                                        <div class="form-group">
                                                            <input class="form-control" type="text" placeholder="Your Name">
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6 col-sm-12">

                                                        <div class="form-group">
                                                            <input class="form-control" type="email" placeholder="Your Email">
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-group submit">

                                                    <button class="ps-btn">Submit Review</button>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                                <div class="ps-tab" id="tab-5">

                                    <div class="ps-block--questions-answers">

                                        <h3>Questions and Answers</h3>

                                        <div class="form-group">

                                            <input class="form-control" type="text" placeholder="Have a question? Search for answer?">
                                        
                                        </div>

                                    </div>

                                </div>

                                <div class="ps-tab active" id="tab-6">

                                    <p>Sorry no more offers available</p>

                                </div>

                            </div>

                        </div><!--  End product content -->

                    </div>

                </div><!-- End Left Column -->

                <!--=====================================
    			Right Column
    			======================================--> 

                <div class="ps-page__right">

                    <aside class="widget widget_product widget_features">

                        <p><i class="icon-network"></i> Shipping worldwide</p>

                        <p><i class="icon-3d-rotate"></i> Free 7-day return if eligible, so easy</p>

                        <p><i class="icon-receipt"></i> Supplier give bills for this product.</p>

                        <p><i class="icon-credit-card"></i> Pay online or when receiving goods</p>

                    </aside>

                    <aside class="widget widget_sell-on-site">

                        <p><i class="icon-store"></i> Sell on MarketPlace?<a href="#"> Register Now !</a></p>

                    </aside>

                    <aside class="widget widget_same-brand">

                        <h3>Same Brand</h3>

                        <div class="widget__content">

                            <div class="ps-product">

                                <div class="ps-product__thumbnail">

                                	<a href="product-default.html">
                                		<img src="<?php echo base_url().'assets/img/products/shop/5.jpg'?>" alt="">
                                	</a>

                                    <div class="ps-product__badge">-37%</div>

                                    <ul class="ps-product__actions">

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
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

                                	<a class="ps-product__vendor" href="#">Robert's Store</a>

                                    <div class="ps-product__content">

                                    	<a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>

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

                                        <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>

                                    </div>

                                    <div class="ps-product__content hover">

                                    	<a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>

                                        <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>

                                    </div>

                                </div>

                            </div>

                            <div class="ps-product">

                                <div class="ps-product__thumbnail">

                                	<a href="product-default.html"><img src="<?php echo base_url().'assets/img/products/shop/6.jpg'?>" alt=""></a>

                                    <div class="ps-product__badge">-5%</div>

                                    <ul class="ps-product__actions">

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
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

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Compare">
                                        		<i class="icon-chart-bars"></i>
                                        	</a>
                                        </li>

                                    </ul>

                                </div>

                                <div class="ps-product__container">

                                	<a class="ps-product__vendor" href="#">Youngshop</a>

                                    <div class="ps-product__content">

                                    	<a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>

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

                                        <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>

                                    </div>

                                    <div class="ps-product__content hover">

                                    	<a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>

                                        <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </aside>

                </div><!-- End Right Column -->

            </div><!--  End Product Container -->

			<!--=====================================
			Customers who bought
			======================================--> 

            <div class="ps-section--default ps-customer-bought">

                <div class="ps-section__header">

                    <h3>Customers who bought this item also bought</h3>

                </div>

                <div class="ps-section__content">

                    <div class="row">

                        <div class="col-lg-2 col-md-4 col-6 ">

                            <div class="ps-product">

                                <div class="ps-product__thumbnail">

                                	<a href="product-default.html">
                                		<img src="<?php echo base_url().'assets/img/products/shop/4.jpg'?>" alt="">
                                	</a>

                                    <div class="ps-product__badge hot">hot</div>

                                    <ul class="ps-product__actions">

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
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

                                	<a class="ps-product__vendor" href="#">Global Office</a>

                                    <div class="ps-product__content">

                                    	<a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>

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

                                        <p class="ps-product__price">$55.99</p>

                                    </div>

                                    <div class="ps-product__content hover">

                                    	<a class="ps-product__title" href="product-default.html">Xbox One Wireless Controller Black Color</a>

                                        <p class="ps-product__price">$55.99</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-2 col-md-4 col-6 ">

                            <div class="ps-product">

                                <div class="ps-product__thumbnail">

                                	<a href="product-default.html">
                                		<img src="<?php echo base_url().'assets/img/products/shop/5.jpg'?>" alt="">
                                	</a>

                                    <div class="ps-product__badge">-37%</div>

                                    <ul class="ps-product__actions">

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
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

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Compare">
                                        		<i class="icon-chart-bars"></i>
                                        	</a>
                                        </li>

                                    </ul>

                                </div>

                                <div class="ps-product__container">

                                	<a class="ps-product__vendor" href="#">Robert's Store</a>

                                    <div class="ps-product__content">

                                    	<a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>

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

                                        <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>

                                    </div>

                                    <div class="ps-product__content hover">

                                    	<a class="ps-product__title" href="product-default.html">Grand Slam Indoor Of Show Jumping Novel</a>

                                        <p class="ps-product__price sale">$32.99 <del>$41.00 </del></p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-2 col-md-4 col-6 ">

                            <div class="ps-product">

                                <div class="ps-product__thumbnail">

                                	<a href="product-default.html"><img src="<?php echo base_url().'assets/img/products/shop/6.jpg'?>" alt=""></a>

                                    <div class="ps-product__badge">-5%</div>

                                    <ul class="ps-product__actions">

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a>
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

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Compare">
                                        		<i class="icon-chart-bars"></i>
                                        	</a>
                                        </li>

                                    </ul>

                                </div>

                                <div class="ps-product__container">

                                	<a class="ps-product__vendor" href="#">Youngshop</a>

                                    <div class="ps-product__content">

                                    	<a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>

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

                                        <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>

                                    </div>

                                    <div class="ps-product__content hover">

                                    	<a class="ps-product__title" href="product-default.html">Sound Intone I65 Earphone White Version</a>

                                        <p class="ps-product__price sale">$100.99 <del>$106.00 </del></p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-2 col-md-4 col-6 ">

                            <div class="ps-product">

                                <div class="ps-product__thumbnail">

                                	<a href="product-default.html">
                                		<img src="<?php echo base_url().'assets/img/products/shop/7.jpg'?>" alt="">
                                	</a>

                                    <div class="ps-product__badge">-16%</div>

                                    <ul class="ps-product__actions">

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
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

                                	<a class="ps-product__vendor" href="#">Youngshop</a>

                                    <div class="ps-product__content">

                                    	<a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>

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

                                        <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p>

                                    </div>

                                    <div class="ps-product__content hover">

                                    	<a class="ps-product__title" href="product-default.html">Korea Long Sofa Fabric In Blue Navy Color</a>

                                        <p class="ps-product__price sale">$567.89 <del>$670.20 </del></p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-2 col-md-4 col-6 ">

                            <div class="ps-product">

                                <div class="ps-product__thumbnail">

                                	<a href="product-default.html">
                                		<img src="<?php echo base_url().'assets/img/products/shop/8.jpg'?>" alt="">
                                	</a>

                                    <div class="ps-product__badge">-16%</div>

                                    <ul class="ps-product__actions">

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
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

                                	<a class="ps-product__vendor" href="#">Young shop</a>

                                    <div class="ps-product__content">

                                    	<a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>

                                        <div class="ps-product__rating">

                                            <select class="ps-rating" data-read-only="true">

                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>

                                            </select>

                                            <span>02</span>

                                        </div>

                                        <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p>

                                    </div>

                                    <div class="ps-product__content hover">

                                    	<a class="ps-product__title" href="product-default.html">Unero Military Classical Backpack</a>

                                        <p class="ps-product__price sale">$35.89 <del>$42.20 </del></p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-2 col-md-4 col-6">

                            <div class="ps-product">

                                <div class="ps-product__thumbnail">

                                	<a href="product-default.html">
                                		<img src="<?php echo base_url().'assets/img/products/shop/9.jpg'?>" alt="">
                                	</a>

                                    <ul class="ps-product__actions">

                                        <li>
                                        	<a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
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

                                	<a class="ps-product__vendor" href="#">Young shop</a>

                                    <div class="ps-product__content">

                                    	<a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>

                                        <div class="ps-product__rating">

                                            <select class="ps-rating" data-read-only="true">

                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="2">5</option>

                                            </select>

                                            <span>02</span>

                                        </div>

                                        <p class="ps-product__price">$35.89</p>

                                    </div>

                                    <div class="ps-product__content hover">

                                    	<a class="ps-product__title" href="product-default.html">Rayban Rounded Sunglass Brown Color</a>

                                        <p class="ps-product__price">$35.89</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div><!--  End Customers who bought -->

            <!--=====================================
			Related products
			======================================--> 

            <div class="ps-section--default">

                <div class="ps-section__header">

                    <h3>Related products</h3>

                </div>

                <div class="ps-section__content">

                    <div class="ps-carousel--nav owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="10000" data-owl-gap="30" data-owl-nav="true" data-owl-dots="true" data-owl-item="6" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                        <div class="ps-product">

                            <div class="ps-product__thumbnail">

                            	<a href="product-default.html">
                            		<img src="<?php echo base_url().'assets/img/products/shop/11.jpg'?>" alt="">
                            	</a>

                                <ul class="ps-product__actions">

                                    <li>
                                    	<a href="#" data-toggle="tooltip" data-placement="top" title="Read More">
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
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?php echo base_url().'assets/img/products/shop/12.jpg'?>" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Paul’s Smith Sneaker InWhite Color</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$75.44</p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Paul’s Smith Sneaker InWhite Color</a>
                                    <p class="ps-product__price">$75.44</p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?php echo base_url().'assets/img/products/shop/13.jpg'?>" alt=""></a>
                                <div class="ps-product__badge">-7%</div>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">MVMTH Classical Leather Watch In Black</a>
                                    <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?php echo base_url().'assets/img/products/shop/14.jpg'?>" alt=""></a>
                                <div class="ps-product__badge">-7%</div>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Global Office</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Beat Spill 2.0 Wireless Speaker – White</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Beat Spill 2.0 Wireless Speaker – White</a>
                                    <p class="ps-product__price sale">$57.99 <del>$62.99 </del></p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?php echo base_url().'assets/img/products/shop/15.jpg'?>" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">ASUS Chromebook Flip – 10.2 Inch</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$332.38</p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">ASUS Chromebook Flip – 10.2 Inch</a>
                                    <p class="ps-product__price sale">$332.38</p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?php echo base_url().'assets/img/products/shop/16.jpg'?>" alt=""></a>
                                <div class="ps-product__badge">-7%</div>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Young Shop</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Apple Macbook Retina Display 12&quot;</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price sale">$1200.00 <del>$1362.99 </del></p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Apple Macbook Retina Display 12&quot;</a>
                                    <p class="ps-product__price sale">$1200.00 <del>$1362.99 </del></p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?php echo base_url().'assets/img/products/shop/17.jpg'?>" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$599.00</p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">Samsung UHD TV 24inch</a>
                                    <p class="ps-product__price">$599.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?php echo base_url().'assets/img/products/shop/18.jpg'?>" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$233.28</p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <p class="ps-product__price">$233.28</p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-product">
                            <div class="ps-product__thumbnail"><a href="product-default.html"><img src="<?php echo base_url().'assets/img/products/shop/19.jpg'?>" alt=""></a>
                                <ul class="ps-product__actions">
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Read More"><i class="icon-bag2"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                                </ul>
                            </div>
                            <div class="ps-product__container"><a class="ps-product__vendor" href="#">Robert's Store</a>
                                <div class="ps-product__content"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                            <option value="1">4</option>
                                            <option value="2">5</option>
                                        </select><span>01</span>
                                    </div>
                                    <p class="ps-product__price">$233.28</p>
                                </div>
                                <div class="ps-product__content hover"><a class="ps-product__title" href="product-default.html">EPSION Plaster Printer</a>
                                    <p class="ps-product__price">$233.28</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Related products -->

        </div>

    </div><!-- End Product Content -->

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

<script src="<?php echo base_url().'/assets/js/product.js';?>"></script>
<?php  echo $this->endSection("content"); ?>