document.addEventListener('DOMContentLoaded', function () {
    const burger = document.querySelector('.burger');
    const navLinks = document.querySelector('.nav-links');

    burger.addEventListener('click', function () {
        navLinks.classList.toggle('show');
    });
});

function toggleFormulario(tipo) {
    var formulario = document.getElementById('formulario' + tipo);
    var alturaActual = formulario.offsetHeight;

    // Ocultar todos los formularios
    ocultarFormularios();

    if (alturaActual === 0) {
        formulario.style.height = formulario.scrollHeight + "px";
        formulario.style.padding = "20px";
    }
}

function ocultarFormularios() {
    var formularios = document.getElementsByClassName('form-container');
    for (var i = 0; i < formularios.length; i++) {
        formularios[i].style.height = 0;
        formularios[i].style.padding = 0;
    }
    
}

