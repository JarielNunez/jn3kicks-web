/* ========================================================
   LOGIN.JS - JN3 KICKS
   Manejo de inicio de sesión conectado a la API PHP
   (api/usuarios/login.php). La sesión ahora vive en el
   SERVIDOR (PHP $_SESSION + cookie PHPSESSID), no en
   localStorage ni sessionStorage.

   Cómo funciona la sesión ahora:
   1. El navegador manda correo + contraseña por fetch (POST).
   2. login.php verifica contra la BD con password_verify()
      y, si es correcto, abre una sesión PHP.
   3. El servidor responde con Set-Cookie: PHPSESSID=...
      (el navegador la guarda solo; nosotros no la tocamos).
   4. En cualquier otra página, para saber "¿hay alguien
      logueado?", se llama a api/usuarios/verificar_sesion.php
      (siempre con { credentials: "include" } para que la
      cookie de sesión viaje con la petición).
   5. Para cerrar sesión, se llama a api/usuarios/logout.php.

   AJUSTA LA RUTA si tu estructura de carpetas es distinta:
   este archivo asume que vive en algo como /pages/login.js
   y que la API está en /api/usuarios/... (por eso "../api").
   ======================================================== */

const API_LOGIN_URL = "/jn3kicks-web/php/login/login.php";

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("loginForm");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");

  // Redirección tras login exitoso
  const REDIRECT_URL = "/jn3kicks-web/index.html";

  // Reglas de validación (formato, antes de llamar a la API)
  const EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const PASSWORD_MIN_LENGTH = 6;

  // ------------------------------------------------------
  // Utilidades para mostrar errores en el formulario
  // ------------------------------------------------------

  /**
   * Muestra (o crea si no existe) un mensaje de error debajo
   * del campo indicado.
   */
  function mostrarError(input, mensaje) {
    limpiarError(input);

    const errorEl = document.createElement("span");
    errorEl.className = "login-card__error-message";
    errorEl.textContent = mensaje;
    errorEl.setAttribute("data-error-for", input.id);

    input.classList.add("login-card__input--error");
    input.insertAdjacentElement("afterend", errorEl);
  }

  /**
   * Elimina el mensaje de error asociado a un input, si existe.
   */
  function limpiarError(input) {
    input.classList.remove("login-card__input--error");
    const existente = input.parentElement.querySelector(
      `[data-error-for="${input.id}"]`
    );
    if (existente) existente.remove();
  }

  /**
   * Limpia todos los errores del formulario (campos + error general).
   */
  function limpiarTodosLosErrores() {
    limpiarError(emailInput);
    limpiarError(passwordInput);
    const errorGeneral = document.querySelector(".login-card__form-error");
    if (errorGeneral) errorGeneral.remove();
  }

  /**
   * Muestra un mensaje de error general (ej: credenciales incorrectas)
   * arriba del botón de submit.
   */
  function mostrarErrorGeneral(mensaje) {
    const existente = document.querySelector(".login-card__form-error");
    if (existente) existente.remove();

    const errorEl = document.createElement("p");
    errorEl.className = "login-card__form-error";
    errorEl.textContent = mensaje;
    errorEl.setAttribute("role", "alert");

    const submitButton = form.querySelector(".login-card__button--primary");
    submitButton.insertAdjacentElement("beforebegin", errorEl);
  }

  // ------------------------------------------------------
  // Validaciones de formato (frontend)
  // ------------------------------------------------------

  function validarEmail(email) {
    if (!email) {
      return "El correo electrónico es obligatorio.";
    }
    if (!EMAIL_REGEX.test(email)) {
      return "Ingresa un correo electrónico válido.";
    }
    return null;
  }

  function validarPassword(password) {
    if (!password) {
      return "La contraseña es obligatoria.";
    }
    if (password.length < PASSWORD_MIN_LENGTH) {
      return `La contraseña debe tener al menos ${PASSWORD_MIN_LENGTH} caracteres.`;
    }
    return null;
  }

  // ------------------------------------------------------
  // Llamada a la API de login
  // ------------------------------------------------------

  /**
   * Envía correo y contraseña a login.php. La API es quien decide
   * si son correctos (comparando contra el hash guardado con
   * password_verify), nunca lo validamos en el frontend.
   *
   * credentials: "include" es indispensable: le dice al navegador
   * que acepte y reenvíe la cookie de sesión (PHPSESSID) aunque el
   * fetch sea a otra ruta/puerto. Sin esto, la sesión no persiste.
   */
  async function iniciarSesionEnAPI(correo, contrasena) {
    const respuesta = await fetch(API_LOGIN_URL, {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      credentials: "include",
      body: JSON.stringify({ correo, contrasena }),
    });

    let datos;
    try {
      datos = await respuesta.json();
    } catch (error) {
      throw new Error(
        "El servidor no respondió correctamente. Verifica que XAMPP/Apache esté corriendo."
      );
    }

    if (!respuesta.ok || !datos.exito) {
      throw new Error(datos.mensaje || "Correo o contraseña incorrectos.");
    }

    return datos.usuario;
  }

  // ------------------------------------------------------
  // Manejo del submit del formulario
  // ------------------------------------------------------

  form.addEventListener("submit", async (event) => {
    event.preventDefault();
    limpiarTodosLosErrores();

    const email = emailInput.value.trim();
    const password = passwordInput.value;

    // 1. Validación de formato (frontend, antes de gastar una petición)
    const errorEmail = validarEmail(email);
    const errorPassword = validarPassword(password);

    let hayErrores = false;

    if (errorEmail) {
      mostrarError(emailInput, errorEmail);
      hayErrores = true;
    }

    if (errorPassword) {
      mostrarError(passwordInput, errorPassword);
      hayErrores = true;
    }

    if (hayErrores) return;

    // 2. Deshabilitamos el botón mientras esperamos la API, para
    //    evitar doble envío si el usuario hace doble clic.
    const submitButton = form.querySelector(".login-card__button--primary");
    const textoOriginalBoton = submitButton.textContent;
    submitButton.disabled = true;
    submitButton.textContent = "Ingresando...";

    try {
      // 3. Verificación contra la base de datos vía la API.
      //    Si la API responde exito:false, cae al catch de abajo.
      await iniciarSesionEnAPI(email, password);

      // 4. Login exitoso: la sesión ya quedó abierta en el servidor
      //    (cookie PHPSESSID). No guardamos nada en el navegador.
      window.location.href = REDIRECT_URL;
    } catch (error) {
      // Mensaje genérico, igual que antes: no revelamos si falló
      // el correo o la contraseña.
      mostrarErrorGeneral(error.message || "Correo electrónico o contraseña incorrectos.");
      submitButton.disabled = false;
      submitButton.textContent = textoOriginalBoton;
    }
  });
});