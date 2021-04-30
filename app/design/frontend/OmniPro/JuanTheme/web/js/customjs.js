function signin() {

    var login = document.getElementById("login-form");
    var register = document.getElementById("form-validate");
    var btnIngreso = document.getElementById("btn-ingreso");
    var btnRegistro = document.getElementById("btn-registro");
    
    btnIngreso.style.opacity = "0.9";
    btnRegistro.style.opacity = "0.35";
    login.style.display = "block";
    register.style.display = "none";
}

function signup() {
    var login = document.getElementById("login-form");
    var register = document.getElementById("form-validate");
    var btnIngreso = document.getElementById("btn-ingreso");
    var btnRegistro = document.getElementById("btn-registro");

    btnIngreso.style.opacity = "0.35";
    btnRegistro.style.opacity = "0.9";
    login.style.display = "none";
    register.style.display = "block";
}


