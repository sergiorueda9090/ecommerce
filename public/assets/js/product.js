let id_size;
let id_color;
let arrayAddCar=[];

$(document).ready(function(){

    if(localStorage.getItem('addCart')){
        arrayAddCar = JSON.parse(localStorage.getItem('addCart')); 
    }

    console.log(arrayAddCar);

})



function callColor(idSize) {
    var div = document.getElementById('checkbox_' + idSize);
    if (div) {
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
            $('.loaderColors').css('display', 'block');
            // Send the request only if the element is being shaded
            sendRequest(idSize);
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


function sendRequest(idSize){
    id_size = idSize;
    //let domain = window.location.hostname;
    let url = `${BASE_URL}colors`;

    let data = { idSize: idSize };

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

function showColors(colors){
    // Oculta el loader de colores si está visible
    $(".Quantity").html('Quantity ');
    $('.loaderColors').css('display','none');

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

    // Recorre la información de los colores y agrega el código HTML a '.figureColors'
    colors.forEach((color) => {
        // Crea un nuevo elemento div
        const div = document.createElement('div');
        // Agrega las clases al nuevo elemento div
        div.classList.add('ps-variant', 'ps-variant--image');

        // Agrega el atributo onClick que llama a la función cantidad(color.id)
        div.setAttribute('onClick', `callQuantity(${color.id})`);

        // Crea un nuevo elemento span para el tooltip
        const span = document.createElement('span');
        // Agrega la clase al nuevo elemento span
        span.classList.add('ps-variant__tooltip');
        // Establece el texto del span como el color actual
        span.textContent = color.color;
        // Crea un nuevo elemento img
        const img = document.createElement('img');
        // Establece el atributo src de la imagen (aquí asumo una ruta estática)
        img.setAttribute('src', `${BASE_URL}assets/img/products/detail/variants/small-1.jpg`);
        
        // Establece el atributo alt de la imagen
        img.setAttribute('alt', '');

        // Agrega el span y la imagen al div
        div.appendChild(span);
        div.appendChild(img);

        // Agrega el div al elemento con la clase '.figureColors'
        figureColorsElement.appendChild(div);
    });
}



function showFailedColors(data){
    console.log("showFailedColors ",data)
}

function showFailed(message){
    alert(message);
}

function callQuantity(idquantity){
    id_color =  idquantity;
    $('.loaderQuantity').css('display','block');
    sendRequestQuantity(idquantity);
}

function sendRequestQuantity(idquantity){

    let url = `${BASE_URL}quantity`;

    let data = { idquantity: idquantity };

    fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json",
        },
    })
    .then((res) => res.json())
    .catch((error) => console.error("Error:", error))
    .then((response) => response.status == 200 ? showQuantity(response.data) : showFailedQuantity(response.data));
}

function showQuantity(data){
    $(".quantity").val(0);
    $('.loaderQuantity').css('display','none');
    $(".Quantity").html('Quantity '+'<span class="numberQuantity">'+data.count+'</span>');
}

function showFailedQuantity(data){
    console.log("showFailedQuantity ",data)
}

function plus(){
    let  quantity = Number($(".quantity").val());
    let  numberQuantity = Number($(".numberQuantity").text()); 
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
    let sale        = $(".priceToPay").text();
    let quantity    = $('.quantity').val();
    let nameSize    = $(".shaded .ps-variant__size").text();
    let nameColor   = $(".shaded .ps-variant__color").text();

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
        };

        arrayAddCar.push(data);
        
        localStorage.setItem('addCart', JSON.stringify(arrayAddCar));
    }


    $(".amountBag").html(arrayAddCar.length)
        
    console.log(arrayAddCar);
}