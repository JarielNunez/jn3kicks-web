// ----- CARRITO (Jariel) -----
function cargarCarrito() {
    fetch("php/carrito/carrito_ver.php")
        .then(function(respuesta) {
            return respuesta.json();
        })
        .then(function(datos) {
            mostrarArticulos(datos);
        });
}

function mostrarArticulos(articulosData) {
    const contenedor = document.querySelector(".carrito-pagina__lista");
    contenedor.innerHTML = "";

    articulosData.forEach(function(articulo) {
        const div = document.createElement("div");
        div.classList.add("carrito-item");
        div.dataset.carritoId = articulo.id; // Guardamos el ID real de la fila en la BD

        div.innerHTML = `
            <div class="carrito-item__imagen"></div>
            <div class="carrito-item__info">
                <span class="carrito-item__nombre">${articulo.nombre}</span>
                <span class="carrito-item__precio">$${articulo.precio}</span>
            </div>
            <div class="carrito-item__controles">
                <button class="carrito-item__btn">&lt;</button>
                <span class="carrito-item__cantidad">${articulo.cantidad}</span>
                <button class="carrito-item__btn">&gt;</button>
            </div>
            <a href="#" class="carrito-item__eliminar">Eliminar</a>
        `;

        contenedor.appendChild(div);
    });

    activarEventos(); // Conecta los botones DESPUÉS de crear el HTML
    actualizarTotales();
}

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
            eliminarArticulo(carritoId);
        });
    });
}

function guardarCantidad(carritoId, nuevaCantidad) {
    fetch("php/carrito/carrito_actualizar.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "carrito_id=" + carritoId + "&cantidad=" + nuevaCantidad
    });
}

function eliminarArticulo(carritoId) {
    fetch("php/carrito/carrito_eliminar.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "carrito_id=" + carritoId
    })
    .then(function(respuesta) {
        return respuesta.json();
    })
    .then(function(datos) {
        if (datos.exito) {
            cargarCarrito(); // Vuelve a pedir la lista actualizada al servidor
        }
    });
}

function actualizarTotales() {
    const articulos = document.querySelectorAll(".carrito-item");
    let subtotalGeneral = 0;

    articulos.forEach(function(articulo) {
        const precioTexto = articulo.querySelector(".carrito-item__precio").textContent;
        const cantidadTexto = articulo.querySelector(".carrito-item__cantidad").textContent;
        const precio = limpiarPrecio(precioTexto);
        const cantidad = parseInt(cantidadTexto);
        subtotalGeneral = subtotalGeneral + (precio * cantidad);
    });

    const envio = articulos.length > 0 ? 10 : 0;
    const totalGeneral = subtotalGeneral + envio;

    document.querySelector(".carrito-resumen__valor-subtotal").textContent = "$" + subtotalGeneral.toFixed(2);
    document.querySelector(".carrito-resumen__valor-envio").textContent = "$" + envio.toFixed(2);
    document.querySelector(".carrito-resumen__valor-total").textContent = "$" + totalGeneral.toFixed(2);
}

function limpiarPrecio(textoConSimbolo) {
    const numeroLimpio = textoConSimbolo.replace("$", "");
    const numeroFinal = parseFloat(numeroLimpio);
    return numeroFinal;
}

const botonPagar = document.querySelector(".carrito-resumen__boton");

botonPagar.addEventListener("click", function() {
    alert("¡Gracias por tu compra! Total a pagar: " + document.querySelector(".carrito-resumen__valor-total").textContent);
});

cargarCarrito(); // En vez de actualizarTotales() suelto, ahora arrancamos pidiendo los datos reales