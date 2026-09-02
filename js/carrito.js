// ----- CARRITO (Jariel) -----

const articulos = document.querySelectorAll(".carrito-item");

articulos.forEach(function(articulo) {

    // Buscamos los elementos SOLO dentro de este artículo específico
    const botones = articulo.querySelectorAll(".carrito-item__btn");
    const botonRestar = botones[0];
    const botonSumar = botones[1];
    const cantidadTexto = articulo.querySelector(".carrito-item__cantidad");

    // Evento del botón sumar
    botonSumar.addEventListener("click", function() {
        let cantidadActual = parseInt(cantidadTexto.textContent);
        cantidadActual = cantidadActual + 1;
        cantidadTexto.textContent = cantidadActual;
    });

    // Evento del botón restar
    botonRestar.addEventListener("click", function() {
        let cantidadActual = parseInt(cantidadTexto.textContent);

        if (cantidadActual > 1) {
            cantidadActual = cantidadActual - 1;
            cantidadTexto.textContent = cantidadActual;
        }
    });

});