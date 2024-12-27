<html>

<?php

var_dump($preference->id);
?>

<body>
<script src="https://sdk.mercadopago.com/js/v2"></script>
</body>

        


<div id="wallet_container"></div>

<script>

  const mp = new MercadoPago('APP_USR-6115ca56-ebe4-43d8-8703-70ce2f72da00', {locale: 'es-CO'});

  const bricksBuilder = mp.bricks();

  mp.bricks().create("wallet", "wallet_container", {
    initialization: {
        preferenceId: '<?php echo $preference->id; ?>',
    },
    customization: {
      texts: {
        valueProp: 'smart_option',
      },
    },
  });


  </script>
<!--<script src="https://sdk.mercadopago.com/js/v2"></script>


<div id="wallet_container"></div>

<div>
<form id="form-checkout" action="mercadopago/process_payment" method="post">
    <div>
      <div>
        <label for="zipCode">Zip Code</label>
        <input id="form-checkout__zipCode" name="zipCode" type="text">
      </div>
      <div>
        <label for="streetName">Street Name</label>
        <input id="form-checkout__streetName" name="streetName" type="text">
      </div>
      <div>
        <label for="streetNumber">Street Number</label>
        <input id="form-checkout__streetNumber" name="streetNumber" type="text">
      </div>
      <div>
        <label for="neighborhood">Neighborhood</label>
        <input id="form-checkout__neighborhood" name="neighborhood" type="text">
      </div>
      <div>
        <label for="city">Ciudad</label>
        <input id="form-checkout__city" name="city" type="text">
      </div>
      <div>
        <label for="federalUnit">Unidad Federal</label>
        <input id="form-checkout__federalUnit" name="federalUnit" type="text">
      </div>
      <div>
        <label for="phoneAreaCode">PhoneAreaCode</label>
        <input id="form-checkout__phoneAreaCode" name="phoneAreaCode" type="text">
      </div>
      <div>
        <label for="phoneNumber">PhoneNumber</label>
        <input id="form-checkout__phoneNumber" name="phoneNumber" type="text">
      </div>
      <div>
        <label for="email">E-mail</label>
        <input id="form-checkout__email" name="email" type="text">
      </div>
      <div>
        <label for="personType">Tipo de persona</label>
        <select id="form-checkout__personType" name="personType" type="text">
          <option value="natural">Natural</option>
          <option value="juridica">Jurídica</option>
        </select>
      </div>
      <div>
        <label for="identificationType">Tipo de documento</label>
        <select id="form-checkout__identificationType" name="identificationType" type="text"></select>
      </div>
      <div>
        <label for="identificationNumber">Número del documento</label>
        <input id="form-checkout__identificationNumber" name="identificationNumber" type="text">
      </div>
    </div>
    <div>
      <div>
        <label for="banksList">Banco</label>
        <div id="banksList"></div> 
      </div>
    </div>
    <div>
      <div>
        <input type="hidden" name="transactionAmount" id="transactionAmount" value="100">
        <input type="hidden" name="description" id="description" value="Nome do Produto">
        <br>
        <button type="submit">Pagar</button>
      </div>
    </div>
  </form>
</div>-->

<script>
/*
document.getElementById('form-checkout__personType').addEventListener('change', e => {
	const personTypesElement = document.getElementById('form-checkout__personType');
	updateSelectOptions(personTypesElement.value);
});

function updateSelectOptions(selectedValue) {

	const naturalDocTypes = [
		new Option('C.C', 'CC'),
		new Option('C.E.', 'CE'),
		new Option('Pasaporte', 'PAS'),
		new Option('Tarjeta de Extranjería', 'TE'),
		new Option('Tarjeta de Identidad ', 'TI'),
		new Option('Registro Civil', 'RC'),
		new Option('Documento de Identificación', 'DI')
	];
	const juridicaDocTypes = [
		new Option('NIT', 'NIT')
	];
	const idDocTypes = document.getElementById('form-checkout__identificationType');

	if (selectedValue === 'natural') {
		idDocTypes.options.length = 0;
		naturalDocTypes.forEach(item => idDocTypes.options.add(item, undefined));
	} else {
		idDocTypes.options.length = 0;
		juridicaDocTypes.forEach(item => idDocTypes.options.add(item, undefined));
	}
};

function setPse() { 
    fetch('mercadopago/payment_methods')
        .then(async function(response) {
            if (!response.ok) {
                throw new Error('Error al obtener los métodos de pago');
            }

            const result = await response.json();
            const paymentMethods = result.data; // Accede a la propiedad "data"

            if (!Array.isArray(paymentMethods)) {
                throw new Error('El formato de la respuesta no es el esperado');
            }

            // Buscar el método de pago PSE
            const pse = paymentMethods.find((method) => method.id === 'pse');

            if (!pse) {
                console.error('Método de pago PSE no encontrado');
                return;
            }

            // Obtener la lista de instituciones financieras
            const banksList = pse.financial_institutions;

            if (!banksList || banksList.length === 0) {
                console.error('No se encontraron bancos para PSE');
                return;
            }

            // Crear el elemento select dinámicamente
            const banksListElement = document.getElementById('banksList');
            const selectElement = document.createElement('select');
            selectElement.name = 'financialInstitution';

            // Llenar el select con las opciones de los bancos
            banksList.forEach(bank => {
                const option = document.createElement('option');
                option.value = bank.id;
                option.textContent = bank.description;
                selectElement.appendChild(option);
            });

            // Añadir el select al contenedor
            banksListElement.innerHTML = ''; // Limpiar contenido previo
            banksListElement.appendChild(selectElement);
        })
        .catch(function(reason) {
            console.error('Fallo al obtener métodos de pago', reason);
        });
}


(function initCheckout() {
    try {
        const docTypeElement = document.getElementById('form-checkout__identificationType');
        setPse();
        updateSelectOptions('natural')
    }catch(e) {
        return console.error('Error getting identificationTypes: ', e);
    }
 })();*/

</script>

</html>