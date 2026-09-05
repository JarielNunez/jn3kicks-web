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

     // ---- Referencias al buscador ----
    const formBuscador = document.querySelector('.buscador__form');
    const inputBuscar = document.querySelector('#buscar');

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

             // Coincidencia con el texto de búsqueda (si hay alguno activo).
            // Se busca el texto dentro del nombre del producto, sin
            // importar mayúsculas/minúsculas ni acentos.
            const coincideBusqueda =
                textoBusquedaActivo === '' ||
                normalizarTexto(producto.nombre).includes(normalizarTexto(textoBusquedaActivo));
 
            const debeMostrarse =
                coincideMarca && coincideGenero && coincideCategoria && coincideBusqueda;
 
            producto.elemento.style.display = debeMostrarse ? '' : 'none';
        });

        mostrarMensajeSiNoHayResultados();
    }

     // ---- Quita acentos y pasa a minúsculas para comparar textos ----
    function normalizarTexto(texto) {
        return texto
            .toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '');
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

  
    // ==========================================================
    // VALIDACIÓN DEL BUSCADOR 
    // - Formato correcto (solo letras, números y espacios).
    // - Mensaje de error sin recargar la página.
    // ==========================================================
 
    // Expresión regular de formato válido: letras (con acentos/ñ),
    // números y espacios. Se acepta uno o más caracteres.
    const FORMATO_VALIDO = /^[a-zA-ZÀ-ÿ0-9\s]+$/;
 
    // Este bloque completo solo se arma si el form y el input existen
    // en el HTML. Si falta alguno, avisamos por consola en vez de
    // romper el resto del script.
    if (formBuscador && inputBuscar) {
 
        // Creamos el elemento donde se mostrará el mensaje de error,
        // justo después del input, y lo dejamos oculto por defecto.
        const mensajeError = document.createElement('span');
        mensajeError.className = 'buscador__error';
        mensajeError.setAttribute('role', 'alert');
        mensajeError.style.display = 'none';
        inputBuscar.insertAdjacentElement('afterend', mensajeError);
 
        // Asociamos el input con el mensaje de error para accesibilidad.
        mensajeError.id = 'buscar-error';
        inputBuscar.setAttribute('aria-describedby', 'buscar-error');
 
        // ---- Muestra un mensaje de error debajo del input ----
        function mostrarError(texto) {
            mensajeError.textContent = texto;
            mensajeError.style.display = 'block';
            inputBuscar.classList.add('buscador__input--error');
            inputBuscar.setAttribute('aria-invalid', 'true');
        }
 
        // ---- Limpia el mensaje de error ----
        function limpiarError() {
            mensajeError.textContent = '';
            mensajeError.style.display = 'none';
            inputBuscar.classList.remove('buscador__input--error');
            inputBuscar.removeAttribute('aria-invalid');
        }
 
        // ---- Valida el valor actual del input ----
        // Devuelve true si es válido, false si no (y muestra el error).
        function validarBusqueda(valor) {
            const valorLimpio = valor.trim();
 
            if (valorLimpio === '') {
                mostrarError('Por favor escribe algo para buscar.');
                return false;
            }
 
            if (!FORMATO_VALIDO.test(valorLimpio)) {
                mostrarError('Usa solo letras, números y espacios (sin símbolos).');
                return false;
            }
 
            limpiarError();
            return true;
        }
 
        // ---- Envío del formulario de búsqueda ----
        formBuscador.addEventListener('submit', (evento) => {
            evento.preventDefault(); // Nunca recargamos la página.
 
            const valor = inputBuscar.value;
 
            if (!validarBusqueda(valor)) {
                inputBuscar.focus();
                return;
            }
 
            textoBusquedaActivo = valor.trim();
            filtrarProductos();
        });
 
        // ---- Mientras el usuario escribe, quitamos el error si corrige ----
        inputBuscar.addEventListener('input', () => {
            if (mensajeError.style.display === 'block') {
                const valorLimpio = inputBuscar.value.trim();
                if (valorLimpio !== '' && FORMATO_VALIDO.test(valorLimpio)) {
                    limpiarError();
                }
            }
 
            // Si el usuario borra todo el campo, volvemos a mostrar
            // todos los productos (según los filtros de checkboxes).
            if (inputBuscar.value.trim() === '' && textoBusquedaActivo !== '') {
                textoBusquedaActivo = '';
                filtrarProductos();
            }
        });
 
    } else {
        console.error('catalogo.js: no se encontró ".buscador__form" o "#buscar" en el HTML. El buscador no va a funcionar.');
    } 
});