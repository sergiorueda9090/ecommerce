function removeHeart(idProduct, element) {

    let url = `${BASE_URL}removeWish`;
    let loadingImage = $(element).siblings('.removeloadingwish');
    let iconX = $(element);

    // Ocultar el icono de la "X" y mostrar la imagen de carga
    iconX.addClass('d-none');
    loadingImage.removeClass('d-none');

    // Enviar la solicitud DELETE con el ID del producto en la URL
    fetch(`${url}?idProduct=${idProduct}`, {
        method: "delete",
        headers: {
            "Content-Type": "application/json",
        },
    })
    .then((res) => res.json())
    .catch((error) => {
        showWishMessage(false, "Hubo un problema al eliminar el producto de la lista de deseos.");
    })
    .then((response) => {

        // Ocultar la imagen de carga y volver a mostrar el icono de la "X"
        loadingImage.addClass('d-none');

        if (response.status == 200 && response.success) {
            showWishMessage(true, response.message, response.total);
            $(element).closest('tr').remove();
        } else {
            iconX.removeClass('d-none');
            showWishMessage(false, response.message, total = 0);
        }
        
    });
}

function showWishMessage(success, message, total = 0) {
    // Crear el contenedor del mensaje
    let wishMessage = $('<div class="wish-message"></div>').html(message);

    success ? $(".totalwishes i").html(total) : ''
   
    // Agregar el ícono de corazón dependiendo del éxito o error
    let heartIcon = success ? '&#10084;' : '&#x2764;'; // Corazón verde para éxito, rojo para error
    let iconColor = success ? '#4caf50' : '#f44336'; // Verde para éxito, rojo para error

    // Crear un elemento para el ícono de corazón
    let heartElement = $('<span class="icon"></span>').html(heartIcon).css('color', iconColor);

    // Prepend the icon to the message
    wishMessage.prepend(heartElement);

    // Aplicar estilos según el éxito o error
    if (success) {
        wishMessage.css({
            "background-color": "#4caf50", // Verde para éxito
            "color": "#fff"
        });
    } else {
        wishMessage.css({
            "background-color": "#f44336", // Rojo para error
            "color": "#fff"
        });
    }

    // Aplicar estilos generales
    wishMessage.css({
        "padding": "15px",
        "border-radius": "8px",
        "box-shadow": "0 4px 10px rgba(0, 0, 0, 0.1)",
        "font-family": "'Arial', sans-serif",
        "font-size": "18px",
        "text-align": "center",
        "position": "fixed",
        "top": "20px",
        "left": "50%",
        "transform": "translateX(-50%)",
        "z-index": "1000",
        "opacity": "1",
        "display": "none"
    }).appendTo('body').fadeIn();

    // Ocultar el mensaje después de 5 segundos
    setTimeout(function() {

        wishMessage.fadeOut(function() {
            $(this).remove(); // Elimina el elemento del DOM
        });
        
    }, 5000);
}