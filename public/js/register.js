var registerMessage = document.querySelector('#registerMessage');
var registerForm = document.querySelector('#registerForm');

//Error paragraphs
var usernameRegisterError = document.querySelector('#usernameRegisterError');
var passwordRegisterError = document.querySelector('#passwordRegisterError');
var accountTypeError = document.querySelector('#accountTypeError');

//Form fields
var usernameField = document.querySelector('#usernameField');
var passwordField = document.querySelector('#passwordField');

//Clear registration message
registerMessage.innerHTML = '';


registerForm.onsubmit = () => registerFormValidation();



const registerFormValidation = () => {
    let validate = true;
    let accountTypeFields = document.querySelector('input[name = "accountType"]:checked');
    console.log('accounttypes',accountTypeFields);
    if(!usernameField.value || !passwordField.value || accountTypeFields == null){
        validate = false;
        registerMessage.innerHTML = 'Please enter all required data';
    } else{
        registerMessage.innerHTML = 'Creating an account...';
    }
    return validate;
}