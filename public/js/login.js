//Form elements
var loginMessage = document.querySelector('#loginMessage');
var loginForm = document.querySelector('#loginForm');
var submitLogin = document.querySelector('#submitLogin');

//Error paragraphs
var usernameInvalid = document.querySelector('#usernameInvalid');
var passwordInvalid = document.querySelector('#passwordInvalid');
var loginResponse = document.querySelector('#loginResponse');

//Input fields
var usernameField = document.querySelector('#usernameField');
var passwordField = document.querySelector('#passwordField');

//Variable that stores temporary lock date
var lockDateTime;

//Clear login message
loginMessage.innerHTML = '';


//Event listeners
loginForm.onsubmit = function(e){
    return loginFieldsValidation();
}
submitLogin.onclick = e => {
    if(updateTempLock())
        e.preventDefault();
}



//Clear input fields messages after entering data
usernameField.addEventListener('change', function(e){
    if(e.target.value){
        if(usernameInvalid) 
            usernameInvalid.style.display = 'none';
    }
});
passwordField.addEventListener('change', function(e){
    if(e.target.value){
        if(passwordInvalid)
            passwordInvalid.style.display = 'none';
    }
});


//Login form validation
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

//update temporary lock timer and button
const updateTempLock = () => {
    let locked = false;
    if(lockDateTime){
        // - locked dateTime passed
        let actualDateTime = new Date();
        let lockTime = createDateFromFormat(lockDateTime);

        //check if account has been temporarily blocked
        if(lockTime.getTime() > actualDateTime.getTime()){
            //account login blocked
            locked = true;
            //count left time to unlock
            let secondsToUnlock = Math.round((lockTime.getTime() - actualDateTime.getTime())/1000);
            loginResponse.innerHTML = `Wait ${secondsToUnlock} seconds until next login attempt`;
        }
    }
    return locked;
}

//Creates date from date passed as a string format YYYY-MM-DD HH:MM:SS
const createDateFromFormat = dateTimeString => {
    let parts = dateTimeString.split(/[\s-:]+/);
    let date = new Date(parts[0], parts[1] - 1, parts[2], parts[3], parts[4], parts[5]);
    return date;
}