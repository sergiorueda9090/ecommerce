<!-- Modal -->
<div class="modal fade" id="sessionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        
            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


                <form class="ps-form--checkout formPayu">

                    <div class="row">

                        <div class="col-lg-12">
                        <h3 class="text-center" style="margin-bottom:12px; font-weight:400; font-size:24px;">Iniciar sesión</h3>
                        <h4  style="color:rgb(102, 102, 102); font-weight:400; font-size:17px;">Ingresa tu mail y contraseña para iniciar sesión:</h4>
                        </div>

                        <!-- EMAIL VALIDATE -->
                        <div class="col-xl-12 col-lg-12 col-sm-12 divValidateEmail">
                            <div class="form-group">
                                <label>Ingresa tu Email<sup>*</sup></label>
                                <div class="form-group__content">
                                    <input class="form-control emailHeader" id="emailHeader" type="email">
                                </div>
                                <small id="emailHelpHeader" class="form-text text-danger d-none errorEmailModal">Entre con un e-mail válido</small>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-sm-12 divValidatePassword">
                            <div class="form-group">
                                <label>Contraseña<sup>*</sup></label>
                                <div class="form-group__content">
                                    <input class="form-control passwordHeader" id="passwordHeader" type="password">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-sm-12 erroruserpassword d-none">
                            <div class="alert alert-warning" role="alert">
                                <strong>Usuario y/o contraseña equivocada</strong>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
            
            <div class="modal-footer">
                <!-- Initial Button -->
                <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg authenticationCustomeHeader">Iniciar sesión</button>

                <!-- Loading Button (Initially Hidden) -->
                <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg authenticationCustomeHeaderLoading d-none">
                    <img src="<?php echo base_url().'assets/img/ajax_clock_small.gif'; ?>"  alt=""> Loading...
                </button>

                <!-- Success Button (Initially Hidden) -->
                <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg authenticationCustomeHeaderSuccess d-none">
                    <img src="<?php echo base_url().'assets/img/s_success.png'; ?>" style="max-width:10%" alt="" > 
                    <span id="successIcon" style="color: #28a745; font-weight: 500; font-size:16px;"> Logeado exitosamente</span>
                </button>

                <div class="form-group__content">
                    <a type="button" data-toggle="modal" data-target="#forgetPasswordModal">Do you forget your password?</a>
                </div>
            </div>

        </div>
    </div>
</div>