<!-- Modal -->
<div class="modal fade" id="forgetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        
            <div class="modal-body">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

                <form class="ps-form--checkout formPayu">

                    <div class="row">

                        <div class="col-lg-12">
                            <h3 class="text-center" style="margin-bottom:12px; font-weight:400; font-size:24px;">¿Olvidaste tu contraseña?</h3>
                            <h4 style="color:rgb(102, 102, 102); font-weight:400; font-size:17px;">
                                Ingresa tu correo electrónico a continuación y recibirás un mensaje con instrucciones para restablecer tu contraseña.
                            </h4>
                        </div>

                        <!-- EMAIL VALIDATE -->
                        <div class="col-xl-12 col-lg-12 col-sm-12 divValidateEmail">
                            <div class="form-group">
                                <label>Ingresa tu Email<sup>*</sup></label>
                                <div class="form-group__content">
                                    <input class="form-control emailForgetModel" id="emailForgetModel" type="email">
                                </div>
                                <small id="emailFailForget" class="form-text text-danger d-none emailFailForget">Entre con un e-mail válido</small>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-sm-12 emailHeaderForget d-none">
                            <div class="alert alert-warning " role="alert">
                                <strong>Email equivocada</strong>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-sm-12 emailHeaderForget d-none">

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Hemos enviado un correo electrónico a la dirección que proporcionaste. </strong> Revisa tu bandeja de entrada y sigue las instrucciones en el mensaje para restablecer tu contraseña.
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            
                        </div>

                        <div class="col-xl-12 col-lg-12 col-sm-12 emailForgetFailModelTxT d-none">

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>No pudimos enviar un correo electrónico a la dirección que proporcionaste.</strong> Por favor, verifica que la dirección de correo electrónico sea correcta e inténtalo nuevamente. Es posible que el correo no exista o esté mal escrito.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        </div>

                    </div>
                </form>

            </div>
            
            <div class="modal-footer">
                <!-- Initial Button -->
                <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg emailForgetModal">Enviar</button>

                <!-- Loading Button (Initially Hidden) -->
                <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg forgetPasswordLoagindModel d-none">
                    <img src="<?php echo base_url().'assets/img/ajax_clock_small.gif'; ?>" class="iconLoagingCities " alt=""> Loading...
                </button>

                <!-- Success Button (Initially Hidden) -->
                <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg forgetPasswordSucuccessModel d-none">
                   <img src="<?php echo base_url().'assets/img/s_success.png'; ?>" class="iconLoagingCities" style="max-width:10%" alt="" > 
                   <span id="successIcon" style="color: #28a745; font-weight: 500; font-size:16px;">¡Correo electrónico enviado!</span>
                </button>

            </div>

        </div>
    </div>
</div>