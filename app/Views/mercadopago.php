<html>
<!--

  los usuarios creados de pruebas debe crear una aplicacion en este caso
  yo tengo un usuario de prueba llamado vendeder1 y en el tengo una aplicacion ya creada
  llamada testpidelibre.

  Public Key APP_USR-6115ca56-ebe4-43d8-8703-70ce2f72da00
  
  Access Token APP_USR-3527423441598344-122618-e7a971122ba78128c93e230b3236524a-2180719338

-->

  <?php

  var_dump($preference->id);
  ?>

  <body>
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
      const mp = new MercadoPago('APP_USR-6115ca56-ebe4-43d8-8703-70ce2f72da00',{location:'es-CO'});
      const bricksBuilder = mp.bricks();
    </script>


          
    <div id="wallet_container"></div>

    <script>
      mp.bricks().create("wallet", "wallet_container", {
          initialization: {
              preferenceId: "<?php echo $preference->id; ?>",
          },
          customization: {
            texts: {
              action: 'buy',
              valueProp: 'security_details',
            },
            visual: {
                buttonBackground: 'black',
                borderRadius: '16px',
            },
            checkout: {
                theme: {
                    elementsColor: "#4287F5",
                    headerColor: "#4287F5",
                },
            },
        },
        callbacks: {
          onReady: () => {},
          onSubmit: () => {},
          onError: (error) => console.error(error),
        },
      });
      //APP_USR-a603959e-46e6-4620-97d0-8b4567413bed
    </script>
  </body>
</html>