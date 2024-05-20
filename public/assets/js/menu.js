$(document).ready(function(){
    
    let isCartContentVisible = false;

    showBag();
    updateCartTotal();

    function updateCartTotal(){
        
        let addCartStorage  = localStorage.getItem('addCart');

        if(addCartStorage){
            let addCartShow = JSON.parse(addCartStorage); 
                    // Usar reduce para sumar los valores de "count"
            let suma = addCartShow.reduce((total, objeto) => {
                // Eliminar caracteres no numéricos y convertir a número
                let countNum = parseFloat(objeto.sale.replace(/[^0-9.-]+/g,""));
                    // Sumar al total
                return total + (countNum * objeto.quantity);
            }, 0);
            $(".ps-cart__footer h3 strong").html('$ '+suma.toLocaleString());
        }else{
            $(".ps-cart__footer h3 strong").html('$ '+0);
        }

    }

    function showBag(){
        
        let addCartStorage = localStorage.getItem('addCart');
        
        if(addCartStorage){
            
          $(".ps-cart__items").empty();

           let addCartShow = JSON.parse(addCartStorage); 
    
           $(".amountBag").html(addCartShow.length)
           
           addCartShow.forEach((element, index) => {
                $(".ps-cart__items").append(`<div class="ps-product--cart-mobile">
                                                <div class="ps-product__thumbnail">
                                                    <a href="#">
                                                        <img src=${element.img} alt="">
                                                    </a>
                                                </div>
    
                                                <div class="ps-product__content">
                                                    <a class="ps-product__remove" posicionElement=${index + 1} href="#"> <i class="icon-cross"></i></a>
                                                    <a href="product-default.html">${element.nameProduct}</a><p></p>
                                                    <small>${element.quantity} x ${element.sale}</small>
                                                </div>
    
                                            </div>`);
           });

           updateCartTotal();
        
        }
    }

    $(document).on("click",".showbag2",function(){

       showBag();

       if (!isCartContentVisible) {
            // Show .ps-cart__content
            $(".ps-cart__content").css({
                "-webkit-transform": "translate(0, 0px)",
                "transform": "translate(0, 0px)",
                "visibility": "visible",
                "opacity": "1"
            });
            isCartContentVisible = true;
        } else {
            $(".ps-cart__content").css({
                "-webkit-transform": "",
                "transform": "",
                "visibility": "",
                "opacity": ""
            });
            isCartContentVisible = false;
        }
    })

    $(document).on("click", ".ps-product--cart-mobile .ps-product__remove", function() {
        
        let addCartStorage = localStorage.getItem('addCart');
        
        let addCartShow = JSON.parse(addCartStorage); 

        // Retrieve the position of the clicked element
        let position = $(this).attr("posicionElement");
        

        // Remove the corresponding element from the array
        addCartShow.splice(position - 1, 1);
        
        if(addCartShow.length <= 0){
            localStorage.removeItem('addCart');
        }else{
            localStorage.setItem('addCart', JSON.stringify(addCartShow));
        }

        $(".amountBag").html(addCartShow.length)
        
        // Remove the corresponding element from the DOM
        $(this).closest(".ps-product--cart-mobile").remove();
    
        // Update any other necessary data or UI elements
    
        // For example, update the cart total or any other related information
        updateCartTotal();
    });

})