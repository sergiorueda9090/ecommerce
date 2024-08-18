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
                        <li><a href="<?php echo base_url().'wishes' ?>">My Wishlist</a></li>
                        <li class="active"><a href="<?php echo base_url().'shopping' ?>">My Shopping</a></li>
                    </ul>

                    <!--=====================================
                    My Shopping
                    ======================================--> 

                    <div class="table-responsive">

                        <table class="table ps-table--whishlist dt-responsive" width="100%">

                            <thead>

                                <tr>      

                                    <th>Product name</th>

                                    <th>Proccess</th>

                                    <th>Price</th>

                                    <th>Quantity</th>

                                    <th>Review</th>

                                </tr>

                            </thead>

                            <tbody>

                                <!-- Product -->

                                <tr>

                                    <td>

                                        <div class="ps-product--cart">

                                            <div class="ps-product__thumbnail">

                                                <a href="product-default.html">
                                                    <img src="img/products/electronic/1.jpg" alt="">
                                                </a>
                                                
                                            </div>

                                            <div class="ps-product__content">

                                                <a href="product-default.html">Marshall Kilburn Wireless Bluetooth Speaker, Black (A4819189)</a>

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        <ul class="timeline">
                                            <li class="success">                                             
                                                <h5>15 March, 2020</h5>
                                                <p class="text-success">Reviewed <i class="fas fa-check"></i></p>

                                                <div class="media border p-3">
                                                  <div class="media-body">
                                                    <h4><small><i>Dispute on march 17, 2020</i></small></h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates hic maxime modi commodi.</p>
                                                  </div>
                                                  <img src="img/vendor/store/user/5.jpg" alt="John Doe" class="ml-3 mt-3 rounded-circle" style="width:60px;">
                                                </div>

                                                <div class="media border p-3">

                                                  <img src="img/vendor/vendor-store.jpg" alt="John Doe" class="ml-3 mt-3 rounded-circle" style="width:60px;">
                                                  <div class="media-body text-right">
                                                    <h4><small><i>Answer on march 17, 2020</i></small></h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates hic maxime modi commodi.</p>
                                                  </div>
                                                 
                                                </div>

                                            </li>
                                            <li  class="success">
                                                <h5>18 March, 2020</h5>         
                                                <p class="text-success">Sent <i class="fas fa-check"></i></p>
                                                <p>Comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat recusandae <br><a href="#" target="_blank">ID TRACK A24S36343DWS4</a></p>
                                            </li>
                                            <li  class="success">
                                                <h5>23 March, 2020</h5>  
                                                <p class="text-success">Delivered <i class="fas fa-check"></i></p>
                                                <p>Comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat recusandae necessitatibus nesciunt</p>
                                            </li>
                                        </ul>  

                                         <a class="btn btn-warning btn-lg" href="#">Repurchase</a>

                                    </td> 

                                    <td class="price text-center">$108.00</td>

                                    <td class="text-center">2</td>

                                    <td>

                                        <div class="text-center  mt-2">

                                            <div class="br-theme-fontawesome-stars">

                                                <select class="ps-rating" data-read-only="true" style="display: none;">
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="2">5</option>
                                                </select>

                                            </div>

                                            <a class="btn btn-warning btn-lg" href="#">Add comment</a>

                                        </div>

                                    </td>

                                </tr>

                                <!-- Product -->

                                <tr>        

                                    <td>

                                        <div class="ps-product--cart">

                                            <div class="ps-product__thumbnail">

                                                <a href="product-default.html">

                                                    <img src="img/products/clothing/2.jpg" alt="">

                                                </a>
                                            </div>

                                            <div class="ps-product__content">

                                                <a href="product-default.html">Unero Military Classical Backpack</a>

                                            </div>

                                        </div>
                                   
                                    </td>

                                    <td>

                                        <ul class="timeline">
                                            <li class="success">                                             
                                                <h5>15 March, 2020</h5>
                                                <p class="text-success">Reviewed <i class="fas fa-check"></i></p>
                                                <p>Comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat recusandae necessitatibus nesciunt</p>
                                            </li>
                                            <li  class="success">
                                                <h5>18 March, 2020</h5>         
                                                <p class="text-success">Sent <i class="fas fa-check"></i></p>
                                                 <p>Comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat recusandae <br><a href="#" target="_blank">ID TRACK A24S36343DWS4</a></p>
                                            </li>
                                            <li  class="process">
                                                <h5>23 March, 2020</h5>  
                                                <p>Delivered</p>
                                                <button class="btn btn-primary" disabled>
                                                  <span class="spinner-border spinner-border-sm"></span>
                                                  In process
                                                </button>
                                            </li>
                                        </ul>

                                        <a class="btn btn-danger btn-lg" href="#">Open Dispute</a>

                                    </td>
  

                                    <td class="price text-center">$205.00</td>

                                    <td class="text-center">1</td>

                                    <td>

                                        <div class=" text-center mt-2">

                                            <div class="br-theme-fontawesome-stars">

                                                <select class="ps-rating" data-read-only="true" style="display: none;">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="1">5</option>
                                                </select>

                                            </div>

                                            <a class="btn btn-warning btn-lg disabled" href="#">Add comment</a>

                                        </div>

                                    </td>

                                </tr>

                                <!-- Product -->

                                <tr>        

                                    <td>

                                        <div class="ps-product--cart">

                                            <div class="ps-product__thumbnail">

                                                <a href="product-default.html">

                                                    <img src="img/products/electronic/15.jpg" alt="">

                                                </a>
                                            </div>

                                            <div class="ps-product__content">

                                                <a href="product-default.html">XtremepowerUS Stainless Steel Tumble Cloths Dryer</a>

                                            </div>

                                        </div>
                                   
                                    </td>

                                    <td>

                                        <ul class="timeline">
                                            <li class="process">                                             
                                                <h5>15 March, 2020</h5>
                                                <p class="text-danger">Reviewed <i class="fas fa-times"></i></p>

                                                <div class="media border p-3">
                                                  <div class="media-body">
                                                    <h4><small><i>Dispute on march 17, 2020</i></small></h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates hic maxime modi commodi.</p>
                                                  </div>
                                                  <img src="img/vendor/store/user/5.jpg" alt="John Doe" class="ml-3 mt-3 rounded-circle" style="width:60px;">
                                                </div>

                                                <div class="media border p-3">

                                                  <img src="img/vendor/vendor-store.jpg" alt="John Doe" class="ml-3 mt-3 rounded-circle" style="width:60px;">
                                                  <div class="media-body text-right">
                                                    <h4><small><i>Answer on march 17, 2020</i></small></h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates hic maxime modi commodi.</p>
                                                  </div>
                                                 
                                                </div>

                                            </li>
                                            <li  class="process">
                                                <h5>18 March, 2020</h5>         
                                                <p class="text-danger">Sent <i class="fas fa-times"></i></p>
                                                <p>Comment: Order canceled</p>
                                               
                                            </li>
                                            <li  class="process">
                                                <h5>23 March, 2020</h5>  
                                                <p class="text-danger">Delivered <i class="fas fa-times"></i></p>
                                                <p>Comment: Order canceled</p>
                                                
                                            </li>
                                        </ul>

                                        <a class="btn btn-danger btn-lg" href="#">Open Dispute</a>

                                    </td>
  

                                    <td class="price text-center">$205.00</td>

                                    <td class="text-center">1</td>

                                    <td>

                                        <div class=" text-center mt-2">

                                            <div class="br-theme-fontawesome-stars">

                                                <select class="ps-rating" data-read-only="true" style="display: none;">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                                    <option value="1">4</option>
                                                    <option value="1">5</option>
                                                </select>

                                            </div>

                                            <a class="btn btn-warning btn-lg disabled" href="#">Add comment</a>

                                        </div>

                                    </td>

                                </tr>
            
                            </tbody>

                        </table>

                    </div><!-- End My Shopping -->

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

<?php  echo $this->endSection("content"); ?>