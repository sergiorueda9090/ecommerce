$(document).ready(function(){
    
    shoppingShowBag();

    shoppingTotal();

    function shoppingShowBag(){
        
        let addCartStorage = localStorage.getItem('addCart');
        
        if(addCartStorage){
            
          $(".tb_shoppingcar").empty();

           let addCartShow = JSON.parse(addCartStorage); 
    
           $(".amountBag").html(addCartShow.length)
           
           addCartShow.forEach((element, index) => {

                $(".tb_shoppingcar").append(`<tr>
                                                <td>

                                                    <div class="ps-product--cart">

                                                        <div class="ps-product__thumbnail">

                                                            <a href="product-default.html"><img src=${element.img} alt=""></a>

                                                        </div>

                                                        <div class="ps-product__content">

                                                            <a href="product-default.html">${element.nameProduct}</a>

                                                        </div>

                                                    </div>

                                                </td>

                                                <td class="price">${element.sale}</td>

                                                <td class="text-center">${element.quantity}</td>


                                                <!--<td>

                                                    <div class="form-group--number">

                                                        <button class="up">+</button>

                                                        <button class="down">-</button>

                                                        <input class="form-control" type="text" placeholder="1" value="1">

                                                    </div>

                                                </td>-->

                                                <td>${(parseFloat(element.sale.replace(/[^0-9.-]+/g,"")) * element.quantity).toLocaleString()}</td>                             

                                                <td>

                                                    <a class="removeItem" posicionElement="${index + 1}">
                                                        <i class="icon-cross"></i>
                                                    </a>

                                                </td>

                                            </tr>`);

           });

        }
    }

    function shoppingTotal(){
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
            $(".shoppingTotal").html('$ '+suma.toLocaleString());
            $(".ps-cart__footer h3 strong").html('$ '+suma.toLocaleString());
        }else{
            $(".shoppingTotal").html('$ '+0);
            $(".ps-cart__footer h3 strong").html('$ '+0);
        }
    }


    $(document).on("click",'.removeItem',function(){

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
    
        $(this).closest("tr").remove();

        shoppingShowBag();
        
        shoppingTotal();

    })




})