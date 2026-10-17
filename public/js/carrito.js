// ----- CARRITO (Jariel) -----
const ENVIO = 250;
const TOKEN = document.querySelector('meta[name="csrf-token"]').content;


function activarEventos() {
    const articulos = document.querySelectorAll(".carrito-item");

    articulos.forEach(function(articulo) {
        const carritoId = articulo.dataset.carritoId;
        const botones = articulo.querySelectorAll(".carrito-item__btn");
        const botonRestar = botones[0];
        const botonSumar = botones[1];
        const cantidadTexto = articulo.querySelector(".carrito-item__cantidad");
        const botonEliminar = articulo.querySelector(".carrito-item__eliminar");

        botonSumar.addEventListener("click", function() {
            let cantidadActual = parseInt(cantidadTexto.textContent);
            cantidadActual = cantidadActual + 1;
            cantidadTexto.textContent = cantidadActual;
            guardarCantidad(carritoId, cantidadActual);
            actualizarTotales();
        });

        botonRestar.addEventListener("click", function() {
            let cantidadActual = parseInt(cantidadTexto.textContent);
            if (cantidadActual > 1) {
                cantidadActual = cantidadActual - 1;
                cantidadTexto.textContent = cantidadActual;
                guardarCantidad(carritoId, cantidadActual);
                actualizarTotales();
            }
        });

        botonEliminar.addEventListener("click", function(evento) {
            evento.preventDefault();
            eliminarArticulo(carritoId, articulo);
        });
    });
}

function guardarCantidad(carritoId, nuevaCantidad) {
    fetch("/carrito/" + carritoId, {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": TOKEN
        },
        body: JSON.stringify({ cantidad: nuevaCantidad })
    });
}

function eliminarArticulo(carritoId, elemento) {
    fetch("/carrito/" + carritoId, {
        method: "DELETE",
        headers: {
            "Accept": "application/json",
            "X-CSRF-TOKEN": TOKEN
        }
    })
    .then(function(respuesta) {
        return respuesta.json();
    })
    .then(function(datos) {
        if (datos.exito) {
            elemento.remove();
            actualizarTotales();
            if (document.querySelectorAll(".carrito-item").length === 0) {
    document.querySelector(".carrito-pagina__lista").innerHTML =
        '<p class="carrito-pagina__vacio">Tu carrito está vacío.</p>';
}
        }
    });
}


function formatoRD(numero) {
    return "RD$" + numero.toLocaleString("es-DO", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function actualizarTotales() {
    const articulos = document.querySelectorAll(".carrito-item");
    let subtotalGeneral = 0;

    articulos.forEach(function(articulo) {
        const precio = parseFloat(articulo.dataset.precio);
        const cantidad = parseInt(articulo.querySelector(".carrito-item__cantidad").textContent);
        subtotalGeneral = subtotalGeneral + (precio * cantidad);
    });

    const envio = articulos.length > 0 ? ENVIO : 0;
    const totalGeneral = subtotalGeneral + envio;

    document.querySelector(".carrito-resumen__valor-subtotal").textContent = formatoRD(subtotalGeneral);
    document.querySelector(".carrito-resumen__valor-envio").textContent = formatoRD(envio);
    document.querySelector(".carrito-resumen__valor-total").textContent = formatoRD(totalGeneral);
}


const botonPagar = document.querySelector(".carrito-resumen__boton");

botonPagar.addEventListener("click", function() {
    alert("¡Gracias por tu compra! Total a pagar: " + document.querySelector(".carrito-resumen__valor-total").textContent);
});

activarEventos();
actualizarTotales();