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
                $(".viewCheckout").append(`<tr>
                                                <td>
                                                    <a href="#">${element.nameProduct} ×<strong>${element.quantity}</strong></a>
                                                    <p style="font-size: 1.4rem;line-height: 1.6em;color: #666; margin:0px;">Color:<strong>${element.id_color}</strong></p>
                                                    <p style="font-size: 1.4rem;line-height: 1.6em;color: #666; margin:0px;">Talla:<strong>${element.id_size}</strong></p>
                                                </td>
                                                <td class="text-right">${element.sale}</td>
                                            </tr>`
                                        );
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

            $(".checkoutTotal").html('$ '+suma.toLocaleString());
            $(".ps-cart__footer h3 strong").html('$ '+suma.toLocaleString());
        
        }else{
      
            $(".checkoutTotal").html('$ '+0);
            $(".ps-cart__footer h3 strong").html('$ '+0);
      
        }
   
    }

    function validateEmail(email){
        
        if(email){
            let url = `${BASE_URL}validateEmail`;
            let data = { email: email };
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
        }else{
            alert("Please write your email")
        }

    }

    $(document).on("click",".subscribe",function(){
        subscribe();
    })

    $(document).on("click", '.authenticationCustomer',function(){
        authenticationCustomer();
    })

    function subscribe(){
    
        let email = $('#email').val();  
        let validate = [null,undefined,''];
    
        if(validate.includes(email)){
            showFailed('Please enter a valid email address');        
            return false;
        }
    
        if (validateEmail(email)) {
            
            sendRequest(email);
    
        } else {
            
            showFailed("Invalid email address");
       
        }
    
    }
    
    // Regular expression pattern for email validation
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function sendRequest(email){
    
        //let domain = window.location.hostname;
        let url = `${BASE_URL}validateEmail`;
    
        let data = { email: email };
    
        fetch(url, {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
        },
        })
        .then((res) => res.json())
        .catch((error) => console.error("Error:", error))
        .then((response) => response.status == 200 ? showSuccess(response.message, 'subscribe') : showFailed(response.message));
    }


    function authenticationCustomer(){
        
        let email    = $('#email').val();
        let password = $('#password').val();  

        let validate = [null,undefined,''];
    
        if(validate.includes(email) || validate.includes(password)){
            showFailed('Please enter a valid email address or password');        
            return false;
        }

        if (validateEmail(email)) {
            
            //let domain = window.location.hostname;
            let url = `${BASE_URL}authenticationCustomer`;
        
            let data = { email: email, password:password };
        
            fetch(url, {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    "Content-Type": "application/json",
            },
            })
            .then((res) => res.json())
            .catch((error) => console.error("Error:", error))
            .then((response) => response.status == 200 ? showDataCustomer(response.message, response.data) : showFailed(response.message,"authenticationCustomer"));
            
        } else {
            
            showFailed("Invalid email address");
       
        }
    }

    
    function showSuccess(mesage, data=""){

        alert(mesage);

        if(data == 'formBilling'){

            $(".divValidateEmail").css( {"display" : "block"} );
            $(".divValidatePassword").css( {"display" : "none"});
            $(".formBilling").css({'display':'none'});

        }else if(data == 'subscribe'){

            $(".divValidateEmail").css( {"display" : "none"} );
            $(".divValidatePassword").css( {"display" : "block"});
            $(".createAcount").css( {"display"   :"block"});

        }
    
    }
    
    function showFailed(mesage,data=""){

        alert(mesage);

        if(data == 'authenticationCustomer'){

            $(".divValidatePassword").css( {"display" : "block"} );
            $(".proceedToCheckout").css({"display":"none"});

        }else{

            $(".titleBillingDetails").html('Crea una cuenta');
            $(".divValidatePassword").css( {"display" : "none"} );
            $(".divValidateEmail").css( {"display"    : "none"});
            $(".formBilling").css( {"display"         : "block"});
            $(".proceedToCheckout").css({"display":"none"});

        }

    }

    function showDataCustomer(mesage, data=""){

        let customer = JSON.parse(data);
        
        $(".firstName").val(customer.name);
        $(".lastName").val(customer.lastname);
        $(".email").val(customer.email);
        $(".country").val();
        $(".phone").val(customer.phone);
        $(".address").val(customer.address);

        $(".divValidatePassword").css( {"display":"none"} );
        $(".divValidateEmail").css( {"display"   :"none"});
        $(".formBilling").css( {"display"        :"block"});
        $(".createAcount").css( {"display"   :"none"});
        $(".proceedToCheckout").css({"display":"block"});

    }

    $(document).on('change','.deparments',function(){
        selectCity();
    });

    function selectCity(){

        let idDepartment = $(".deparments").val();

        let url = `${BASE_URL}city`;
        
        let data = { idDepartment };
    
        fetch(url, {
            method: "POST",
            body: JSON.stringify(data),
            headers: {
                "Content-Type": "application/json",
        },
        })
        .then((res) => res.json())
        .catch((error) => console.error("Error:", error))
        .then((response) => response.status == 200 ? showCity(response.message, response.data) : showFailed(response.message));
    }

    function showCity(message, data){
        
        $(".city").empty();
        
        $(".city").append('<option value="">Seleccionar</option>');

        let citys = JSON.parse(data);

        citys.forEach((element, index) => {
            $(".city").append(`<option value="${element.id_municipio}">
                                ${element.municipio}
                            </option>`
                        );
       });
    }


    $(document).on('click','.createAcount',function(){
        createAcount();
    })

    function createAcount(){

        let datos = {
            firstName: $(".firstName").val(),
            lastName: $(".lastName").val(),
            email: $(".email").val(),
            departments: $(".deparments").val(),
            city: $(".city").val(),
            phone: $(".phone").val(),
            address: $(".address").val(),
            addInformation: $(".addInformation").val(),
            confirmPassword: $(".confirmPassword").val(),
            password: $(".passwordAccount").val(),
          };

     
        // Array para almacenar los campos vacíos
        let camposVacios = [];
        
        // Recorrer el objeto para verificar campos vacíos
        for (let campo in datos) {
            if (!datos[campo] || datos[campo].trim() === '') {
                camposVacios.push(campo);
            }
        }

        // Validar que las contraseñas coincidan
        if (datos.password !== datos.confirmPassword) {
            alert("Las contraseñas no coinciden.");
        }
  

        // Verificar si hay campos vacíos
        if (camposVacios.length > 0) {
            let mensaje = "Por favor, complete los siguientes campos: " + camposVacios.join(", ");
            alert(mensaje);
        } else {

            let url = `${BASE_URL}createCustomer`;
                
            fetch(url, {
                method: "POST",
                body: JSON.stringify(datos),
                headers: {
                    "Content-Type": "application/json",
            },
            })
            .then((res) => res.json())
            .catch((error) => console.error("Error:", error))
            .then((response) => response.status == 200 ? showSuccess(response.message,'formBilling') : showFailed(response.message));
        }

    }

    /*========= START PAYMENT GATEWAY=========*/
    function sendUrlPageConfirmar(){

        let bagProducts = JSON.parse(localStorage.getItem('addCart'));
    
        // Crear una cadena de consulta con los IDs de productos y cantidades
        let ids = bagProducts.map(function(producto) {
                    return producto.id_color + '-' + producto.id_size + '-' + producto.quantity + '-' + producto.idProduct;
                }).join(',');

        // Usar reduce para sumar los valores de "count"
        let suma = bagProducts.reduce((total, objeto) => {
            // Eliminar caracteres no numéricos y convertir a número
            let countNum = parseFloat(objeto.sale.replace(/[^0-9.-]+/g,""));
                // Sumar al total
            return total + (countNum * objeto.quantity);
        }, 0);

        let data = {suma, ids};

        return data;
      
    }
    
    function responseURLPAYU(){
    let encodedURLIE  = `${BASE_URL}myaccount`;
    return encodedURLIE;
    }
    
    
    $(document).on("click",".proceedToCheckout",function(){
        checkoutPago();
    })

    function checkoutPago(){
    
        if(localStorage.getItem("addCart")){

            let bagProducts = JSON.parse(localStorage.getItem('addCart'));
                
            if(bagProducts.length > 0){

                let dataSendUrl = sendUrlPageConfirmar();
                
                console.log("dataSendUrl ",dataSendUrl);

                let WEBSITE_URL_CLIENTE = `${BASE_URL}compra/realizar?idProducto`;

                let apiKey        = "4Vj8eK4rloUd272L48hsrarnUA"; //comercioData[0].apiKeyPayu;
                let url           = 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/'; //comercioData[0].url;
                let merchantId    =  508029; //comercioData[0].merchantIdPayu;
                let accountId     =  512321; //comercioData[0].accountIdPayu;
                let description   = '#000001'
                let referenceCode = Number(Math.ceil(Math.random()*10000000).toFixed())*Number(Math.ceil(Math.random()*10000000).toFixed());
                let amount        = dataSendUrl.suma;
                let taxReturnBase = 0;
                let shipmentValue = 0;
                let divisa        = 'COP'; //comercioData[0].divisa;


                //let urlPageRespon = WEBSITE_URL_CLIENTE+'compra/pageRespuesta/';
                //let urlPageConfir =`${BASE_URL}payuconfirmation?&payu=true&productos=${dataSendUrl.ids}&`;
                let urlPageConfir = `${BASE_URL}payuconfirmation`;
                let urlPageRespon ="url";
                let urlPageDelicl = WEBSITE_URL_CLIENTE+'cliente/validar';
                
                alert(urlPageConfir);

                let tipoEnvio     = "YES"; //si es fisico es YES si no es fisico es NO
                let test          =  1; //comercioData[0].estado; //0 ES REAL, 1 ES PRUEBA
                let signature     = apiKey+"~"+merchantId+"~"+referenceCode+"~"+amount+"~"+divisa;

                let signatureEnviar = CryptoJS.MD5(signature).toString();

                $('.formPayu').attr("method", "POST");
                $('.formPayu').attr("action", url);
                $('.formPayu input[name="merchantId"]').attr("value", merchantId);
                $('.formPayu input[name="accountId"]').attr("value", accountId);
                $('.formPayu input[name="description"]').attr("value", description);
                $('.formPayu input[name="referenceCode"]').attr("value", referenceCode);
                $('.formPayu input[name="amount"]').attr("value", amount);
                $('.formPayu input[name="tax"]').attr("value", 0);
                $('.formPayu input[name="taxReturnBase"]').attr("value", taxReturnBase);
                $('.formPayu input[name="shipmentValue"]').attr("value", shipmentValue);
                $('.formPayu input[name="currency"]').attr("value", divisa);
                $('.formPayu input[name="confirmationUrl"]').attr("value", urlPageConfir);
                $('.formPayu input[name="responseUrl"]').attr("value", `${BASE_URL}`);//http://www.test.com/response
                $('.formPayu input[name="declinedResponseUrl"]').attr("value", `${BASE_URL}`); //"http://www.test.com/confirmation"
                $('.formPayu input[name="displayShippingInformation"]').attr("value", tipoEnvio);
                $('.formPayu input[name="test"]').attr("value", test);
                $('.formPayu input[name="signature"]').attr("value", signatureEnviar);
                $('.formPayu input[name="Submit"]').attr("type", "submit").click(function() {
                    $('.formPayu').submit();
                });
        

            }

        }


    }
    /*========= END PAYMENT GATEWAY=========*/
})  
