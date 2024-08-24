<style>
    .star-rating {
        display: flex;
    }

    .star {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
    }

    .star.highlight,
    .star.selected {
        color: #fcb800;
    }

    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    .me-3 {
        margin-right: 1rem;
    }

    .img-container {
        position: relative;
    }

    .position-relative {
        position: relative;
    }

    .position-absolute {
        position: absolute;
    }

    .top-0 {
        top: 0;
    }

    .end-0 {
        right: 0;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
    }
</style>
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

              

                <div class="modal-body">

                
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <form id="uploadForm">
                        
                        <div class="mb-3 mt-3">
                            <label for="imageUpload" class="form-label">Subir Imágenes (máximo 3)</label>
                            <input class="form-control" type="file" id="imageUpload" accept="image/*" multiple onchange="previewImages(event)">
                        </div>

                        <div class="mb-3 d-flex" id="imagePreviewContainer">
                            <!-- Aquí se mostrarán las imágenes subidas -->
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comentario</label>
                            <textarea class="form-control" id="comment" rows="3"></textarea>
                        </div>

                        <div class="mb-3 d-flex align-items-center">
                            <label for="rating" class="form-label me-3 mb-0">Calificación:</label>
                            <div id="rating" class="star-rating">
                                <span class="star" data-value="1">&#9733;</span>
                                <span class="star" data-value="2">&#9733;</span>
                                <span class="star" data-value="3">&#9733;</span>
                                <span class="star" data-value="4">&#9733;</span>
                                <span class="star" data-value="5">&#9733;</span>
                            </div>
                            <input type="hidden" class="calificacionstrella" value="">
                            <input type="hidden" class="idproduct">
                        </div>

                        <div class="col-xl-12 col-lg-12 col-sm-12 errorAlertCommet d-none">

                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>No pudimos enviar el comentario.</strong> Por favor, inténtalo nuevamente.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        </div>


                    </form>

                </div>

                <div class="modal-footer">
                    <!-- Initial Button -->
                    <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg btnSend" onclick="submitForm()">Enviar</button>

                    <!-- Loading Button (Initially Hidden) -->
                    <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg btnLoading d-none">
                        <img src="<?php echo base_url().'assets/img/ajax_clock_small.gif'; ?>" alt=""> Loading...
                    </button>

                    <!-- Success Button (Initially Hidden) -->
                    <button type="button" class="ps-btn ps-btn--fullwidth btn btn-lg btnCommentSend d-none">
                        <img src="<?php echo base_url().'assets/img/s_success.png'; ?>" style="max-width:10%" alt="" > 
                        <span id="successIcon" style="color: #28a745; font-weight: 500; font-size:16px;">¡Comentario enviado!</span>
                    </button>

                </div>

            </div>
        </div>
    </div>