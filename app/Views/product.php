<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>
<style>

.wish-message-a .icon {
    font-size: 30px;
    margin-right: 3px;
    color: #ff6b6b;
}

.icon {
    font-size: 24px;
    display: inline-block;
}

</style>

<style>
        .envio-gratis {
            font-size: 12px;
            font-weight: bold;
            /*color: white;
            padding: 5px 10px;
            border-radius: 20px;
            position: relative;
            display: inline-block;
            animation: onda 2s infinite;
            border-radius: 10px;
            border-color:#fcb800;*/
        }

        /*.envio-gratis::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fcb80054;
            border-radius: 20px;
            transform: scale(1.2);
            animation: ondas 2s infinite;
        }*/

        @keyframes onda {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes ondas {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.3);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
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

                                <div class="ps-product__variants" data-item="6" data-md="6" data-sm="6" data-arrow="false">

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
                                    <?php
                                        /*$purchase_price = 10000; // Precio de compra
                                        $percentage_profit = 300; // Porcentaje de ganancia
                                        $discount = 50; // Porcentaje de descuento

                                        // Precio de venta sin descuento
                                        $selling_price = $purchase_price + ($purchase_price * ($percentage_profit / 100));

                                        // Precio con descuento
                                        $discounted_price = $selling_price - ($selling_price * ($discount / 100));

                                        // Mostrar resultados con formato
                                        echo "Precio de compra: " . number_format($purchase_price, 0, ',', '.') . " COP<br>";
                                        echo "Porcentaje de ganancia: " . $percentage_profit . "%<br>";
                                        echo "Precio de venta sin descuento: " . number_format($selling_price, 0, ',', '.') . " COP<br>";
                                        echo "Descuento aplicado: " . $discount . "%<br>";
                                        echo "Precio final con descuento: " . number_format($discounted_price, 0, ',', '.') . " COP";*/
                                    ?>
                               <h6 class="ps-product__price sale">$    

                                    <span class="ps-product__price sale priceToPay"><?php echo number_format($product->sale_price, 0, ',', '.') . " COP";?></span>
                                    
                                    <del class="priceToOriginal"> $  <?php echo number_format($product->originalPrice, 0, ',', '.'). " COP";  ?></del>
                                    
                                    <?php
                                        if($product->discount != NULL && $product->discount != ""){
                                            echo '<small> (-'.$product->discount.'%)</small>';
                                        }
                                    ?>
                                   
                                </h6>

                                <div class="ps-product__desc">
                                    <p style="margin:0px;"> 
                                        <?php echo "Precio de venta sin descuento: "; ?>
                                        <del class="priceToOriginal"> 
                                            <?php echo "$ ". number_format($product->originalPrice, 0, ',', '.') . " COP";?> 
                                        </del>
                                    </p>

                                    <p style="margin:0px;"> 
                                        <?php echo "Descuento aplicado: "; ?>
                                        <?php
                                            if($product->discount != NULL && $product->discount != ""){
                                                echo '<small> (-'.$product->discount.'%)</small>';
                                            }
                                        ?>
                                    </p>

                                    <p style="margin:0px;"> 
                                        <?php echo "Precio final con descuento: "; ?>
                                        <?php echo "$ ". number_format($product->sale_price, 0, ',', '.') . " COP";?>
                                    </p>

                                    <p class="envio-gratis">Envío Gratis</p>

                                </div>


                                <div class="ps-product__desc">

                                    <p> 
                                    	Status:<a href="shop-default.html"><strong class="ps-tag--in-stock"> In stock 🏠</strong></a>
                                    </p>

                                    <?php echo $product->description; ?>

                                </div>

                                <div class="ps-product__variations">

                                    <div class="row">

                                        <div class="col-lg-6">
                                            
                                            <figure>
                                                <figcaption class="attributoProduct" title="<?php echo $product->attribute_name; ?>"><?php echo $product->attribute_name; ?> <strong> Choose an option</strong></figcaption>
                                                
                                                <?php
                                                    foreach($valueattributes as $key => $value){
                                                        echo '<div class="ps-variant ps-variant--size" 
                                                                    onClick="callColor(' . $value->id . ', ' . $product->id_attribute . ', \'' . addslashes($value->name) . '\');"
                                                                    id="checkbox_'.trim($value->id).'">
                                                                    <span class="ps-variant__tooltip">'.$value->name.'</span>
                                                                    <span class="ps-variant__size">'.$value->name.'</span>
                                                            </div>';
                                                    }
                                                ?>
                                            </figure>

                                            
                                            <div id="loaderColors" class="loaderColors" style="display:none;">
                                                <div class="loaderColors-inner">
                                                    <div class="loaderColors-text">  
                                                        <img src="http://ecommerce/assets/img/ajax_clock_small.gif" alt="">Cargando...
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">

                                            <figure class="figureColors">
                                
                                                <figcaption>Color: <strong> Choose an option</strong></figcaption>
                                                
                                                <div class="color-selector">
                                                    <img src="http://ecommerce/assets/img/ajax_clock_small.gif" alt="" class="imgLoad" style="display:none;">   
                                                    <?php
                                                        foreach($productcolors as $key => $value){
                                                            echo '<div class="color-option" style="background-color: '.$value->color.'; " title="'.$value->color.'"></div>';
                                                        }
                                                    ?>
                                                </div>

                                            </figure>

                                        </div>
                                    </div>

                                </div>

                                <!--<div class="ps-product__countdown">

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

                                </div>-->
                                
                                
                                <figcaption class="Quantity">¡Últimas unidades disponibles!</figcaption>
                                
                                <div class="ps-product__shopping">
                                                        
                                    <figure>

                                        <div id="loaderQuantity" class="loaderQuantity" style="display:none;">
                                            <div class="loaderQuantity-inner">
                                                <div class="loaderQuantity-text">
                                                    <img src="http://ecommerce/assets/img/ajax_clock_small.gif" alt=""> Cargando...
                                                </div>
                                            </div>
                                        </div>

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

                                    <div class="ps-product__actions addHeart">
                                        
                                        <?php if(!$productWish){ ?>
                                          
                                            <a id="heart-icon-<?php echo $product->id; ?>" onClick="addHeart( <?php echo $product->id; ?> );">
                                                <i class="icon-heart"></i>
                                            </a>

                                        <?php }else{ ?>

                                            <a id="wish-message-a-<?php echo $product->id; ?>" 
                                               class="wish-message-a"
                                               onClick="removeHeart( <?php echo $product->id; ?>, true );">

                                                <span class="icon">&#10084;</span>

                                            </a>

                                        <?php }; ?>
                                        <!--<div id="wish-message" class="wish-message"><span class="icon">&#10084;</span></div>-->

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
                                        <?php
                                            $specifications = json_decode($product->specifications, true); // Decodificar JSON a array asociativo

                                            foreach ($specifications as $section) {
                                                echo '<table class="table table-bordered ps-table ps-table--specification">';
                                                echo '<thead>';
                                                echo '<tr><th colspan="2">' . $section['title'] . '</th></tr>'; // Título de la sección
                                                echo '</thead>';
                                                echo '<tbody>';

                                                foreach ($section['rows'] as $row) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row['label'] . '</td>';  // Etiqueta
                                                    echo '<td>' . $row['value'] . '</td>';  // Valor
                                                    echo '</tr>';
                                                }

                                                echo '</tbody>';
                                                echo '</table>';
                                            }
                                        ?>
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

                        <P style="color:#0A8800; padding-left:0px; text-align:center; font-size:17px;font-weight:500;">
                            <img src="https://aimg.kwcdn.com/upload_aimg/goods_details/87c09de6-8255-42f6-bf67-efc20ede0399.png.slim.png?imageView2/2/w/40/q/70/format/webp" alt="">
                            Seguridad y privacidad
                        </P>


                        <p><i class="icon-network"></i> Envió Gratis en cada pedido</p>

                        <p><i class="icon-3d-rotate"></i> Entraga por via maritima: 10 - 31 ene</p>

                        <p><i class="icon-receipt"></i> Empresa de Mensajería. 
                        <span><img style="height:17px; width:auto; margin-right:5px;" src="https://aimg.kwcdn.com/upload_aimg/br/11478175-a10d-48b0-8050-2f61f42b9aaa.png.slim.png?imageView2/2/w/48/q/70/format/webp" alt=""> Coordinadora</span></p>

                        <p><i class="icon-credit-card"></i> Pagos online </p>
                            
                        <p><i class="icon-receipt"></i>Pagos seguros.</p>

                        <p><i class="icon-credit-card"></i> Privacidad segura</p>

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

<script type="text/javascript">
    const BASE_URL = "<?= base_url(); ?>";
</script>

<script src="<?php echo base_url().'/assets/js/product.js';?>"></script>
<?php  echo $this->endSection("content"); ?>