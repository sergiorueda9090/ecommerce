<html>
<!--

  los usuarios creados de pruebas debe crear una aplicacion en este caso
  yo tengo un usuario de prueba llamado vendeder1 y en el tengo una aplicacion ya creada
  llamada test-video-next-mercadopago.

  Public Key APP_USR-6a4f3f07-94f1-47a2-8d4e-11f0864543f4
  
  Access Token APP_USR-3527423441598344-122618-e7a971122ba78128c93e230b3236524a-2180719338

-->

  <?php var_dump($preference->id); ?>

  <body>
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <script>
      const mp = new MercadoPago('APP_USR-6a4f3f07-94f1-47a2-8d4e-11f0864543f4',{locale: 'es-CO'});
      const bricksBuilder = mp.bricks();
    </script>


          
    <div id="wallet_container"></div>



    <script>

      mp.bricks().create("wallet", "wallet_container", {
          initialization: {
              preferenceId: "<?php echo $preference->id; ?>",
          },
      });

    </script>
  </body>
</html>