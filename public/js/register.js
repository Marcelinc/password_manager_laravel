var registerMessage = document.querySelector('#registerMessage');
var submitRegistration = document.querySelector('#submitRegistration');
var registerForm = document.querySelector('#registerForm');

//Error paragraphs


//Clear registration message
registerMessage.innerHTML = '';

submitRegistration.addEventListener('click', function(){
    registerMessage.innerHTML = 'Creating an account...';
});