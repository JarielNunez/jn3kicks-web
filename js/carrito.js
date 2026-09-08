// ----- CARRITO (Jariel) -----

const articulos = document.querySelectorAll(".carrito-item");

// Convierte un texto de precio como "$35.90" a un número: 35.90
function limpiarPrecio(textoConSimbolo) {
    const numeroLimpio = textoConSimbolo.replace("$", "");
    const numeroFinal = parseFloat(numeroLimpio);
    return numeroFinal;
}

// Recalcula subtotal, envío y total sumando todos los artículos
function actualizarTotales() {
    let subtotalGeneral = 0;

    articulos.forEach(function(articulo) {
        const precioTexto = articulo.querySelector(".carrito-item__precio").textContent;
        const cantidadTexto = articulo.querySelector(".carrito-item__cantidad").textContent;

        const precio = limpiarPrecio(precioTexto);
        const cantidad = parseInt(cantidadTexto);

        subtotalGeneral = subtotalGeneral + (precio * cantidad);
    });

    const envio = 10;
    const totalGeneral = subtotalGeneral + envio;

    document.querySelector(".carrito-resumen__valor-subtotal").textContent = "$" + subtotalGeneral.toFixed(2);
    document.querySelector(".carrito-resumen__valor-envio").textContent = "$" + envio.toFixed(2);
    document.querySelector(".carrito-resumen__valor-total").textContent = "$" + totalGeneral.toFixed(2);
}

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
        actualizarTotales();
    });

    // Evento del botón restar
    botonRestar.addEventListener("click", function() {
        let cantidadActual = parseInt(cantidadTexto.textContent);

        if (cantidadActual > 1) {
            cantidadActual = cantidadActual - 1;
            cantidadTexto.textContent = cantidadActual;
            actualizarTotales();
        }
    });

});

actualizarTotales(); // Calcula los totales correctos al cargar la página