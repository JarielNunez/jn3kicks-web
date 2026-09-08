const formulario = document.getElementById("contactForm");

const nombre = document.getElementById("nombre");
const correo = document.getElementById("correo");
const telefono = document.getElementById("telefono");
const asunto = document.getElementById("asunto");
const mensaje = document.getElementById("mensaje");

const nombreError = document.getElementById("nombreError");
const correoError = document.getElementById("correoError");
const telefonoError = document.getElementById("telefonoError");
const asuntoError = document.getElementById("asuntoError");
const mensajeError = document.getElementById("mensajeError");

const formSuccess = document.getElementById("formSuccess");

formulario.addEventListener("submit", function (event) {

    event.preventDefault();

    let formularioValido = true;

    nombreError.textContent = "";
    correoError.textContent = "";
    telefonoError.textContent = "";
    asuntoError.textContent = "";
    mensajeError.textContent = "";
    formSuccess.textContent = "";

    // VALIDAR NOMBRE
    if (nombre.value.trim() === "") {
        nombreError.textContent = "El nombre es obligatorio.";
        formularioValido = false;
    } else if (nombre.value.trim().length < 3) {
        nombreError.textContent =
            "El nombre debe tener al menos 3 caracteres.";
        formularioValido = false;
    }

    // VALIDAR CORREO
    const correoValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (correo.value.trim() === "") {
        correoError.textContent = "El correo es obligatorio.";
        formularioValido = false;
    } else if (!correoValido.test(correo.value.trim())) {
        correoError.textContent =
            "Introduce un correo electrónico válido.";
        formularioValido = false;
    }

    // VALIDAR TELÉFONO
    const telefonoValido = /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/;

    if (telefono.value.trim() === "") {
        telefonoError.textContent = "El teléfono es obligatorio.";
        formularioValido = false;
    } else if (!telefonoValido.test(telefono.value.trim())) {
        telefonoError.textContent =
            "Utiliza el formato 849-410-0219.";
        formularioValido = false;
    }

    // VALIDAR ASUNTO
    if (asunto.value === "") {
        asuntoError.textContent =
            "Debes seleccionar un asunto.";
        formularioValido = false;
    }

    // VALIDAR MENSAJE
    if (mensaje.value.trim() === "") {
        mensajeError.textContent =
            "El mensaje es obligatorio.";
        formularioValido = false;
    } else if (mensaje.value.trim().length < 10) {
        mensajeError.textContent =
            "El mensaje debe tener al menos 10 caracteres.";
        formularioValido = false;
    }

    // RESULTADO
    if (formularioValido) {

        formSuccess.textContent =
            "¡Mensaje enviado correctamente! Gracias por contactar con JNS KICKS.";

        formulario.reset();
    }

});