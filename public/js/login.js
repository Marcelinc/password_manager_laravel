var loginMessage = document.querySelector('#loginMessage');
var submitLogin = document.querySelector('#submitLogin');
var loginForm = document.querySelector('#loginForm');

//Error paragraphs
var usernameInvalid = document.querySelector('#usernameInvalid');
var passwordInvalid = document.querySelector('#passwordInvalid');
var loginResponse = document.querySelector('#loginResponse');

//Input fields
var usernameField = document.querySelector('#usernameField');
var passwordField = document.querySelector('#passwordField');

//Clear login message
loginMessage.innerHTML = '';

loginForm.onsubmit = function(e){
    return loginFieldsValidation();
}



//Clear input fields messages after entering data
usernameField.addEventListener('change', function(e){
    if(e.target.value){
        usernameInvalid.style.display = 'none';
    }
});
passwordField.addEventListener('change', function(e){
    if(e.target.value){
        passwordInvalid.style.display = 'none';
    }
});



const loginFieldsValidation = () => {
    let valid = true;
    if(loginResponse)
        loginResponse.style.display = 'none';

    if(!usernameField.value || !passwordField.value){
        loginMessage.innerHTML = 'Enter login data';
        valid = false;
    } else{
        loginMessage.innerHTML = 'Logging in...';
    }
    return valid;
}