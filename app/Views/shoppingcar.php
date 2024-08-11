<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>
    <!--=====================================
    Breadcrumb
    ======================================-->  
	
	<div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="index.html">Home</a></li>

                <li>Shopping cart</li>

            </ul>

        </div>

    </div>

    <!--=====================================
    Shopping Car
    ======================================--> 

    <div class="ps-section--shopping ps-shopping-cart">

        <div class="container">

            <div class="ps-section__header">

                <h1>Shopping Cart</h1>

            </div>

            <div class="ps-section__content">

                <div class="table-responsive text-center">

                    <table class="table ps-table--shopping-cart">

                        <thead>

                            <tr>
                                <th>Product name</th>
                                <th>PRICE</th>
                                <th>SHIPPING</th>
                                <!--<th>QUANTITY</th>-->
                                <th>TOTAL</th>
                                <th></th>

                            </tr>

                        </thead>

                        <tbody class="tb_shoppingcar">
                        </tbody>

                    </table>

                </div>

                <hr>

                <div class="d-flex flex-row-reverse">
                  <div class="p-2"><h3>Total <span class="shoppingTotal">$414.00</span></h3></div>             
                </div>

                <div class="ps-section__cart-actions">

                    <a class="ps-btn" href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url(); ?>">
                        <i class="icon-arrow-left"></i> Back to Shop
                    </a>

                    <a class="ps-btn" href="<?php echo base_url().'checkout'; ?>">
                        Proceed to checkout <i class="icon-arrow-right"></i> 
                    </a>

                </div>

            </div> 
            
        </div>

    </div>

    <!--=====================================
	Footer
	======================================-->

    <hr>  

<script src="<?php echo base_url().'/assets/js/shoppingcar.js';?>"></script>
<?php  echo $this->endSection("content"); ?>