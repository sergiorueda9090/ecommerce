<?php
// Start the session
$session = session();
?>

<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

	<title>MarketPlace | Home</title>

	<link rel="icon" href="<?php echo base_url().'/assets/img/template/icono.png'?>">

	<!--=====================================
	CSS
	======================================-->
	
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&display=swap" rel="stylesheet">

	<!-- font awesome -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/fontawesome.min.css';?>">

	<!-- linear icons -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/linearIcons.css';?>">

	<!-- Bootstrap 4 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/owl.carousel.css';?>">

	<!-- Slick -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/slick.css';?>">

	<!-- Light Gallery -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/lightgallery.min.css';?>">

	<!-- Font Awesome Start -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/fontawesome-stars.css';?>">

	<!-- jquery Ui -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/jquery-ui.min.css';?>">

	<!-- Select 2 -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/select2.min.css';?>">

	<!-- Scroll Up -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/scrollUp.css';?>">
    
    <!-- DataTable -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/dataTables.bootstrap4.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'/assets/css/plugins/responsive.bootstrap.datatable.min.css';?>">
	
	<!-- estilo principal -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/style.css';?>">

	<!-- Market Place 4 -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/market-place-4.css';?>">

	<!-- PRODUCT -->
	<link rel="stylesheet" href="<?php echo base_url().'/assets/css/product/style.css';?>">
	
	<!--=====================================
	PLUGINS JS
	======================================-->

	<!-- jQuery library -->
	<script src="<?php echo base_url().'/assets/js/plugins/jquery-1.12.4.min.js';?>"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<!-- Owl Carousel -->
	<script src="<?php echo base_url().'/assets/js/plugins/owl.carousel.min.js';?>"></script>

	<!-- Images Loaded -->
	<script src="<?php echo base_url().'/assets/js/plugins/imagesloaded.pkgd.min.js';?>"></script>

	<!-- Masonry -->
	<script src="<?php echo base_url().'/assets/js/plugins/masonry.pkgd.min.js';?>"></script>

	<!-- Isotope -->
	<script src="<?php echo base_url().'/assets/js/plugins/isotope.pkgd.min.js';?>"></script>

	<!-- jQuery Match Height -->
	<script src="<?php echo base_url().'/assets/js/plugins/jquery.matchHeight-min.js';?>"></script>

	<!-- Slick -->
	<script src="<?php echo base_url().'/assets/js/plugins/slick.min.js';?>"></script>

	<!-- jQuery Barrating -->
	<script src="<?php echo base_url().'/assets/js/plugins/jquery.barrating.min.js';?>"></script>

	<!-- Slick Animation -->
	<script src="<?php echo base_url().'/assets/js/plugins/slick-animation.min.js';?>"></script>

	<!-- Light Gallery -->
	<script src="<?php echo base_url().'/assets/js/plugins/lightgallery-all.min.js';?>"></script>

	<!-- jQuery UI -->
	<script src="<?php echo base_url().'/assets/js/plugins/jquery-ui.min.js';?>"></script>

	<!-- Sticky Sidebar -->
	<script src="<?php echo base_url().'/assets/js/plugins/sticky-sidebar.min.js';?>"></script>

	<!-- Slim Scroll -->
	<script src="<?php echo base_url().'/assets/js/plugins/jquery.slimscroll.min.js';?>"></script>

	<!-- Select 2 -->
	<script src="<?php echo base_url().'/assets/js/plugins/select2.full.min.js';?>"></script>

	<!-- Scroll Up -->
	<script src="<?php echo base_url().'/assets/js/plugins/scrollUP.js';?>"></script>

    <!-- DataTable -->
    <script src="<?php echo base_url().'/assets/js/plugins/jquery.dataTables.min.js';?>"></script>
    <script src="<?php echo base_url().'/assets/js/plugins/dataTables.bootstrap4.min.js';?>"></script>
    <script src="<?php echo base_url().'/assets/js/plugins/dataTables.responsive.min.js';?>"></script>

    <!-- Chart -->
    <script src="<?php echo base_url().'/assets/js/plugins/Chart.min.js';?>"></script>
	<style>
		.shaded {
			background-color: rgba(0, 0, 0, 0.1); /* Adjust opacity as needed */
		}

	
		.brands{
			display:flex; flex-wrap:wrap; justify-content:center; gap:1.5em 1em;
		}

		.brand-logo{
			max-height: 56px; width: calc(20% - 1em); display: flex;
			 flex-direction: column; border-radius: 8px;
			  background-color: white; 
			  border: solid 1px rgb(225, 224, 224); 
			  overflow: hidden; 
			  text-decoration: none !important; 
			transition: background-color .5s ease;
		}

		.brand-logo img {
			min-height: 56px;
			align-self: center;
			justify-self: center;
			aspect-ratio: 19 / 10;
			object-fit: cover;
			transition: transform .5s ease;
		}

		.brand-logo:hover img, .brand-logo:focus img {
			transform: translateY(-56px);
		}

		.brand-logo p {
			min-height: 56px;
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 0;
			text-align: center;
			color: var(--text-color1);
			transition: transform .5s ease;
		}
		.brand-logo:hover p, .brand-logo:focus p {
			transform: translateY(-56px);
		}

	</style>

