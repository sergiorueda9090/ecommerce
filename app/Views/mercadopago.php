<html>
       <!--
           //publi key TEST-0b53f700-820c-43bc-9370-818900e922ee
           //access token TEST-1717554301495497-120714-c979930e4e81371cb8ce72dbe2baccee-269393460
-->
<head>
  <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<body>
  <div id="paymentBrick_container"></div>
  <script>
    const mp = new MercadoPago('TEST-0b53f700-820c-43bc-9370-818900e922ee', {
      locale: 'es'
    });
    const bricksBuilder = mp.bricks();

    const renderPaymentBrick = async (bricksBuilder) => {
      const settings = {
        initialization: {
          amount: 10000, // Monto total de la compra
          preferenceId: "200000", // Asegúrate de configurar correctamente el Preference ID
          payer: {
            firstName: "Sergio",
            lastName: "Rueda",
            email: "sergiorueda90@hotmail.com",
          },
        },
        customization: {
          visual: {
            style: {
              theme: "default",
            },
          },
          paymentMethods: {
            creditCard: "all",
            debitCard: "all",
            bankTransfer: "all",
            atm: "all",
            onboarding_credits: "all",
            maxInstallments: 1,
          },
        },
        callbacks: {
          onReady: () => {
            // Callback para cuando el Brick está listo
          },
          onSubmit: ({ selectedPaymentMethod, formData }) => {
            return new Promise((resolve, reject) => {
              // Agregar información del producto
              const productData = {
                productId: "12345", // ID único del producto
                productName: "Camiseta Deportiva", // Nombre del producto
                quantity: 2, // Cantidad comprada
                price: 5000, // Precio unitario
                total: 10000, // Total por el producto
              };

              // Combinar información del pago con datos del producto
              const requestData = {
                ...formData,
                product: productData,
              };

              fetch("mercadopago/process_payment", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json",
                },
                body: JSON.stringify(requestData),
              })
                .then((response) => response.json())
                .then((response) => {
                  console.log("Respuesta del servidor:", response);
                  resolve();
                })
                .catch((error) => {
                  console.error("Error procesando el pago:", error);
                  reject();
                });
            });
          },
          onError: (error) => {
            console.error("Error en el Brick:", error);
          },
        },
      };

      window.paymentBrickController = await bricksBuilder.create(
        "payment",
        "paymentBrick_container",
        settings
      );
    };

    renderPaymentBrick(bricksBuilder);
  </script>
</body>
</html>
