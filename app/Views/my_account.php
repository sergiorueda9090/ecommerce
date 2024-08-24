<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>

    <!--=====================================
    Breadcrumb
    ======================================-->  
	
	<div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="<?php base_url() ?>">Home</a></li>

                <li><a href="<?php echo base_url().'wishes' ?>">My Wishes</a></li>

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
                        <li><a href="<?php echo base_url().'account' ?>">My Account</a></li>
                    </ul>

                    <!--=====================================
                    INFORMACION CUSTOMER
                    ======================================--> 

                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <div class="list-group">
                                    <div class="text-center">
                                        <img style="width:170px; height:170px" src="<?php echo base_url(); ?>assets/img/001-man.svg" class="rounded" alt="...">
                                    </div>
                                    <h4>Sergio Rueda</h4>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                            Mi perfil
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                            Compras
                                            <span class="badge badge-primary badge-pill">12</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-action">
                                            Cerrar session
                                        </li>
                                        </ul>
                                </div>
                            </div>

                           

                            <div class="col-7">

                                <div class="form-group">
                                    <label>First Name<sup>*</sup></label>
                                    <div class="form-group__content"><input class="form-control firstName" id="firstName" type="text"></div>
                                </div>

                                <div class="form-group">
                                    <label>Last Name<sup>*</sup></label>
                                    <div class="form-group__content"><input class="form-control firstName" id="firstName" type="text"></div>
                                </div>

                                <div class="form-group">
                                    <label>Email Address<sup>*</sup></label>
                                    <div class="form-group__content"><input class="form-control firstName" id="firstName" type="text"></div>
                                </div>

                                <div class="form-group">
                                    <label>Departamento<sup>*</sup></label>
                                    <div class="form-group__content"><input class="form-control firstName" id="firstName" type="text"></div>
                                </div>

                                <div class="form-group">
                                    <label>Ciudad<sup>*</sup></label>
                                    <div class="form-group__content"><input class="form-control firstName" id="firstName" type="text"></div>
                                </div>

                                <div class="form-group">
                                    <label>Phone<sup>*</sup></label>
                                    <div class="form-group__content"><input class="form-control firstName" id="firstName" type="text"></div>
                                </div>

                                <div class="form-group">
                                    <label>Address<sup>*</sup></label>
                                    <div class="form-group__content"><input class="form-control firstName" id="firstName" type="text"></div>
                                </div>

                                <div class="form-group">
                                    <label>contraseña<sup>*</sup></label>
                                    <div class="form-group__content"><input class="form-control firstName" id="firstName" type="password"></div>
                                </div>

                                <div class="form-group">
                                    <label>Confirmar contraseña<sup>*</sup></label>
                                    <div class="form-group__content"><input class="form-control firstName" id="firstName" type="password"></div>
                                </div>

                                <div class="form-group">
                                    <label>Addition information<sup>*</sup></label>
                                    <div class="form-group__content"><input class="form-control firstName" id="firstName" type="text"></div>
                                </div>


                            </div>

                        </div>
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