</head>
	<!--=====================================
	Header Promotion
	======================================-->

	<div class="ps-block--promotion-header bg--cover"  style="background: url(<?php echo base_url().'/assets/img/banner/top/header-promotion.jpg);'?>">
        <div class="container">
            <div class="ps-block__left">
                <h3>20%</h3>
                <figure>
                    <p>Discount</p>
                    <h4>For Books Of March</h4>
                </figure>
            </div>
            <div class="ps-block__center">
                <p>Enter Promotion<span>Sale2019</span></p>
            </div><a class="ps-btn ps-btn--sm" href="#">Shop now</a>
        </div>
    </div>

    <!--=====================================
	Header
	======================================-->

    <header class="header header--standard header--market-place-4" data-sticky="true">

    	<!--=====================================
		Header TOP
		======================================-->

        <div class="header__top">

            <div class="container">

            	<!--=====================================
				Social 
				======================================-->

                <div class="header__left">
                    <ul class="d-flex justify-content-center">
						<?php 
							//var_dump($header);
							
							foreach($header['socialNetworkResponse'] as $key => $heade){

								echo '<li><a href="'.$heade->url.'" target="_blank">'.$heade->icon.'</i></a></li>';

							}

						?>
					</ul>
                </div>

                <!--=====================================
				Contact & lenguage 
				======================================-->

                <div class="header__right">
                    <ul class="header__top-links"> 
                    	                   
                        <li>
                            <div class="ps-dropdown language"><a href="#"><img src="<?php echo base_url().'/assets/img/template/en.png'?>" alt="">English</a>
                                <ul class="ps-dropdown-menu">
                                    <li><a href="#"><img src="<?php echo base_url().'/assets/img/template/es.png'?>" alt=""> Spanish</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

            </div><!-- End Container -->

        </div><!-- Header Top -->

      	<!--=====================================
		Header Content
		======================================-->

        <div class="header__content">

            <div class="container">

                <div class="header__content-left">

                	<!--=====================================
					Logo
					======================================-->

                	<a class="ps-logo" href="<?php echo base_url() ?>">
                		<img src="<?php echo base_url().'/assets/img/template/logo_light.png'?>" alt="">
                	</a>

                	<!--=====================================
					Menú
					======================================-->

                    <div class="menu--product-categories">
                        
                        <div class="menu__toggle">
                        	<i class="icon-menu"></i>
                        	<span> Shop by Department</span>
                        </div>

                        <div class="menu__content">
                            <ul class="menu--dropdown">
								<?php

									foreach($categories as $key => $category){
										echo '
											<li>
												<a href='.base_url().'category/'.$category->slug.'><i class='.$category->icon.'></i>'.$category->name.'</a>
											</li>
										';
									}
								
								?>
                                <!--<li>
                                	<a href="#"><i class="icon-star"></i> Hot Promotions</a>
                                </li>
                                <li class="menu-item-has-children has-mega-menu">
                                	<a href="#"><i class="icon-laundry"></i> Consumer Electronic</a>
                                    <div class="mega-menu">
                                        <div class="mega-menu__column">
                                            <h4>Electronic<span class="sub-toggle"></span></h4>
                                            <ul class="mega-menu__list">
                                                <li><a href="#">Home Audio &amp; Theathers</a>
                                                </li>
                                                <li><a href="#">TV &amp; Videos</a>
                                                </li>
                                                <li><a href="#">Camera, Photos &amp; Videos</a>
                                                </li>
                                                <li><a href="#">Cellphones &amp; Accessories</a>
                                                </li>
                                                <li><a href="#">Headphones</a>
                                                </li>
                                                <li><a href="#">Videosgames</a>
                                                </li>
                                                <li><a href="#">Wireless Speakers</a>
                                                </li>
                                                <li><a href="#">Office Electronic</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="mega-menu__column">
                                            <h4>Accessories &amp; Parts<span class="sub-toggle"></span></h4>
                                            <ul class="mega-menu__list">
                                                <li><a href="#">Digital Cables</a>
                                                </li>
                                                <li><a href="#">Audio &amp; Video Cables</a>
                                                </li>
                                                <li><a href="#">Batteries</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-shirt"></i> Clothing &amp; Apparel</a>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-lampshade"></i> Home, Garden &amp; Kitchen</a>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-heart-pulse"></i> Health &amp; Beauty</a>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-diamond2"></i> Yewelry &amp; Watches</a>
                                </li>
                                <li class="menu-item-has-children has-mega-menu">
                                	<a href="#"><i class="icon-desktop"></i> Computer &amp; Technology</a>
                                    <div class="mega-menu">
                                        <div class="mega-menu__column">
                                            <h4>Computer &amp; Technologies<span class="sub-toggle"></span></h4>
                                            <ul class="mega-menu__list">
                                                <li><a href="#">Computer &amp; Tablets</a>
                                                </li>
                                                <li><a href="#">Laptop</a>
                                                </li>
                                                <li><a href="#">Monitors</a>
                                                </li>
                                                <li><a href="#">Networking</a>
                                                </li>
                                                <li><a href="#">Drive &amp; Storages</a>
                                                </li>
                                                <li><a href="#">Computer Components</a>
                                                </li>
                                                <li><a href="#">Security &amp; Protection</a>
                                                </li>
                                                <li><a href="#">Gaming Laptop</a>
                                                </li>
                                                <li><a href="#">Accessories</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-baby-bottle"></i> Babies &amp; Moms</a>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-baseball"></i> Sport &amp; Outdoor</a>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-smartphone"></i> Phones &amp; Accessories</a>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-book2"></i> Books &amp; Office</a>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-car-siren"></i> Cars &amp; Motocycles</a>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-wrench"></i> Home Improments</a>
                                </li>
                                <li>
                                	<a href="#"><i class="icon-tag"></i> Vouchers &amp; Services</a>
                                </li>-->
                            </ul>

                        </div>

                    </div><!-- End menu-->

                </div><!-- End Header Content Left-->

                <!--=====================================
				Search
				======================================-->

                <div class="header__content-center">
                    <form class="ps-form--quick-search" action="index.html" method="get">
                        <div class="form-group--icon">
                        	<i class="icon-chevron-down"></i>
                            <select class="form-control">
								<option value="1">All</option>
								<?php
								foreach($categories as $key => $category){
									echo ' <option value='.$category->slug.'>'.$category->name.'</option>
									';
								}
								?>
                            </select>
                        </div>
                        <input class="form-control" type="text" placeholder="I'm shopping for...">
                        <button>Search</button>
                    </form>
                </div>

                <div class="header__content-right">

                    <div class="header__actions">

                    	<!--=====================================
						Wishlist
						======================================-->
						<?php if($session->nameUser){ ?>
							<a class="header__extra" href="<?php echo base_url().'wishes'; ?>">
								<i class="icon-heart"> </i> <span class="totalwishes"> <i> <?php echo $header['resultwished']; ?> </i> </span>
							</a>
						<?php }else{ ?>

							<a class="header__extra" data-toggle="tooltip" data-placement="bottom" title="Para agregar productos a tu lista de deseos, por favor inicia sesión o regístrate.">
								<i class="icon-heart"> </i> <span class="totalwishes"> <i> 0 </i> </span>
							</a>

							<?php }?>

                    	<!--=====================================
						Cart
						======================================-->

                        <div class="ps-cart--mini showbag2">

                        	<a class="header__extra" href="#">
                        		<i class="icon-bag2"></i><span><i class="amountBag">0</i></span>
                        	</a>

                            <div class="ps-cart__content">

                                <div class="ps-cart__items">
                                </div>

                                <div class="ps-cart__footer">

                                    <h3>Sub Total two :<strong>$0</strong></h3>
                                    <figure>
                                    	<a class="ps-btn" href="<?php echo base_url().'shoppingcart';?>">View Cart</a>
                                    	<a class="ps-btn" href="<?php echo base_url()."checkout"; ?>">Checkout</a>
                                    </figure>

                                </div>

                            </div>

                        </div>

						<!--=====================================
						Login and Register
						======================================-->
                        <div class="ps-block--user-header">
                            <div class="ps-block__left">
                            	<i class="icon-user"></i>
                            </div>
                            <div class="ps-block__right">
								<?php
									if($session->nameUser){
										echo '<a href="'.base_url().'shopping'.'">'.$session->nameUser.'</a>
											 <a data-toggle="modal" data-target="#cerrarSessionModal">Cerrar sesión</a>';
									}else{
										echo '<a data-toggle="modal" data-target="#sessionModal"> Login</a>
											  <a href="'.base_url().'register'.'">Register</a>';
									}
								?>
                            </div>
                        </div>

                    </div><!-- End Header Actions-->

                </div><!-- End Header Content Right-->

            </div><!-- End Container-->

        </div><!-- End Header Content-->

    </header>

  	<!--=====================================
	Header Mobile
	======================================-->

    <header class="header header--mobile" data-sticky="true">

        <div class="header__top">

            <div class="header__left">

                <ul class="d-flex justify-content-center">
					<?php 

						foreach($header['socialNetworkResponse'] as $key => $heade){

							echo '<li><a href="'.$heade->url.'" target="_blank">'.$heade->icon.'</i></a></li>';

						}

					?>
				</ul>
            </div>

            <div class="header__right">

                <ul class="navigation__extra">
                  

                    <li>

                        <div class="ps-dropdown language"><a href="#"><img src="<?php echo base_url().'/assets/img/template/en.png'?>" alt="">English</a>

                            <ul class="ps-dropdown-menu">

                                <li><a href="#"><img src="<?php echo base_url().'/assets/img/template/es.png'?>" alt=""> Español</a></li>

                            </ul>

                        </div>

                    </li>

                </ul>

            </div>

        </div>

        <div class="navigation--mobile">

            <div class="navigation__left">

        	  	<!--=====================================
				Menu Mobile
				======================================-->

                <div class="menu--product-categories">
                    
                    <div class="ps-shop__filter-mb mt-4" id="filter-sidebar">
                    	<i class="icon-menu "></i>
                    </div>

	            	<div class="ps-filter--sidebar">

					    <div class="ps-filter__header">
					        <h3>Categories</h3><a class="ps-btn--close ps-btn--no-boder" href="#"></a>
					    </div>

					    <div class="ps-filter__content">

					        <aside class="widget widget_shop">

					            <ul class="ps-list--categories">
					                <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Clothing &amp; Apparel</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                    <ul class="sub-menu" style="display: none;">
					                        <li class="current-menu-item "><a href="shop-default.html">Womens</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Mens</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Bags</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Sunglasses</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Accessories</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Kid's Fashion</a>
					                        </li>
					                    </ul>
					                </li>
					                <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Garden &amp; Kitchen</a><span class="sub-toggle active"><i class="fa fa-angle-down"></i></span>
					                    <ul class="sub-menu" style="display: block;">
					                        <li class="current-menu-item "><a href="shop-default.html">Cookware</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Decoration</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Furniture</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Garden Tools</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Home Improvement</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Powers And Hand Tools</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Utensil &amp; Gadget</a>
					                        </li>
					                    </ul>
					                </li>
					                <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Consumer Electrics</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                    <ul class="sub-menu" style="">
					                        <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Air Conditioners</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                            <ul class="sub-menu" style="">
					                                <li class="current-menu-item "><a href="shop-default.html">Accessories</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Type Hanging Cell</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Type Hanging Wall</a>
					                                </li>
					                            </ul>
					                        </li>
					                        <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Audios &amp; Theaters</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                            <ul class="sub-menu" style="">
					                                <li class="current-menu-item "><a href="shop-default.html">Headphone</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Home Theater System</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Speakers</a>
					                                </li>
					                            </ul>
					                        </li>
					                        <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Car Electronics</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                            <ul class="sub-menu" style="">
					                                <li class="current-menu-item "><a href="shop-default.html">Audio &amp; Video</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Car Security</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Radar Detector</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Vehicle GPS</a>
					                                </li>
					                            </ul>
					                        </li>
					                        <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Office Electronics</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                            <ul class="sub-menu" style="">
					                                <li class="current-menu-item "><a href="shop-default.html">Printers</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Projectors</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Scanners</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Store &amp; Business</a>
					                                </li>
					                            </ul>
					                        </li>
					                        <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">TV Televisions</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                            <ul class="sub-menu" style="">
					                                <li class="current-menu-item "><a href="shop-default.html">4K Ultra HD TVs</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">LED TVs</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">OLED TVs</a>
					                                </li>
					                            </ul>
					                        </li>
					                        <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Washing Machines</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                            <ul class="sub-menu" style="">
					                                <li class="current-menu-item "><a href="shop-default.html">Type Drying Clothes</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Type Horizontal</a>
					                                </li>
					                                <li class="current-menu-item "><a href="shop-default.html">Type Vertical</a>
					                                </li>
					                            </ul>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Refrigerators</a>
					                        </li>
					                    </ul>
					                </li>
					                <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Health &amp; Beauty</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                    <ul class="sub-menu" style="">
					                        <li class="current-menu-item "><a href="shop-default.html">Equipments</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Hair Care</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Perfumer</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Skin Care</a>
					                        </li>
					                    </ul>
					                </li>
					                <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Computers &amp; Technologies</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                    <ul class="sub-menu" style="">
					                        <li class="current-menu-item "><a href="shop-default.html">Desktop PC</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Laptop</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Smartphones</a>
					                        </li>
					                    </ul>
					                </li>
					                <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Jewelry &amp; Watches</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                    <ul class="sub-menu" style="">
					                        <li class="current-menu-item "><a href="shop-default.html">Gemstone Jewelry</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Men's Watches</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Women's Watches</a>
					                        </li>
					                    </ul>
					                </li>
					                <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Phones &amp; Accessories</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                    <ul class="sub-menu" style="">
					                        <li class="current-menu-item "><a href="shop-default.html">Iphone 8</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Iphone X</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Sam Sung Note 8</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Sam Sung S8</a>
					                        </li>
					                    </ul>
					                </li>
					                <li class="current-menu-item menu-item-has-children"><a href="shop-default.html">Sport &amp; Outdoor</a><span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
					                    <ul class="sub-menu" style="">
					                        <li class="current-menu-item "><a href="shop-default.html">Freezer Burn</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Fridge Cooler</a>
					                        </li>
					                        <li class="current-menu-item "><a href="shop-default.html">Wine Cabinets</a>
					                        </li>
					                    </ul>
					                </li>
					                <li class="current-menu-item "><a href="shop-default.html">Babies &amp; Moms</a>
					                </li>
					                <li class="current-menu-item "><a href="shop-default.html">Books &amp; Office</a>
					                </li>
					                <li class="current-menu-item "><a href="shop-default.html">Cars &amp; Motocycles</a>
					                </li>
					            </ul>

					        </aside>   

					    </div>

					</div>        

                </div><!-- End menu-->

            	<a class="ps-logo pl-3 pl-sm-5" href="index.html">
            		<img src="<?php echo base_url().'/assets/img/template/logo_light.png'?>" class="pt-3" alt="">
            	</a>

            </div>

            <div class="navigation__right">

                <div class="header__actions">

                	<!--=====================================
					Cart
					======================================-->

                    <div class="ps-cart--mini showbag2">

                    	<a class="header__extra" href="#">
                    		<i class="icon-bag2"></i><span><i class="amountBag">0</i></span>
                    	</a>

                        <div class="ps-cart__content">

                            <div class="ps-cart__items">
                            </div>

                            <div class="ps-cart__footer">

                                <h3>Sub Total:<strong>$0</strong></h3>

                                <figure>
                                	<a class="ps-btn" href="shopping-cart.html">View Cart</a>
                                	<a class="ps-btn" href="checkout.html">Checkout</a>
                                </figure>

                            </div>

                        </div>

                    </div>

                    <!--=====================================
					Login and Register
					======================================-->

                    <div class="ps-block--user-header">

                        <div class="ps-block__left">
                        	<i class="icon-user"></i>
                        </div>
                        <div class="ps-block__right">
						<a data-toggle="modal" data-target="#sessionModal">Login 2</a>
                        	<a href="my-account.html">Register</a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--=====================================
		Search
		======================================-->

        <div class="ps-search--mobile">

            <form class="ps-form--search-mobile" action="index.html" method="get">
                <div class="form-group--nest">
                    <input class="form-control" type="text" placeholder="Search something...">
                    <button><i class="icon-magnifier"></i></button>
                </div>
            </form>

        </div>

    </header> <!-- End Header Mobile -->
