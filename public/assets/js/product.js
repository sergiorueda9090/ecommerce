let id_size;
let id_color;
let nameColor;
let arrayAddCar=[];

$(document).ready(function(){

    if(localStorage.getItem('addCart')){
        arrayAddCar = JSON.parse(localStorage.getItem('addCart')); 
    }

})



function callColor(idSize, id_attribute, name) {

    var div = document.getElementById('checkbox_' + idSize);
    if (div) {
        console.log("ingresa");
        // Check if the element is already shaded
        var isShaded = div.classList.contains('shaded');
        
        // Remove the 'shaded' class from all elements
        var allDivs = document.querySelectorAll('.ps-variant--size');
        
        allDivs.forEach(function(div) {
            div.classList.remove('shaded');
        });
        
        // Toggle the shading class on the clicked element
        div.classList.toggle('shaded', !isShaded);
        
        // Check if the shading class was added (i.e., the element is being shaded)
        if (!isShaded) {
            $(".figureColors").css('display', 'none');
            $('.loaderColors').css('display', 'block');
            // Send the request only if the element is being shaded
            sendRequest(idSize, id_attribute, name);
        }else{
            
            // Selecciona el elemento contenedor donde se agregarán los colores
            let figureColorsElement = document.querySelector('.figureColors');
            
            // Elimina todos los elementos hijos del contenedor antes de agregar nuevos colores
            while (figureColorsElement.firstChild) {
                figureColorsElement.removeChild(figureColorsElement.firstChild);
            }
            
            // Crea y agrega el elemento figcaption antes de los colores
            let figcaptionElement       = document.createElement('figcaption');
            figcaptionElement.innerHTML = 'Color: <strong>Choose an option</strong>';
            figureColorsElement.appendChild(figcaptionElement);

            $(".Quantity").html('Quantity ');
            $(".quantity").val(0);

        }
    } else {
        console.error("Element not found!"); // Debugging statement
    }
}


function sendRequest(idSize, id_attribute, name){
    id_size = idSize;
    //let domain = window.location.hostname;
    let url = `${BASE_URL}colors`;

    let data = { idSize: idSize, id_attribute:id_attribute, name:name };

    fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json",
        },
    })
    .then((res) => res.json())
    .catch((error) => console.error("Error:", error))
    .then((response) => response.status == 200 ? showColors(response.colors) : showFailedColors(response.colors));
}

function showColors(colors) {
    // Oculta el loader de colores si está visible
    $(".Quantity").html('¡Últimas unidades disponibles!');
    $(".figureColors").css('display', 'block');
    $('.loaderColors').css('display','none');
    $(".quantity").val(0);

    // Selecciona el elemento contenedor donde se agregarán los colores
    const figureColorsElement = document.querySelector('.figureColors');

    // Elimina todos los elementos hijos del contenedor antes de agregar nuevos colores
    while (figureColorsElement.firstChild) {
        figureColorsElement.removeChild(figureColorsElement.firstChild);
    }

    // Crea y agrega el elemento figcaption antes de los colores
    const figcaptionElement = document.createElement('figcaption');
    figcaptionElement.innerHTML = 'Color: <strong>Choose an option</strong>';
    figureColorsElement.appendChild(figcaptionElement);

    // Crea un contenedor para las opciones de color
    const colorSelectorDiv = document.createElement('div');
    colorSelectorDiv.classList.add('color-selector');
    console.log("colors ",colors);
    // Recorre la información de los colores y agrega el código HTML a '.figureColors'
    colors.forEach((color) => {
        // Crea un nuevo elemento div para cada opción de color
        const colorOptionDiv = document.createElement('div');
        colorOptionDiv.classList.add('color-option');

        // Agrega el estilo de fondo dinámico y el atributo de título
        colorOptionDiv.style.backgroundColor = color.color;
        colorOptionDiv.title   = color.color;
        colorOptionDiv.idColor = color.id;

        // Agrega el atributo onClick que llama a la función callQuantity(color.id)
        colorOptionDiv.setAttribute('onClick', `callQuantity(${color.id}, '${color.color}', ${color.id_product})`);


        // Agrega el colorOptionDiv al contenedor de selector de color
        colorSelectorDiv.appendChild(colorOptionDiv);
    });

    // Agrega el contenedor de opciones de color a figureColorsElement
    figureColorsElement.appendChild(colorSelectorDiv);
}



