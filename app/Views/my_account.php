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
                        <li><a href="<?php echo base_url().'wishes' ?>">My Wishlist</a></li>
                        <li><a href="<?php echo base_url().'shopping' ?>">My Shopping</a></li>
                        <li class="active"><a href="<?php echo base_url().'account' ?>">My Account</a></li>
                    </ul>

                    <!--=====================================
                    INFORMACION CUSTOMER
                    ======================================--> 

                    <div class="container">
                        <div class="row">

                            <div class="col-4">

                                <div class="list-group" id="list-tab" role="tablist">

                                    <div class="text-center">
                                        <img style="width:170px; height:170px" src="<?php echo base_url(); ?>assets/img/001-man.svg" class="rounded" alt="...">
                                    </div>

                                    <h4>Sergio Rueda</h4>

                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Mi perfil</a>
                                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Actualizar información</a>
                                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Actualizar contraseña </a>
                                        <a class="list-group-item list-group-item-action" id="list-bought-list" data-toggle="list" href="#list-bought" role="tab" aria-controls="bought">Mis compras</a>
                                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">cerrar sesion</a>
                                        
                                    </div>

                                </div>

                            </div>

                            <div class="col-7 mt-5">

                                <div class="tab-content" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                        <!-- MY PROFIEL -->
                                            <?php include_once 'template/profielAccount.php'; ?>
                                        <!-- end PROFIEL -->
                                    </div>

                                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                        <!-- MY UPDATE INFORMATION -->
                                            <?php include_once 'template/updateInformatioAccount.php'; ?>
                                        <!-- end UPDATE INFORMATION -->
                                    </div>

                                    <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                                        <!-- MY UPDATE INFORMATION -->
                                           <?php include_once 'template/changePasswordAccount.php'; ?>
                                        <!-- end UPDATE INFORMATION -->
                                    </div>
                                    
                                    <div class="tab-pane fade" id="list-bought" role="tabpanel" aria-labelledby="list-bought-list">

                                        <!-- MY UPDATE INFORMATION -->
                                            <?php include_once 'template/boughtAccount.php'; ?>
                                        <!-- end UPDATE INFORMATION -->

                                    </div>

                                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">Amaya</div>
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
<script src="<?php echo base_url().'/assets/js/profielAccount.js';?>"></script>
<?php  echo $this->endSection("content"); ?>