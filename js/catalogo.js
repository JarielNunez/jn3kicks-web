// ==========================================================
// FILTRO DE CATÁLOGO - JN3 KICKS
// Filtra los productos según los checkboxes de Marca, Género
// y Categoría en tiempo real.
// ==========================================================

document.addEventListener('DOMContentLoaded', () => {

    // ---- Arreglo de productos a partir del DOM ----
    // Cada producto guarda una referencia a su elemento HTML (para
    // mostrarlo/ocultarlo) y sus datos para poder filtrar.
    const productos = Array.from(document.querySelectorAll('.producto')).map(elemento => ({
        elemento,
        marca: elemento.dataset.marca || '',
        genero: elemento.dataset.genero || '',
        categoria: elemento.dataset.categoria || ''
    }));

    // ---- Referencia al contenedor de filtros ----
    const filtros = document.querySelector('.filtros');

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

    // ---- cambios en los checkboxes (delegación de eventos) ----
    filtros.addEventListener('change', (evento) => {
        if (evento.target.classList.contains('filtros__checkbox')) {
            filtrarProductos();
        }
    });

});