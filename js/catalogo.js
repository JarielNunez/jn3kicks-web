// ==========================================================
// FILTRO DE CATÁLOGO - JN3 KICKS
// Filtra los productos según los checkboxes de Marca, Género
// y Categoría en tiempo real.
// ==========================================================

document.addEventListener('DOMContentLoaded', () => {

    // ---- Arreglo de productos a partir del DOM ----
    // Cada producto guarda una referencia a su elemento HTML (para
    // mostrarlo/ocultarlo) y sus datos para poder filtrar.
    const productos = Array.from(document.querySelectorAll('.producto')).map(elemento => {
        const textoPrecio = elemento.querySelector('.producto__precio').textContent;
        const nombre = elemento.querySelector('.producto__titulo').textContent.trim();

        return {
            elemento,
            marca: elemento.dataset.marca || '',
            genero: elemento.dataset.genero || '',
            categoria: elemento.dataset.categoria || '',
            precio: parseFloat(textoPrecio.replace(/[^0-9.]/g, '')) || 0,
            nombre
        };
    });

    // Guardamos el orden original (tal como vienen en el HTML) para
    // poder volver a "Productos destacados".
    const ordenOriginal = [...productos];

    // ---- Referencias a filtros y al selector de orden ----
    const filtros = document.querySelector('.filtros');
    const selectOrden = document.querySelector('#orden');
    const contenedorProductos = document.querySelector('.catalogo__productos');

    // ---- Función que lee qué checkboxes están marcados ----
    // Devuelve un objeto como:
    // { marca: ['nike', 'converse'], genero: ['hombre'], categoria: [] }
    function obtenerFiltrosActivos() {
        const grupos = ['marca', 'genero', 'categoria'];
        const activos = {};

        grupos.forEach(grupo => {
            const checkboxesMarcados = filtros.querySelectorAll(
                `input[name="${grupo}"]:checked`
            );
            activos[grupo] = Array.from(checkboxesMarcados).map(cb => cb.value);
        });

        return activos;
    }

    // ---- Función que aplica el filtro sobre el arreglo ----
    function filtrarProductos() {
        const activos = obtenerFiltrosActivos();

        productos.forEach(producto => {
            // Si no hay ningún checkbox marcado en un grupo, ese grupo
            // no filtra nada (se muestran todos los valores).
            const coincideMarca =
                activos.marca.length === 0 || activos.marca.includes(producto.marca);

            const coincideGenero =
                activos.genero.length === 0 || activos.genero.includes(producto.genero);

            const coincideCategoria =
                activos.categoria.length === 0 || activos.categoria.includes(producto.categoria);

            const debeMostrarse = coincideMarca && coincideGenero && coincideCategoria;

            producto.elemento.style.display = debeMostrarse ? '' : 'none';
        });

        mostrarMensajeSiNoHayResultados();
    }

    // ---- Mensaje opcional cuando el filtro no arroja resultados ----
    function mostrarMensajeSiNoHayResultados() {
        const contenedor = document.querySelector('.catalogo__productos');
        let mensaje = document.querySelector('.catalogo__sin-resultados');

        const hayVisibles = productos.some(p => p.elemento.style.display !== 'none');

        if (!hayVisibles) {
            if (!mensaje) {
                mensaje = document.createElement('p');
                mensaje.className = 'catalogo__sin-resultados';
                mensaje.textContent = 'No se encontraron productos con esos filtros.';
                contenedor.appendChild(mensaje);
            }
        } else if (mensaje) {
            mensaje.remove();
        }
    }

    // ---- Función que ordena las tarjetas según la opción elegida ----
    function ordenarProductos() {
        const criterio = selectOrden.value;
        let productosOrdenados;

        switch (criterio) {
            case 'precio-menor':
                productosOrdenados = [...productos].sort((a, b) => a.precio - b.precio);
                break;

            case 'precio-mayor':
                productosOrdenados = [...productos].sort((a, b) => b.precio - a.precio);
                break;

            case 'nombre':
                productosOrdenados = [...productos].sort((a, b) =>
                    a.nombre.localeCompare(b.nombre, 'es', { sensitivity: 'base' })
                );
                break;

            case 'destacados':
            default:
                productosOrdenados = ordenOriginal;
                break;
        }

        // appendChild sobre un nodo que ya existe en el documento lo
        // MUEVE en vez de duplicarlo, así que es seguro reutilizarlo así.
        productosOrdenados.forEach(producto => {
            contenedorProductos.appendChild(producto.elemento);
        });
    }

    // ---- Cambios en los checkboxes (delegación de eventos) ----
    filtros.addEventListener('change', (evento) => {
        if (evento.target.classList.contains('filtros__checkbox')) {
            filtrarProductos();
        }
    });

    // ---- Cambio en el select de "Ordenar por" ----
    selectOrden.addEventListener('change', ordenarProductos);

});