<body>
    
<?php echo $this->renderSection('content'); ?>

   <!--=====================================
	Footer
	======================================-->  

    <footer class="ps-footer">

        <div class="container">

            <div class="ps-footer__widgets">

            	<!--=====================================
				Contact us
				======================================-->  

                <aside class="widget widget_footer widget_contact-us">

                    <h4 class="widget-title">Contact us</h4>

                    <div class="widget_content">

                        <p>Call us 24/7</p>
                        <h3><?php echo $pageInfo->numberglobal; ?></h3>
                        <p><?php echo $pageInfo->addres; ?> <br>
                        	<a href="mailto:contact@marketplace.co"><?php echo $pageInfo->email; ?></a>
                    	</p>

                        <ul class="ps-list--social">
                            <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a class="google-plus" href="#"><i class="fab fa-youtube"></i></a></li>
                            <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                        </ul>

                    </div>

                </aside>

                <!--=====================================
				Quick Links
				======================================-->  

                <aside class="widget widget_footer">

                    <h4 class="widget-title">Quick links</h4>

                    <ul class="ps-list--link">

                        <li><a href="#">Policy</a></li>

                        <li><a href="#">Term &amp; Condition</a></li>

                        <li><a href="#">Shipping</a></li>

                        <li><a href="#">Return</a></li>

                        <li><a href="faqs.html">FAQs</a></li>

                    </ul>

                </aside>

                <!--=====================================
				Company
				======================================-->  

                <aside class="widget widget_footer">

                    <h4 class="widget-title">Company</h4>

                    <ul class="ps-list--link">

                        <li><a href="about-us.html">About Us</a></li>

                        <li><a href="#">Affilate</a></li>

                        <li><a href="#">Career</a></li>

                        <li><a href="contact-us.html">Contact</a></li>

                    </ul>

                </aside>

                <!--=====================================
				Bussiness
				======================================-->  

                <aside class="widget widget_footer">

                    <h4 class="widget-title">Bussiness</h4>

                    <ul class="ps-list--link">

                        <li><a href="#">Our Press</a></li>

                        <li><a href="checkout.html">Checkout</a></li>

                        <li><a href="my-account.html">My account</a></li>

                        <li><a href="shop-default.html">Shop</a></li>

                    </ul>

                </aside>

            </div>

          	<!--=====================================
			Categories Footer
			======================================-->  
									
            <div class="ps-footer__links">
				<?php
					foreach($footer as $key => $value){
						echo '<p>
								<strong>'.$value->name.':</strong>';
								 // Obtener las subcategorías como un array y recorrerlas
								 $subcategoriesArray = explode(",",$value->subcategories);
								 foreach ($subcategoriesArray as $subcategory) {
									 echo '<a href="#">' . $subcategory . '</a>';
								 };
							echo'</p>';
					}
				?>
            </div>

            <!--=====================================
			CopyRight - Payment method Footer
			======================================-->  

            <div class="ps-footer__copyright">

                <p>© 2020 MarketPlace. All Rights Reserved</p>
			
                <p>
                	<span>We Using Safe Payment For:</span>

                	<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/1.jpg'?>" alt="">
                	</a>

                	<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/2.jpg'?>" alt="">
                	</a>

                	<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/4.jpg'?>" alt="">
                	</a>

                	<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/5.jpg'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-addi-v2.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-amex.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-banco-bogota.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-bancolombia.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-codensa.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-daviplata.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-davivienda.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-dinners-club.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-efecty.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-mastercard.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-nequi.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-pse.webp'?>" alt="">
                	</a>

					<a href="#">
                		<img src="<?php echo base_url().'/assets/img/payment-method/mp-sured.webp'?>" alt="">
                	</a>



                </p>

            </div>

        </div>

    </footer>

	
	<?php include_once 'iniciarSessionModal.php'; ?>
	<?php include_once 'cerrarSessionModal.php'; ?>
	<?php include_once 'forgetPasswordModal.php'; ?>
	<!--=====================================
	JS PERSONALIZADO
	======================================-->

	<script src="<?php echo base_url().'/assets/js/main.js';?>"></script>
	<script src="<?php echo base_url().'/assets/js/menu.js';?>"></script>
	
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-N8G9F22VD7"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-N8G9F22VD7');
		</script>
	
</body>
</html>

