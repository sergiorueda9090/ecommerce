<!-- Modal -->
<div class="modal fade" id="cerrarSessionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

	<div class="modal-dialog" role="document">

		<div class="modal-content">

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

	
			<div class="modal-body">

				<form class="ps-form--checkout formPayu">
					<div class="row">
						<div class="col-lg-12">

							<button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg cerrarSessionModal">Cerrar sesión</button>

							<!-- Loading Button (Initially Hidden) -->
							<button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg cerrarSessionModalLoading d-none">
								<img src="<?php echo base_url().'assets/img/ajax_clock_small.gif'; ?>" class="iconLoagingCities " alt=""> Loading...
							</button>

							<!-- Success Button (Initially Hidden) -->
							<button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg cerrarSessionModalSuccess d-none">
								<img src="<?php echo base_url().'assets/img/s_success.png'; ?>" style="max-width:10%" alt="" > 
								<span id="successIcon" style="color: #28a745; font-weight: 500; font-size:16px;">Cerrar sesión exitosamente</span>
							</button>

						</div>
					</div>
				</form>
				
			</div>

		</div>

	</div>

</div>