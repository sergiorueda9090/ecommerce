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

                <h1>Checkout</h1>

            </div>

            <div class="ps-section__content">

                <form class="ps-form--checkout formPayu">

                    <div class="row">
                        <!-- EMAIL VALIDATE -->
                        <div class="col-xl-7 col-lg-8 col-sm-12 divValidateEmail">
                            <div class="form-group">
                                <label>Ingresa tu Email<sup>*</sup></label>
                                <div class="form-group__content">
                                    <input class="form-control email" id="email" type="email">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="form-group__content">
                                    <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg subscribe">Continuar</button>
                                </div>
                            </div>
                        </div>
                        <!-- END EMAIL VALIDATE -->
                        

                        <!-- PASSWORD VALIDATE -->
                        <div class="col-xl-7 col-lg-8 col-sm-12 divValidatePassword" style="display:none" >
                            <div class="form-group">
                                <label>Contraseña<sup>*</sup></label>
                                <div class="form-group__content">
                                    <input class="form-control password" id="password" type="password">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="form-group__content">
                                    <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg authenticationCustomer">Ingresar</button>
                                </div>

                                <div class="form-group__content">
                                    <p>Do you forget your password?</p>
                                </div>
                            </div>
                        </div>
                        <!-- END PASSWORD VALIDATE -->

                        <div class="col-xl-7 col-lg-8 col-sm-12 formBilling" style="display:none">

                            <div class="ps-form__billing-info">

                                <h3 class="ps-form__heading titleBillingDetails">Billing Details</h3>

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

                                    <div class="form-group__content">

                                    <select name="city" class="form-control city" id="city">
                                        <option value="">Seleccionar</option>
                                    </select>

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
                                        <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg createAcount">Crear cuenta</button>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-xl-5 col-lg-4 col-sm-12">

                            <div class="ps-form__total">

                                <h3 class="ps-form__heading">Your Order</h3>

                                <div class="content">

                                    <div class="ps-block--checkout-total">

                                        <div class="ps-block__header d-flex justify-content-between">

                                            <p>Product</p>

                                            <p>Total</p>

                                        </div>

                                        <div class="ps-block__content">

                                            <table class="table ps-block__products">
                                                <tbody class="viewCheckout"></tbody>
                                            </table>
                                            
                                            <h3 class="text-right">Total <span class="checkoutTotal">$683.49</span></h3>

                                        </div>

                                    </div>

                                    <hr class="py-3">

                                    <div class="form-group">

                                        <div class="ps-radio">

                                            <input class="form-control" type="radio" id="pay-paypal" name="payment-method" value="paypal" checked>

                                            <label for="pay-paypal">Pay with paypal?  <span><img src="<?php echo base_url().'assets/img/payment-method/paypal.jpg' ?>" class="w-50"></span></label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="ps-radio">

                                            <input class="form-control" type="radio" id="pay-payu" name="payment-method" value="payu">

                                            <label for="pay-payu">Pay with payu? <span><img src="<?php echo base_url().'assets/img/payment-method/payu.jpg' ?>" class="w-50"></span></label>

                                        </div>

                                    </div>

                                    <div class="form-group">

                                        <div class="ps-radio">

                                            <input class="form-control" type="radio" id="pay-mercadopago" name="payment-method" value="mercado-pago">

                                            <label for="pay-mercadopago">Pay with Mercado Pago? <span><img src="<?php echo base_url().'assets/img/payment-method/mercado_pago.jpg' ?>" class="w-50"></span></label>

                                        </div>

                                    </div>


                                   
                                        <input name="merchantId"      type="text"  value="">
                                        <input name="accountId"       type="text"  value="">
                                        <input name="description"     type="text"  value="">
                                        <input name="referenceCode"   type="text"  value="" >
                                        <input name="amount"          type="text"  value="">
                                        <input name="tax"             type="text"  value="">
                                        <input name="taxReturnBase"   type="text"  value="">
                                        <input name="currency"        type="text"  value="">
                                        <input name="signature"       type="text"  value="">
                                        <input name="test"            type="text"  value="">
                                        <input name="buyerEmail"      type="text"  value="">
                                        <input name="responseUrl"     type="hidden" value="http://www.test.com/response" >
                                        <input name="confirmationUrl" type="hidden" value="http://www.test.com/confirmation" >
                                        
                                    

                                    <button name="Submit" class="ps-btn ps-btn--fullwidth proceedToCheckout" type="submit">Proceed to checkout</button>
                 
                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>
  
    <!--=====================================
	Footer
	======================================-->

    <hr>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
<script src="<?php echo base_url().'/assets/js/checkout.js';?>"></script>
<?php  echo $this->endSection("content"); ?>