function showFailedColors(data){
    console.log("showFailedColors ",data)
}

function showFailed(message){
    alert(message);
}

function callQuantity(idquantity, color, id_product){
    id_color =  idquantity;
    nameColor = color;
    $('.loaderQuantity').css('display','block');
    sendRequestQuantity(idquantity, color, id_product);
}

function sendRequestQuantity(idquantity, color, id_product){

    let url = `${BASE_URL}quantity`;

    let data = { idquantity: idquantity, color:color, id_product:id_product };

    fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json",
        },
    })
    .then((res) => res.json())
    .catch((error) => console.error("Error:", error))
    .then((response) => response.status == 200 ? showQuantity(response.data, response.images) : showFailedQuantity(response.data));
}

function showQuantity(data, images){

    
    // Verifica si se recibieron nuevas imágenes
    if (images && images.length > 0) {
        // Selecciona los contenedores de la galería y las variantes
        const galleryContainer = $(".ps-product__gallery");
        const variantsContainer = $(".ps-product__variants");

        // Actualiza las imágenes de la galería
        galleryContainer.find(".item").each((index, element) => {
            // Reemplaza la imagen en cada item de la galería
            if (images[index]) {
                $(element).find("a img").attr("src", images[index].image);
                $(element).find("a").attr("href", images[index].image);
            }
        });

        // Actualiza las imágenes de las variantes
        variantsContainer.find(".item").each((index, element) => {
            // Reemplaza la imagen en cada item de las variantes
            if (images[index]) {
                $(element).find("img").attr("src", images[index].image);
            }
        });
    }

    $(".quantity").val(0);
    $('.loaderQuantity').css('display','none');
    $(".Quantity").html('<span>¡Últimas <strong class="numberQuantity" style="color: #669900;">' + data.count + '</strong> unidades disponibles! No te quedes sin la tuya.</span>');

}

function showFailedQuantity(data){
    console.log("showFailedQuantity ",data)
}

function plus(){
    let  quantity = Number($(".quantity").val());
    let  numberQuantity = Number($(".numberQuantity").text()); 
    
    console.log("numberQuantity ",numberQuantity);

    quantity = quantity + 1;
    if(quantity <= numberQuantity ){
        $(".quantity").val(Number(quantity));
    }    
}


function minus(){
    let  quantity = Number($(".quantity").val());
    quantity = quantity - 1;
    if(quantity <= 0 ){
        $(".quantity").val(Number(0));
    }else{
        $(".quantity").val(Number(quantity));
    }
}


function addCar() {
    
    let nameProduct = $(".nameProduct").text();
    let idProduct   = $(".idProduct").text();
    let sale        = $(".priceToPay").text().replace(/[.,]/g, "");
    let quantity    = $('.quantity').val();
    let nameSize    = $(".shaded .ps-variant__size").text();
       
    let validate = [null, undefined, ''];
    
    if(quantity == '0' || quantity == 0 && validate.includes(id_size) || validate.includes(id_color)){
        showFailed("You need to choose size, color, count");     
        return false;
    }

     // Select the first image within .ps-product__gallery and get its src attribute
     let firstImageSrc = $(".ps-product__gallery .item:first-child img").attr("src");

    let existingItemIndex = arrayAddCar.findIndex(item => item.id_size == id_size && item.id_color == id_color);

    if (existingItemIndex !== -1) {
        // If item exists, update its quantity
        arrayAddCar[existingItemIndex].quantity = quantity;
    } else {
        // If item doesn't exist, add it to the array
        
        let data = {
            "idProduct"     : idProduct,
            "nameProduct"   : nameProduct,
            "sale"          : sale,
            "quantity"      : quantity,
            "id_size"       : id_size,
            "nameSize"      : nameSize,
            "nameColor"     : nameColor,
            "id_color"      : id_color,
            "img"           : firstImageSrc,
            "attributProduc": $(".attributoProduct").attr("title")
        };

        arrayAddCar.push(data);
        
        localStorage.setItem('addCart', JSON.stringify(arrayAddCar));
    }


    $(".amountBag").html(arrayAddCar.length)
        
}

