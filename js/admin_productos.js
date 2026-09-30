// ==========================================================
// PANEL DE ADMINISTRACIÓN DE PRODUCTOS - JN3 KICKS (Jann)
// CRUD completo: Crear, Leer, Actualizar, Eliminar
// ==========================================================

const formulario = document.querySelector("#formProducto");
const formTitulo = document.querySelector("#formTitulo");
const botonGuardar = document.querySelector("#botonGuardar");
const botonCancelar = document.querySelector("#botonCancelar");
const mensaje = document.querySelector("#mensaje");
const cuerpoTabla = document.querySelector("#cuerpoTabla");

const campoId = document.querySelector("#productoId");
const campoNombre = document.querySelector("#nombre");
const campoPrecio = document.querySelector("#precio");
const campoImagen = document.querySelector("#imagen");
const campoMarca = document.querySelector("#marca");
const campoGenero = document.querySelector("#genero");
const campoCategoria = document.querySelector("#categoria");
const campoStock = document.querySelector("#stock");

// ---- READ: carga y dibuja la tabla de productos ----
async function cargarTabla() {
  const respuesta = await fetch("php/productos/productos_ver.php");
  const productos = await respuesta.json();

  cuerpoTabla.innerHTML = "";

  for (const producto of productos) {
    const fila = document.createElement("tr");

    fila.innerHTML = `
      <td><img class="admin__tabla-imagen" src="${producto.imagen}" alt="${producto.nombre}"></td>
      <td>${producto.nombre}</td>
      <td>RD$${Number(producto.precio).toLocaleString("es-DO")}</td>
      <td>${producto.marca}</td>
      <td>${producto.genero}</td>
      <td>${producto.categoria}</td>
      <td>${producto.stock}</td>
      <td class="admin__tabla-acciones">
        <button class="admin__boton-accion admin__boton-editar" data-id="${producto.id}">Editar</button>
        <button class="admin__boton-accion admin__boton-eliminar" data-id="${producto.id}">Eliminar</button>
      </td>
    `;

    cuerpoTabla.appendChild(fila);
  }
}

// ---- Muestra un mensaje de éxito o error debajo del formulario ----
function mostrarMensaje(texto, tipo) {
  mensaje.textContent = texto;
  mensaje.className = "admin__mensaje admin__mensaje--" + tipo;

  setTimeout(() => {
    mensaje.textContent = "";
    mensaje.className = "admin__mensaje";
  }, 3000);
}

// ---- Vuelve el formulario a su estado de "Agregar" ----
function limpiarFormulario() {
  formulario.reset();
  campoId.value = "";
  formTitulo.textContent = "Agregar producto nuevo";
  botonGuardar.textContent = "Agregar producto";
  botonCancelar.style.display = "none";
}

// ---- CREATE / UPDATE: se envía el mismo formulario para ambos ----
formulario.addEventListener("submit", async (evento) => {
  evento.preventDefault();

  const datos = new FormData();
  datos.append("nombre", campoNombre.value);
  datos.append("precio", campoPrecio.value);
  datos.append("imagen", campoImagen.value);
  datos.append("marca", campoMarca.value);
  datos.append("genero", campoGenero.value);
  datos.append("categoria", campoCategoria.value);
  datos.append("stock", campoStock.value);

  const esEdicion = campoId.value !== "";
  let url = "php/productos/productos_agregar.php";

  if (esEdicion) {
    datos.append("id", campoId.value);
    url = "php/productos/productos_actualizar.php";
  }

  const respuesta = await fetch(url, {
    method: "POST",
    body: datos
  });

  const resultado = await respuesta.json();

  if (resultado.exito) {
    mostrarMensaje(resultado.mensaje, "exito");
    limpiarFormulario();
    cargarTabla();
  } else {
    mostrarMensaje(resultado.mensaje, "error");
  }
});

// ---- Cancelar edición ----
botonCancelar.addEventListener("click", limpiarFormulario);

// ---- EDITAR / ELIMINAR: delegación de eventos sobre la tabla ----
cuerpoTabla.addEventListener("click", async (evento) => {

  // Editar: llena el formulario con los datos de esa fila
  if (evento.target.classList.contains("admin__boton-editar")) {
    const id = evento.target.dataset.id;
    const fila = evento.target.closest("tr");
    const celdas = fila.querySelectorAll("td");

    campoId.value = id;
    campoNombre.value = celdas[1].textContent;
    campoPrecio.value = celdas[2].textContent.replace(/[^0-9.]/g, "");
    campoImagen.value = fila.querySelector("img").getAttribute("src");
    campoMarca.value = celdas[3].textContent;
    campoGenero.value = celdas[4].textContent;
    campoCategoria.value = celdas[5].textContent;
    campoStock.value = celdas[6].textContent;

    formTitulo.textContent = "Editando: " + campoNombre.value;
    botonGuardar.textContent = "Guardar cambios";
    botonCancelar.style.display = "inline-block";

    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  // Eliminar: pide confirmación antes de borrar
  if (evento.target.classList.contains("admin__boton-eliminar")) {
    const id = evento.target.dataset.id;
    const nombreProducto = evento.target.closest("tr").querySelectorAll("td")[1].textContent;

    const confirmar = confirm(`¿Seguro que quieres eliminar "${nombreProducto}"? Esta acción no se puede deshacer.`);

    if (!confirmar) return;

    const datos = new FormData();
    datos.append("id", id);

    const respuesta = await fetch("php/productos/productos_eliminar.php", {
      method: "POST",
      body: datos
    });

    const resultado = await respuesta.json();

    if (resultado.exito) {
      mostrarMensaje(resultado.mensaje, "exito");
      cargarTabla();
    } else {
      mostrarMensaje(resultado.mensaje, "error");
    }
  }
});

// ---- Arranque ----
cargarTabla();
