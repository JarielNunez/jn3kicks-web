// ==========================================================
// CATÁLOGO JN3 KICKS - Laravel
// Búsqueda, filtros y ordenamiento de productos.
// ==========================================================

document.addEventListener('DOMContentLoaded', () => {
    const contenedor = document.querySelector('#lista-productos');
    const inputBuscar = document.querySelector('#buscar');
    const filtroMarca = document.querySelector('#filtro-marca');
    const filtroGenero = document.querySelector('#filtro-genero');
    const filtroCategoria = document.querySelector('#filtro-categoria');
    const selectOrden = document.querySelector('#orden');
    const mensajeSinResultados = document.querySelector('#sin-resultados');

    // Comprobar que la vista tenga los elementos necesarios.
    if (
        !contenedor ||
        !inputBuscar ||
        !filtroMarca ||
        !filtroGenero ||
        !filtroCategoria ||
        !selectOrden
    ) {
        console.error(
            'JN3 KICKS: faltan elementos necesarios en la vista del catálogo.'
        );
        return;
    }

    // Obtener las tarjetas generadas por Laravel.
    const productos = Array.from(
        contenedor.querySelectorAll('.producto')
    ).map((elemento, indice) => ({
        elemento,
        indiceOriginal: indice,
        nombre: elemento.dataset.nombre || '',
        marca: elemento.dataset.marca || '',
        genero: elemento.dataset.genero || '',
        categoria: elemento.dataset.categoria || '',
        precio: Number.parseFloat(elemento.dataset.precio) || 0
    }));

    // Conservar el orden inicial para restaurarlo cuando corresponda.
    const ordenOriginal = [...productos];

    // Normalizar textos para comparar sin distinguir mayúsculas ni acentos.
    function normalizarTexto(texto) {
        return String(texto ?? '')
            .trim()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLocaleLowerCase('es');
    }

    // Aplicar la búsqueda y los filtros seleccionados.
    function filtrarProductos() {
        const busqueda = normalizarTexto(inputBuscar.value);
        const marcaSeleccionada = normalizarTexto(filtroMarca.value);
        const generoSeleccionado = normalizarTexto(filtroGenero.value);
        const categoriaSeleccionada = normalizarTexto(filtroCategoria.value);

        let cantidadVisibles = 0;

        productos.forEach((producto) => {
            const coincideNombre =
                normalizarTexto(producto.nombre).includes(busqueda);

            const coincideMarca =
                marcaSeleccionada === '' ||
                normalizarTexto(producto.marca) === marcaSeleccionada;

            const coincideGenero =
                generoSeleccionado === '' ||
                normalizarTexto(producto.genero) === generoSeleccionado;

            const coincideCategoria =
                categoriaSeleccionada === '' ||
                normalizarTexto(producto.categoria) === categoriaSeleccionada;

            const visible =
                coincideNombre &&
                coincideMarca &&
                coincideGenero &&
                coincideCategoria;

            producto.elemento.hidden = !visible;

            if (visible) {
                cantidadVisibles++;
            }
        });

        // Mostrar u ocultar el mensaje de resultados.
        if (mensajeSinResultados) {
            mensajeSinResultados.hidden = cantidadVisibles > 0;
        }
    }

    // Ordenar las tarjetas sin duplicarlas.
    function ordenarProductos() {
        const criterio = selectOrden.value;
        let productosOrdenados = [...productos];

        switch (criterio) {
            case 'precio-menor':
                productosOrdenados.sort(
                    (a, b) => a.precio - b.precio
                );
                break;

            case 'precio-mayor':
                productosOrdenados.sort(
                    (a, b) => b.precio - a.precio
                );
                break;

            case 'nombre':
                productosOrdenados.sort(
                    (a, b) =>
                        a.nombre.localeCompare(b.nombre, 'es', {
                            sensitivity: 'base'
                        })
                );
                break;

            case 'destacados':
            default:
                productosOrdenados = [...ordenOriginal];
                break;
        }

        productosOrdenados.forEach((producto) => {
            contenedor.appendChild(producto.elemento);
        });

        // Mantener aplicados la búsqueda y los filtros actuales.
        filtrarProductos();
    }

    // Búsqueda mientras se escribe.
    inputBuscar.addEventListener('input', filtrarProductos);

    // Actualizar al cambiar cualquier filtro.
    filtroMarca.addEventListener('change', filtrarProductos);
    filtroGenero.addEventListener('change', filtrarProductos);
    filtroCategoria.addEventListener('change', filtrarProductos);

    // Actualizar el orden de los productos.
    selectOrden.addEventListener('change', ordenarProductos);

    // Estado inicial.
    filtrarProductos();

    console.log('JN3 KICKS: catálogo inicializado correctamente.');
});