function addHeart(idProduct, uniqueId, status=false) {
    
    let url = `${BASE_URL}addWish`;

    let data = { idProduct: idProduct };
    
    $(`#heart-icon-${idProduct}${uniqueId}`).addClass("d-none");
    $(`#loading-icon-${idProduct}${uniqueId}`).removeClass("d-none");

    fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json",
        },
    })
    .then((res) => res.json())
    .catch((error) => {
        console.error("Error:", error);
        showWishMessage(false, "Hubo un problema al agregar el producto a la lista de deseos.");
    })
    .then((response) => {

        if (response.status == 200 && response.success) {

            showWishMessage(true, response.message, response.total);
            
            if(!status){
                updateHeartRed(idProduct,uniqueId);
            }else{
                updateWishMessage(idProduct,uniqueId);
            }

        } else if (response.status == 200 && response.exists) {

            showWishMessage(false, response.message);

        } else if (response.status == 400 || response.status == 404) {

            showWishMessage(false, response.message);

        } else {

            showWishMessage(false, "Ha ocurrido un error inesperado. Inténtalo nuevamente.");

        }

        $(`#loading-icon-${idProduct}${uniqueId}`).addClass("d-none");
        $(`#heart-icon-${idProduct}${uniqueId}`).removeClass("d-none");

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

function removeHeart(idProduct, uniqueId, status=false) {

    let url = `${BASE_URL}removeWish`;

    // Enviar la solicitud DELETE con el ID del producto en la URL
    fetch(`${url}?idProduct=${idProduct}`, {
        method: "delete",
        headers: {
            "Content-Type": "application/json",
        },
    })
    .then((res) => res.json())
    .catch((error) => {
        console.error("Error:", error);
        showWishMessage(false, "Hubo un problema al eliminar el producto de la lista de deseos.");
    })
    .then((response) => {
        if (response.status == 200 && response.success) {
        
            showWishMessage(true, response.message);
        
            if(!status){
                revertHeart(idProduct,uniqueId);    
            }else{
                revertWishMessage(idProduct,uniqueId);
            }
            
        } else {
        
            showWishMessage(false, response.message);
        
        }
    });
}

function updateHeartRed(productId,uniqueId) {
    var heartIcon = document.getElementById('heart-icon-' + productId+uniqueId);

    // Remover el onClick existente
    heartIcon.removeAttribute('onClick');

    // Remover el ícono <i>
    var iconElement = heartIcon.querySelector('i');
    if (iconElement) {
        heartIcon.removeChild(iconElement);
    }

    // Agregar el nuevo onClick y el <span>
    heartIcon.setAttribute('onClick', 'removeHeart(' + productId + ', '+uniqueId+');');
    heartIcon.setAttribute('class', 'wish-message-a');
    heartIcon.innerHTML = '<span class="icon">&#10084;</span>';
}

function revertHeart(productId,uniqueId) {
    var heartIcon = document.getElementById('heart-icon-' + productId+uniqueId);

    // Remover el onClick existente
    heartIcon.removeAttribute('onClick');

    // Remover el <span> elemento
    var spanElement = heartIcon.querySelector('span');
    if (spanElement) {
        heartIcon.removeChild(spanElement);
    }

    // Agregar el nuevo onClick y el <i>
    heartIcon.setAttribute('onClick', 'addHeart(' + productId + ', '+uniqueId+');');
    heartIcon.innerHTML = '<i class="icon-heart"></i>';
}

function revertWishMessage(productId,uniqueId) {
    var wishMessage = document.getElementById('wish-message-a-' + productId+uniqueId);

    // Remover el onClick existente
    wishMessage.removeAttribute('onClick');

    // Remover el <span> elemento
    var spanElement = wishMessage.querySelector('span');
    if (spanElement) {
        wishMessage.removeChild(spanElement);
    }

    // Agregar el nuevo onClick y el <i>
    wishMessage.setAttribute('onClick', 'addHeart(' + productId + ','+uniqueId+',true);');
    wishMessage.innerHTML = '<i class="icon-heart"></i>';
}

function updateWishMessage(productId, uniqueId) {
    var wishMessage = document.getElementById('wish-message-a-' + productId+uniqueId);

    // Remover el onClick existente
    wishMessage.removeAttribute('onClick');

    // Remover el <i> elemento
    var iconElement = wishMessage.querySelector('i');
    if (iconElement) {
        wishMessage.removeChild(iconElement);
    }

    // Agregar el nuevo onClick y el <span>
    wishMessage.setAttribute('onClick', 'removeHeart(' + productId + ',' + uniqueId + ', true);');
    wishMessage.innerHTML = '<span class="icon">&#10084;</span>';
}