document.addEventListener('DOMContentLoaded', () => {
    const imagenPrincipal = document.querySelector('.producto__imagen');
    const miniaturas = document.querySelectorAll('.producto__miniatura');

    if (imagenPrincipal && miniaturas.length > 0) {
        miniaturas.forEach(miniatura => {
            miniatura.addEventListener('click', () => {
                imagenPrincipal.src = miniatura.src;
                miniaturas.forEach(m => m.classList.remove('producto__miniatura--activa'));
                miniatura.classList.add('producto__miniatura--activa');
            });
        });
    }

    const botonRestar = document.querySelector('.producto__cantidad-boton--restar');
    const botonSumar = document.querySelector('.producto__cantidad-boton--sumar');
    const inputCantidad = document.querySelector('.producto__cantidad-input');

    if (botonRestar && botonSumar && inputCantidad) {
        botonRestar.addEventListener('click', () => {
            let valorActual = parseInt(inputCantidad.value) || 1;
            if (valorActual > 1) {
                inputCantidad.value = valorActual - 1;
            }
        });

        botonSumar.addEventListener('click', () => {
            let valorActual = parseInt(inputCantidad.value) || 1;
            inputCantidad.value = valorActual + 1;
        });
    }

    const selectTalla = document.getElementById('talla');
    const botonAgregarCarrito = document.querySelector('.producto__boton-carrito');

    if (botonAgregarCarrito && selectTalla) {
        botonAgregarCarrito.addEventListener('click', (evento) => {
            const tallaSeleccionada = selectTalla.value;

            // Validación de talla obligatoria (verificando que esté vacía o en la opción por defecto)
            if (!tallaSeleccionada || tallaSeleccionada.trim() === '' || selectTalla.selectedIndex === 0) {
                evento.preventDefault();
                alert('Por favor, selecciona una talla antes de añadir el producto al carrito.');
                selectTalla.focus();
                return;
            }

            // Validación de cantidad válida
            const cantidadComprada = inputCantidad ? parseInt(inputCantidad.value) : 1;
            if (!cantidadComprada || cantidadComprada < 1) {
                evento.preventDefault();
                alert('La cantidad debe ser al menos 1.');
                if (inputCantidad) inputCantidad.focus();
                return;
            }

            alert('Producto añadido al carrito con éxito. Talla: ' + tallaSeleccionada + ' - Cantidad: ' + cantidadComprada);
        });
    }
});
