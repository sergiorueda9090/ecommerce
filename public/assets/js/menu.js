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
                                                    <small>${element.quantity} x ${element.sale.replace(/\B(?=(\d{3})+(?!\d))/g, ".")}</small>
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

    $(document).on("click", '.authenticationCustomeHeader', function(){
        authenticationCustomerHeader();
    });

    // Regular expression pattern for email validation
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function authenticationCustomerHeader(){
        let email    = $('#emailHeader').val();
        let password = $('#passwordHeader').val();  
    
        let validate = [null, undefined, ''];
    
        if(validate.includes(email) || validate.includes(password)){
            alert('Please enter a valid email address or password');        
            return false;
        }
    
        if (validateEmail(email)) {
            // Hide the "Iniciar sesión" button and show the loading button
            $('.authenticationCustomeHeader').addClass('d-none');
            $('.authenticationCustomeHeaderLoading').removeClass('d-none');
    
            let url = `${BASE_URL}authenticationCustomer`;
            let data = { email: email, password: password };
    
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
                showFailed(); // Handle error case
            })
            .then((response) => {
                if (response.status == 200) {
                    showSuccessButton();
                } else {
                    showFailed(); // Handle failure case
                }
            });
        } else {
            $('.errorEmailModal').removeClass('d-none');
        }
    }
    
    function showSuccessButton() {
        // Hide the loading button and show the success button
        $('.erroruserpassword').addClass('d-none');
        $('.authenticationCustomeHeaderLoading').addClass('d-none');
        $('.authenticationCustomeHeaderSuccess').removeClass('d-none');
        $('.errorEmailModal').addClass('d-none');

        // After a short delay, hide the success button and show the original "Iniciar sesión" button again
        setTimeout(() => {
            $('#sessionModal').modal('hide');
            $('.authenticationCustomeHeaderSuccess').addClass('d-none');
            $('.authenticationCustomeHeader').removeClass('d-none');
        }, 2000); // Adjust the delay as needed

        location.reload();
    }
    
    function showFailed() {
        // Hide the loading button and show the original "Iniciar sesión" button
        $('.authenticationCustomeHeaderLoading').addClass('d-none');
        $('.erroruserpassword').removeClass('d-none');
        $('.authenticationCustomeHeader').removeClass('d-none');
        $('.errorEmailModal').addClass('d-none');
    }


    $(document).on("click", '.cerrarSessionModal', function(){
        cerrarSessionModal();
    });


    function cerrarSessionModal(){

        let url = `${BASE_URL}cerrarSession`;

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
        })
        .then((res) => res.json())
        .catch((error) => {
            $('#cerrarSessionModal').modal('hide');
            location.reload();
        })
        .then((response) => {
            if (response.status == 200) {
                showSuccessCerrarButton();
            } else {
                $('#cerrarSessionModal').modal('hide');
                location.reload();
            }
        });
       
    }

    function showSuccessCerrarButton() {
        // Hide the loading button and show the success button
        $('.cerrarSessionModal').addClass('d-none');
        $('.cerrarSessionModalLoading').removeClass('d-none');
       

        // After a short delay, hide the success button and show the original "Iniciar sesión" button again
        setTimeout(() => {
            
            
            $('.cerrarSessionModalSuccess').removeClass('d-none');
            $('.cerrarSessionModal').addClass('d-none');
            $('.cerrarSessionModalLoading').addClass('d-none');
            

        }, 2000); // Adjust the delay as needed

        location.reload();
    }


    $(document).on("click", '.emailForgetModal', function(){
        forgetPasswordModal();
    });

    function forgetPasswordModal(){

        let email   = $('#emailForgetModel').val();

        let validate = [null, undefined, ''];
    
        if(validate.includes(email)){
            alert('Please enter a valid email address');        
            return false;
        }
    
        if (validateEmail(email)) {

            // Hide the "Iniciar sesión" button and show the loading button
            $('.emailForgetModal').addClass('d-none');
            $('.forgetPasswordLoagindModel').removeClass('d-none');
    
            let url = `${BASE_URL}forgetPasswordCustomer`;
            let data = { email: email };
    
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
                showFailedForgetPassword(); // Handle error case
            })
            .then((response) => {
                if (response.status == 200) {
                    showSuccessForgetPassword();
                } else {
                    showFailedForgetPassword(); // Handle failure case
                }
            });
        } else {
            $('.emailFailForget').removeClass('d-none');
        }
    }

    function showSuccessForgetPassword(){
        $('.emailFailForget').addClass('d-none');
        $('.emailForgetModal').addClass('d-none');
        $('.forgetPasswordLoagindModel').addClass('d-none');
        $('.forgetPasswordSucuccessModel').removeClass('d-none');
        location.reload();
    }

    function showFailedForgetPassword(){
        $('.emailFailForget').addClass('d-none');
        $('.emailForgetModal').removeClass('d-none');
        $('.forgetPasswordLoagindModel').addClass('d-none');
        $('.forgetPasswordSucuccessModel').addClass('d-none');
        $('.emailForgetFailModelTxT').removeClass('d-none');
    }

    
})