function signin() {

    var login = document.getElementById("login-form");
    var register = document.getElementById("form-validate");
    
    login.style.display = "block";
    register.style.display = "none";
}

function signup() {
    var login = document.getElementById("login-form");
    var register = document.getElementById("form-validate");

    login.style.display = "none";
    register.style.display = "block";
}
