<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>

    <!--=====================================
    Breadcrumb
    ======================================-->  
	
	<div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="index.html">Home</a></li>

                <li><a href="shopping-car.html">My Wishes</a></li>

            </ul>

        </div>

    </div>

    <!--=====================================
    My Account Content
    ======================================--> 

    <div class="ps-vendor-dashboard pro">

        <div class="container">

            <div class="ps-section__header">

                <!--=====================================
                Profile
                ======================================--> 

                <aside class="ps-block--store-banner">

                    <div class="ps-block__user">

                        <div class="ps-block__user-avatar">

                            <img src="img/vendor/store/user/5.jpg" alt="">

                            <div class="br-wrapper">

                               <button class="btn btn-primary btn-lg rounded-circle"><i class="fas fa-pencil-alt"></i></button>

                            </div>

                            <div class="br-wrapper br-theme-fontawesome-stars mt-3">

                                <select class="ps-rating" data-read-only="true" style="display: none;">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                </select>

                            </div>

                        </div>

                        <div class="ps-block__user-content text-center text-lg-left">

                            <h2 class="text-white">Gilbert Maxiliun</h2>

                            <p><i class="fas fa-user"></i> maximiluin</p>

                            <p><i class="fas fa-envelope"></i> gopro@gmail.com</p>

                            <button class="btn btn-warning btn-lg">Change Password</button>

                        </div>

                        <div class="row ml-lg-auto pt-5">

                            <div class="col-lg-3 col-6">
                                <div class="text-center">
                                    <a href="#">
                                        <h1><i class="fas fa-shopping-cart text-white"></i></h1>
                                        <h4 class="text-white">Orders <span class="badge badge-secondary rounded-circle">51</span></h4>
                                    </a>
                                </div>
                            </div><!-- box /-->
                
                            <div class="col-lg-3 col-6">
                                <div class="text-center">
                                    <a href="#">
                                        <h1><i class="fas fa-shopping-bag text-white"></i></h1>
                                        <h4 class="text-white">Products <span class="badge badge-secondary rounded-circle">51</span></h4>
                                    </a>
                                </div>
                            </div><!-- box /-->
                
                            <div class="col-lg-3 col-6">
                                <div class="text-center">
                                    <a href="#">
                                        <h1><i class="fas fa-bell text-white"></i></h1>
                                        <h4 class="text-white">Disputes <span class="badge badge-secondary rounded-circle">51</span></h4>
                                    </a>
                                </div>
                            </div><!-- box /-->
                
                            <div class="col-lg-3 col-6">
                                <div class="text-center">
                                    <a href="#">
                                        <h1><i class="fas fa-comments text-white"></i></h1>
                                        <h4 class="text-white">Messages <span class="badge badge-secondary rounded-circle">51</span></h4>
                                    </a>
                                </div>
                            </div><!-- box /-->
                        </div>

                    </div>

                </aside><!-- s -->

                <!--=====================================
                Nav Account
                ======================================--> 
   
                <div class="ps-section__content">

                    <ul class="ps-section__links">
                        <li class="active"><a href="<?php echo base_url().'wishes' ?>">My Wishlist</a></li>
                        <li><a href="<?php echo base_url().'shopping' ?>">My Shopping</a></li>
                    </ul>

                    <!--=====================================
                    Wishlist
                    ======================================--> 

                    <div class="table-responsive">

                        <table class="table ps-table--whishlist dt-responsive">

                            <thead>

                                <tr>               

                                    <th>Product name</th>

                                    <th>Unit Price</th>

                                    <th>Stock Status</th>

                                    <th></th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody>

                                <!-- Product -->
                                <?php
                                    foreach($productsWish as $key => $value){
                                        echo '<tr>
                                                <td>
                                                    <div class="ps-product--cart">
                                                        <div class="ps-product__thumbnail">
                                                            <a href="'.base_url().'product/'.$value->slug.'"><img src="'.base_url().$value->image.'" alt=""></a>
                                                        </div>
                                                        <div class="ps-product__content">
                                                            <a href="'.base_url().'product/'.$value->slug.'">'.$value->name.'</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="price">$'.number_format($value->sale_price).'</td>
                                                <td><span class="ps-tag ps-tag--in-stock">In-stock</span></td>
                                                <td><a class="ps-btn" href="#">Add to cart</a></td>
                                                <td><a class="remove-item" onClick="removeHeart( '.$value->id.', this, true );"><i class="icon-cross"></i></a></td>
                                            </tr>';
                                    }
                                ?>

    
                            </tbody>

                        </table>

                    </div>

                </div>

 
            </div>

        </div>

    </div>

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

    <hr>

<script type="text/javascript">
    const BASE_URL = "<?= base_url(); ?>";
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
<script src="<?php echo base_url().'/assets/js/wishes.js';?>"></script>
<?php  echo $this->endSection("content"); ?>