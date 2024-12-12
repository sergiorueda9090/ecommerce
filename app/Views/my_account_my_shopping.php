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
                Nav Account
                ======================================--> 
   
                <div class="ps-section__content">

                    <ul class="ps-section__links">
                        <li><a href="<?php echo base_url().'wishes' ?>">My Wishlist</a></li>
                        <li class="active"><a href="<?php echo base_url().'shopping' ?>">My Shopping</a></li>
                        <li><a href="<?php echo base_url().'account' ?>">My Account</a></li>
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

                                <?php

                                    foreach($orders as $key => $value){
                                        // Fecha y hora de la compra
                                        $fechaCompra = $value->created_at;

                                        // Crear un objeto DateTime
                                        $fecha = new DateTime($fechaCompra);

                                        // Formatear la fecha
                                        $formatoAmigable = $fecha->format('d/m/Y \a \l\a\s h:i A'); // Ejemplo: 23/08/2024 a las 10:14 PM

                                        
                                        echo '        <tr>

                                    <td>

                                        <div class="ps-product--cart">

                                            <div class="ps-product__thumbnail">

                                                <a href="product-default.html">
                                                    <img src="'.base_url().$value->image.'" alt="">
                                                </a>
                                                
                                            </div>

                                            <div class="ps-product__content">

                                                <a href="'.base_url().$value->slug.'">'.$value->name.'</a>

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        <ul class="timeline">
                                            <li class="success">                                             
                                                <h5> Compra realizada el '.$formatoAmigable.'</h5>
                                                <p class="text-success">Reviewed 
                                                    <i class="fas fa-check"></i> 
                                                    <a href="'.base_url().'factura/'.$value->transactions_id.'" ><i class="icon-receipt" style="color:red" title="Factura"></i></a> 
                                                </p>

                                                <div class="media border p-3" style="display:none">
                                                  <div class="media-body">
                                                    <h4><small><i>Dispute on march 17, 2020</i></small></h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates hic maxime modi commodi.</p>
                                                  </div>
                                                  <img src="img/vendor/store/user/5.jpg" alt="John Doe" class="ml-3 mt-3 rounded-circle" style="width:60px;">
                                                </div>

                                                <div class="media border p-3" style="display:none">

                                                  <img src="img/vendor/vendor-store.jpg" alt="John Doe" class="ml-3 mt-3 rounded-circle" style="width:60px;">
                                                  <div class="media-body text-right">
                                                    <h4><small><i>Answer on march 17, 2020</i></small></h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates hic maxime modi commodi.</p>
                                                  </div>
                                                 
                                                </div>

                                            </li>

                                            <li  class="success">
                                                <h5> ¡Tu compra ha sido confirmada! Nos encontramos preparando tu envío para que llegue lo antes posible ✔️.</h5>
                                                <h5>'.$formatoAmigable.'</h5>
                                                <button class="btn btn-primary" disabled>
                                                  <span class="spinner-border spinner-border-sm"></span>
                                                  In process
                                                </button>         
                                                <p style="display:none" class="text-success">Sent <i class="fas fa-check"></i></p>
                                                <p style="display:none">Comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat recusandae <br><a href="#" target="_blank">ID TRACK A24S36343DWS4</a></p>
                                            </li>
                                            <li  class="success" style="display:none">
                                                <h5>23 March, 2020</h5>  
                                                <p class="text-success">Delivered <i class="fas fa-check"></i></p>
                                                <p>Comment: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum quaerat recusandae necessitatibus nesciunt</p>
                                            </li>
                                        </ul>  

                                         <a class="btn btn-warning btn-lg" href="#"  style="display:none">Repurchase</a>

                                    </td> 

                                    <td class="price text-center">$'.number_format($value->price).'</td>

                                    <td class="text-center">'.$value->quantity.'</td>

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

                                            <a class="btn btn-warning btn-lg uploadModalCommet" data-toggle="modal" data-target="#uploadModal" comment="'.$value->id.'">Add comment</a>

                                        </div>

                                    </td>

                                </tr>';

                                    }
                                ?>
                        

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
        <!-- Modal -->
        <?php include_once 'template/commetModal.php'; ?>
        <!--end Modal -->
    </div>
  
    <!--=====================================
	Footer
	======================================-->

    <hr>

<script type="text/javascript">
    const BASE_URL = "<?= base_url(); ?>";
</script>
<script src="<?php echo base_url().'/assets/js/myaccountshopping.js';?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>

<?php  echo $this->endSection("content"); ?>