$(document).on('click','.uploadModalCommet', function(){

    let idComment = $(this).attr('comment');
    $(".idproduct").val(idComment);
    $("#uploadModal").modal('show');
    $("#imagePreviewContainer").empty();
    $("#comment").val("");
    $(".calificacionstrella").val("");

    const ratingElement = document.getElementById('rating');
    console.log("ratingElement ",ratingElement);
    resetStarRating(ratingElement);

})

function previewImages(event) {
    
    const files = event.target.files;
    const previewContainer = document.getElementById('imagePreviewContainer');

    if (files.length > 3 || previewContainer.children.length + files.length > 3) {
        alert('Solo puedes subir un máximo de 3 imágenes.');
        return;
    }

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function (e) {
            const imgContainer = document.createElement('div');
            imgContainer.classList.add('img-container', 'me-2', 'position-relative');

            const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.style.width = '100px';
                    imgElement.style.height = '100px';
                    imgElement.classList.add('img-fluid');

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'X';
            deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'position-absolute', 'top-0', 'end-0');
            deleteButton.onclick = function() {
                previewContainer.removeChild(imgContainer);
                document.getElementById('imageUpload').value = ''; // Clear file input value
            };

            imgContainer.appendChild(imgElement);
            imgContainer.appendChild(deleteButton);
            previewContainer.appendChild(imgContainer);
        };

        reader.readAsDataURL(file);
    }
}

function submitForm() {
    
    const form = document.getElementById('uploadForm');
    const formData = new FormData(form);

    const files = document.getElementById('imageUpload').files;
    const comment = document.getElementById('comment').value;
    const rating = $(".calificacionstrella").val();
    const idproduct = $(".idproduct").val()
    console.log("files ",files);
    console.log("comment ",comment);
    console.log("rating ",rating);
    console.log("idproduct ",idproduct);
    if(files.length === 0 && comment == "" && rating == "" || rating == 0){
        alert('Por favor, selecciona una calificación, agrega una imagen o escribe un comentario antes de continuar.');
        return;
    }

    $('.btnSend').addClass("d-none");
    $(".btnLoading").removeClass('d-none');

    let url = `${BASE_URL}addratingscommet`;

    if (rating === null) {
        alert('Por favor, selecciona una calificación.');
        return;
    }

    formData.append('idproduct',idproduct);
    formData.append('comment', comment);
    formData.append('rating', rating);

    for (let i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
    }

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {

            //$('.btnSend').removeClass("d-none");
            $(".btnLoading").addClass('d-none');
            $(".btnCommentSend").removeClass("d-none");
          
            setTimeout(() => {
                $('.btnSend').removeClass("d-none");
                $(".btnCommentSend").addClass("d-none");
            },3000);

        } else {

            //$('.btnSend').removeClass("d-none");
            $(".btnLoading").addClass('d-none');
            $(".btnCommentSend").removeClass("d-none");
            $(".errorAlertCommet").removeClass('d-none');

            setTimeout(() => {
                $('.btnSend').removeClass("d-none");
                $(".btnCommentSend").addClass("d-none");
            },3000);
           
            
        }
    })
    .catch(error => {

        console.error('Error:', error);
        //$('.btnSend').removeClass("d-none");
        $(".btnLoading").addClass('d-none');
        $(".btnCommentSend").removeClass("d-none");
        $(".errorAlertCommet").removeClass('d-none');

        setTimeout(() => {
            $('.btnSend').removeClass("d-none");
            $(".btnCommentSend").addClass("d-none");
        },3000);

    });

}


function initializeStarRating(ratingElement) {
    const stars = ratingElement.querySelectorAll('.star');
    let selectedRating = 0;

    stars.forEach((star, index) => {
        star.addEventListener('mouseover', () => {
            highlightStars(stars, index);
        });

        star.addEventListener('mouseout', () => {
            resetStars(stars, selectedRating);
        });

        star.addEventListener('click', () => {
            selectedRating = setRating(stars, index);
            $(".calificacionstrella").val(selectedRating + 1);
            console.log("Calificación seleccionada:", selectedRating + 1); // Imprime la calificación seleccionada (1-5)
        });
    });
}

function highlightStars(stars, index) {
    for (let i = 0; i <= index; i++) {
        stars[i].classList.add('highlight');
    }
}

function resetStars(stars, selectedRating) {
    stars.forEach((star, index) => {
        star.classList.remove('highlight');
        if (index <= selectedRating) {
            star.classList.add('selected');
        } else {
            star.classList.remove('selected');
        }
    });
}

function setRating(stars, index) {
    resetStars(stars, index);
    return index; // Devuelve el índice de la calificación seleccionada
}

// Initialize star rating functionality on page load
document.addEventListener('DOMContentLoaded', () => {
    const ratingElement = document.getElementById('rating');
    console.log("ratingElement ",ratingElement);
    initializeStarRating(ratingElement);
});

function resetStarRating(ratingElement) {
    const stars = ratingElement.querySelectorAll('.star');
    stars.forEach(star => {
        star.classList.remove('highlight', 'selected');
    });

    // Restablece el valor del input oculto de calificación a 0
    $(".calificacionstrella").val(0);
    console.log("Calificación restablecida a cero.");
}