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

function toggleText() {
    var points = document.getElementById("points");
    var moreText = document.getElementById("moreText");
    var textBtn = document.getElementById("textBtn");

    if (points.style.display === "none") {
        moreText.style.display = "none";
        points.style.display = "inline";
        textBtn.innerHTML = "LEER MAS";
    } else {
        moreText.style.display = "inline";
        points.style.display = "none";
        textBtn.innerHTML = "LEER MENOS";
    }
}

// require([
//     'jquery',
//     'slick'
// ], function ($) {
//     jQuery(document).ready(function () {
//         jQuery(".widget-product-grid").slick({
//             dots: true,
//             infinite: true,
//             speed: 300,
//             slidesToShow: 4,
//             slidesToScroll: 4,
//             responsive: [
//                 {
//                     breakpoint: 1280,
//                     settings: {
//                         slidesToShow: 3,
//                         slidesToScroll: 3
//                     }
//                 },
//                 {
//                     breakpoint: 768,
//                     settings: {
//                         slidesToShow: 2,
//                         slidesToScroll: 2
//                     }
//                 },
//                 {
//                     breakpoint: 600,
//                     settings: {
//                         slidesToShow: 1,
//                         slidesToScroll: 1
//                     }
//                 }
//             ]
//         });
//     });
// });



