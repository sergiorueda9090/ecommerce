
function subscribe(){
    
    let email = $('#email').val();  
    let validate = [null,undefined,''];

    if(validate.includes(email)){
        showFailed('Please enter a valid email address');        
        return false;
    }

    if (validateEmail(email)) {
        
        $(".subscribe").html('Enviando...');

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
    let url = BASE_URL;

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
    .then((response) => response.status == 200 ? showSuccess(response.message) : showFailed(response.message));
}

function showSuccess(mesage){
    $(".subscribe").html('Subscribe');
    $(".alert_ok").html(mesage).show().delay(4000).fadeOut();  
}

function showFailed(mesage){
    $(".subscribe").html('Subscribe');
    $(".alert_error").html(mesage).show().delay(4000).fadeOut()
}