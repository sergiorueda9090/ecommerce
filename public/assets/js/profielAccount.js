$(document).on('change','.deparmentsupdate',function(){
    $(".iconLoagingCities").removeClass("d-none");
    selectCity();
});

function selectCity(){
    
    $(".cityupdate").empty();

    let idDepartment = $(".deparmentsupdate").val();
    
    console.log("idDepartment ",idDepartment);

    let url = `${BASE_URL}city`;
    
    let data = { idDepartment };
    
    $(".cityupdate").append('<option value="">Loading</option>');

    fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json",
    },
    })
    .then((res) => res.json())
    .catch((error) => console.error("Error:", error))
    .then((response) => response.status == 200 ? showCity(response.message, response.data) : showFailedRegister(response.message));
}

function showCity(message, data){
        
    $(".cityupdate").empty();
    
    $(".cityupdate").append('<option value="">Seleccionar</option>');

    let citys = JSON.parse(data);

    citys.forEach((element, index) => {
        $(".cityupdate").append(`<option value="${element.id_municipio}">
                            ${element.municipio}
                        </option>`
                    );
   });
   $(".iconLoagingCities").addClass("d-none");
}

function showFailedRegister(response){

    alert(response)

}

$(document).on('click','.btnUpdateInfo',function(){
    btnUpdateInfo();
})

function btnUpdateInfo() {
    
    let fields = [
        { name: 'First name', value: $('.firstnameupdate').val().trim() },
        { name: 'Last name', value: $('.lastnameupdate').val().trim() },
        { name: 'Email', value: $('.emailupdate').val().trim() },
        { name: 'Department', value: $('.deparmentsupdate').val().trim() },
        { name: 'City', value: $('.cityupdate').val().trim() },
        { name: 'Phone number', value: $('.phoneupdate').val().trim() },
        { name: 'Address', value: $('.addressupdate').val().trim() },
        //{ name: 'Additional Info', value: $('.addaddtioninfoupdate').val().trim() }
    ];

    let validate = [null, undefined, ''];
    let isValid = true;

    // Itera sobre cada campo para verificar si está vacío
    fields.forEach(field => {
        if (validate.includes(field.value)) {
            showFailedRegister(`Please enter your ${field.name}`);
            isValid = false;
            return false;  // Rompe el bucle al encontrar un error
        }
    });

    if (!isValid) {
        return false;  // Detiene la ejecución si hubo un error
    }

    // Validación de formato del email
    let email = fields.find(field => field.name === 'Email').value;
    if (!validateEmail(email)) {
        showFailedRegister("Invalid email address");
        return false;
    }

    // Validación de teléfono (ejemplo para 10 dígitos)
    let phoneupdate = fields.find(field => field.name === 'Phone number').value;
    if (!/^\d{10}$/.test(phoneupdate)) {
        showFailedRegister("Please enter a valid 10-digit phone number");
        return false;
    }

    // Si todas las validaciones pasan, enviar la solicitud
    sendRequest({
        name: fields.find(field => field.name === 'First name').value,
        lastname: fields.find(field => field.name === 'Last name').value,
        email: email,
        department: fields.find(field => field.name === 'Department').value,
        city: fields.find(field => field.name === 'City').value,
        phone: phoneupdate,
        address: fields.find(field => field.name === 'Address').value,
        //additionalInfo: fields.find(field => field.name === 'Additional Info').value
    });
}

function sendRequest(data) {

    let url = `${BASE_URL}updateaccount`;

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.status != 200) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Asume que la respuesta es JSON
    })
    .then(result => {
        // Manejar la respuesta exitosa
        console.log('Success:', result);
        showSuccess('Information updated successfully'); // Puedes mostrar un mensaje de éxito
    })
    .catch(error => {
        // Manejar errores
        console.error('Error:', error);
        showFailedRegister('There was a problem updating the information'); // Mostrar un mensaje de error
    });
}

// Regular expression pattern for email validation
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showSuccess(msg){
    alert(msg)
}

$(document).on('click','.updatePasswordAccount',function(){

    validatePassword();

})

function validatePassword(){

    let validate = [null, undefined, ''];

    let oldPassword     = $(".oldPasswordAccount").val(); 
    let password        = $(".newPasswordAccount").val();
    let repitPassword   = $(".repitPasswordAccount").val();

    if( validate.includes(oldPassword) ){
        showFailedRegister('Please enter a oldPassword');        
        return false;
    }

    if( validate.includes(password) ){
        showFailedRegister('Please enter a password');        
        return false;
    }

    if( validate.includes(repitPassword) ){
        showFailedRegister('Please enter a repitPassword');        
        return false;
    }

    if(password != repitPassword){
        showFailedRegister('Passwords do not match');
        return false;
    }

    let url = `${BASE_URL}updatepassword`;

    let data = {
        oldPassword,
        password,
        repitPassword
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (response.status != 200) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Asume que la respuesta es JSON
    })
    .then(result => {
        // Manejar la respuesta exitosa
        console.log('Success:', result);
        showSuccess('Information updated successfully'); // Puedes mostrar un mensaje de éxito
    })
    .catch(error => {
        // Manejar errores
        console.error('Error:', error);
        showFailedRegister('There was a problem updating the information'); // Mostrar un mensaje de error
    });

}

