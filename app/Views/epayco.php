
<?php  echo $this->extend('template/layout'); ?>
<?php  echo $this->section("content"); ?>


<script type="text/javascript" src="https://epayco-checkout-testing.s3.amazonaws.com/checkout.preprod.js"></script>

<button id="payButton">Pagar con ePayco</button>
<script>
/*
La url de respuesta es utilizada para redirigir al usuario una vez terminada la operación. 
Se recomienda enviar en la URL un dato con el cual el sitio pueda identificar el registro, por ejemplo: 
https://prueba.com/response?{ref_payco}

Llaves secretas
Datos de configuración para la integración personalizada, copie estos datos y colóquelos en su formulario de envío POST.

P_CUST_ID_CLIENTE: 1532580
P_KEY: 306940419bcaf356f2d4618fee0537bae214d1ca


Llaves Secretas Api Rest, Onpage Checkout, Standart Checkout
Datos de configuración para la integración personalizada con nuestro Api Rest, Onpage Checkout, Standart Checkout.
            
PUBLIC_KEY: 7f6f6e51ca0bc66c7cea1b60e0b2665d
PRIVATE_KEY: f8d238bb89dd3e6278ef137c5991d66c
*/

    document.getElementById('payButton').addEventListener('click', function () {

    var handler = ePayco.checkout.configure({
        key: '7f6f6e51ca0bc66c7cea1b60e0b2665d', // Reemplaza con tu Public Key
        test: true // Modo de pruebas
    });

        var data = {
    // Parámetros obligatorios
            name: "Vestido Mujer Primavera",
            description: "Vestido Mujer Primavera",
            invoice: "MURCIA-1234",
            currency: "cop", // Moneda
            amount: "5000", // Total del pedido
            tax_base: "4000", // Subtotal
            tax: "500", // IVA
            tax_ico: "500", // Impuesto al consumo
            country: "co",
            lang: "es", // Usa el valor de lang

            //Onpage="false" - Standard="true"
            external: "false",

            // Atributos cliente
            name_billing: "Nelson Valencia",
            address_billing: "Carrera 19 numero 14 91",
            mobilephone_billing: "3005604163",
            number_doc_billing: "1000898574",
            email_billing: "email_billing",
            type_doc_billing: "cc",

            confirmation: "urlConfirmation",
            response: "urlResponse",

            // Atributos opcionales
            extra1: "extra1",
            extra2: "extra2",
            extra3: "extra3",

    // Deshabilitar métodos de pago
    methodsDisable: ["TDC", "PSE", "SP", "CASH", "DP"],
    method_confirmation: ["TDC", "PSE","SP","CASH","DP"],
};

        // Abre el checkout de ePayco
        handler.open(data);
    });
</script>

<?php  echo $this->endSection("content"); ?>