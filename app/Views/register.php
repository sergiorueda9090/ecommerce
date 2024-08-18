<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>

    <!--=====================================
    Breadcrumb
    ======================================-->  
	
	<div class="ps-breadcrumb">

        <div class="container">

            <ul class="breadcrumb">

                <li><a href="index.html">Home</a></li>

                <li><a href="shopping-car.html">Shopping cart</a></li>

                <li>Checkout</li>

            </ul>

        </div>

    </div>

    <!--=====================================
    Checkout
    ======================================--> 
    <div class="ps-checkout ps-section--shopping">

        <div class="container">

            <div class="ps-section__header">

                <h1>Register</h1>

            </div>

            <div class="ps-section__content">

                <form class="ps-form--checkout formPayu">

                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-sm-3"></div>

                        <div class="col-xl-6 col-lg-6 col-sm-6 formBilling">

                            <div class="ps-form__billing-info">

                            
                                <div class="form-group">

                                    <label>First Name<sup>*</sup></label>

                                    <div class="form-group__content">

                                        <input class="form-control firstName" id="firstName" type="text">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Last Name<sup>*</sup></label>

                                    <div class="form-group__content">

                                        <input class="form-control lastName" id="lastName" type="text">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Email Address<sup>*</sup></label>

                                    <div class="form-group__content">

                                        <input class="form-control email" id="email" type="email">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Departamento<sup>*</sup></label>

                                    <div class="form-group__content">

                                    <select name="deparments" class="form-control deparments" id="deparments">
                                        <option value="">Seleccionar</option>
                                        <?php
                                            foreach($deparments as $key => $value){
                                                echo '<option value='.$value['idDepartamento'].'>'.$value['despartamento'].'</option>';
                                            }
                                        ?>
                                    </select>

                                    </div>


                                </div>

                                <div class="form-group">

                                    <label>Ciudad<sup>*</sup></label>

                                    <div class="form-group__content" style="position: relative; display: flex; align-items: center;">

                                        <select name="city" class="form-control city" id="city" style="z-index: 2;"></select>

                                        <img src="<?php echo base_url().'assets/img/ajax_clock_small.gif'; ?>" class="iconLoagingCities d-none" alt="" style="position: absolute;z-index: 1;">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Phone<sup>*</sup></label>

                                    <div class="form-group__content">

                                        <input class="form-control phone" id="phone" type="text">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Address<sup>*</sup></label>

                                    <div class="form-group__content">

                                        <input class="form-control address" id="address" type="text">

                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>contraseña<sup>*</sup></label>
                                    <div class="form-group__content">
                                        <input class="form-control passwordAccount" id="passwordAccount" type="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Confirmar contraseña<sup>*</sup></label>
                                    <div class="form-group__content">
                                        <input class="form-control confirmPassword" id="confirmPassword" type="password">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="ps-checkbox">

                                        <input class="form-control" type="checkbox" id="create-account">

                                        <label for="create-account">Save address?</label>

                                    </div>

                                </div>

                                <h3 class="mt-40"> Addition information</h3>

                                <div class="form-group">

                                    <label>Order Notes</label>

                                    <div class="form-group__content">

                                        <textarea class="form-control addInformation" id="addInformation" rows="7" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>

                                    </div>

                                </div>


                                <div class="form-group">
                                    <div class="form-group__content">

                                        <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg createAcountRegister">Registrarse</button>

                                        <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg d-none createAccountRegisterLoading" style="display: flex; align-items: center; justify-content: center;">
                                            <img src="<?php echo base_url().'assets/img/ajax_clock_small.gif'; ?>" alt="" style="margin-right: 10px;"> Loading...
                                        </button>

                                        <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg d-none createAccountRegisterExitosamente" style="display: flex; align-items: center; justify-content: center;">
                                            <img src="<?php echo base_url().'assets/img/s_success.png'; ?>" alt="" style="margin-right: 10px;">
                                            Su registro ha sido completado exitosamente.
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>
                        
                        <div class="col-xl-3 col-lg-3 col-sm-3"></div>

                    </div>

                </form>

            </div>

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
<script src="<?php echo base_url().'/assets/js/checkout.js';?>"></script>
<?php  echo $this->endSection("content"); ?>