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
                                                <td>
                                                    <a class="remove-item" onClick="removeHeart( '.$value->id.', this, true );"><i class="icon-cross"></i></a>
                                                  
                                                    <a class="d-none removeloadingwish"><img src="'.base_url().'assets/img/ajax_clock_small.gif'.'" alt=""></a>
                                                </td>
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