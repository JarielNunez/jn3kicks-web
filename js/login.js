/* ========================================================
   LOGIN.JS - JN3 KICKS
   Manejo de inicio de sesión usando localStorage
   (Sin backend / sin JWT por el momento)

   ESTRUCTURA ESPERADA EN localStorage:
   key: "usuarios"
   value: Array de objetos:
   [
     {
       nombre: "Juan Pérez",
       email: "juan@correo.com",
       password: "123456",       // texto plano (temporal, sin backend)
       rol: "cliente",           // "admin" | "cliente"
       fechaRegistro: "2026-09-08T10:00:00.000Z"
     },
     ...
   ]

   NOTA PARA EL EQUIPO:
   Al cargar esta página por primera vez (o si borran el localStorage),
   se crean automáticamente 2 usuarios de prueba (ver
   inicializarUsuariosPorDefecto). Úsenlos para probar el login sin
   tener que escribir nada manualmente en la consola:

     ADMIN   -> admin@jn3kicks.com   / admin123
     CLIENTE -> cliente@jn3kicks.com / cliente123
   ======================================================== */

/**
 * Crea usuarios de prueba en localStorage si aún no existe la key
 * "usuarios" (o si está vacía). Así el equipo siempre tiene con qué
 * probar el login sin depender de un register.js todavía.
 *
 * Se ejecuta ANTES de cualquier otra cosa, fuera del DOMContentLoaded,
 * para que los datos ya estén listos apenas se cargue el script.
 */
function inicializarUsuariosPorDefecto() {
  const usuariosExistentes = localStorage.getItem("usuarios");
  const usuarios = usuariosExistentes ? JSON.parse(usuariosExistentes) : [];

  if (Array.isArray(usuarios) && usuarios.length > 0) {
    // Ya hay usuarios guardados, no tocamos nada.
    return;
  }

  const usuariosPorDefecto = [
    {
      nombre: "Administrador",
      email: "admin@jn3kicks.com",
      password: "admin123",
      rol: "admin",
      fechaRegistro: new Date().toISOString(),
    },
    {
      nombre: "Cliente Demo",
      email: "cliente@jn3kicks.com",
      password: "cliente123",
      rol: "cliente",
      fechaRegistro: new Date().toISOString(),
    },
  ];

  localStorage.setItem("usuarios", JSON.stringify(usuariosPorDefecto));
  console.info(
    "%c[JN3 KICKS] Usuarios de prueba creados en localStorage:",
    "color: #2563eb; font-weight: bold;",
    "\n  ADMIN   -> admin@jn3kicks.com / admin123",
    "\n  CLIENTE -> cliente@jn3kicks.com / cliente123"
  );
}

// Se ejecuta apenas se carga el script, sin esperar el DOMContentLoaded,
// porque no depende de ningún elemento del HTML.
inicializarUsuariosPorDefecto();

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("loginForm");
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const rememberCheckbox = document.querySelector('input[name="remember"]');

  // Redirección tras login exitoso
  const REDIRECT_URL = "../index.html";

  // Reglas de validación
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

    const submitButton = form.querySelector(
      ".login-card__button--primary"
    );
    submitButton.insertAdjacentElement("beforebegin", errorEl);
  }

  // ------------------------------------------------------
  // Validaciones
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
  // Acceso a datos (localStorage)
  // ------------------------------------------------------

  /**
   * Obtiene el array de usuarios guardado en localStorage.
   * Si no existe o está corrupto, devuelve un array vacío.
   */
  function obtenerUsuarios() {
    try {
      const data = localStorage.getItem("usuarios");
      const usuarios = data ? JSON.parse(data) : [];
      return Array.isArray(usuarios) ? usuarios : [];
    } catch (error) {
      console.error("Error al leer usuarios de localStorage:", error);
      return [];
    }
  }

  /**
   * Busca un usuario por email (case-insensitive).
   */
  function buscarUsuarioPorEmail(email, usuarios) {
    const emailNormalizado = email.trim().toLowerCase();
    return usuarios.find(
      (u) => u.email && u.email.trim().toLowerCase() === emailNormalizado
    );
  }

  // ------------------------------------------------------
  // Manejo de sesión
  // ------------------------------------------------------

  /**
   * Guarda la sesión activa. Usa localStorage si "recordar" está
   * marcado (persiste entre cierres de navegador), o sessionStorage
   * si no (se borra al cerrar la pestaña/navegador).
   *
   * IMPORTANTE: Nunca guardamos la contraseña en la sesión.
   *
   * ------------------------------------------------------------
   * INTEGRACIÓN FUTURA CON JWT:
   * Cuando exista backend, este objeto de sesión se reemplazará
   * por el token recibido, por ejemplo:
   *
   *   const sesion = {
   *     token: response.token,          // JWT recibido del backend
   *     expiresAt: response.expiresAt,  // fecha de expiración
   *   };
   *
   * Y las validaciones de email/password dejarán de compararse
   * contra localStorage; en su lugar se enviará un fetch/POST
   * al endpoint de login y el backend responderá con el token.
   * ------------------------------------------------------------
   */
  function guardarSesion(usuario, recordar) {
    const sesion = {
      nombre: usuario.nombre,
      email: usuario.email,
      rol: usuario.rol || "cliente", // por si algún usuario viejo no tiene rol
      loginTimestamp: new Date().toISOString(),
      // token: null  <-- aquí se guardaría el JWT en el futuro
    };

    const storage = recordar ? localStorage : sessionStorage;
    storage.setItem("sesionActiva", JSON.stringify(sesion));

    // Si se guarda en un storage, aseguramos que no quede
    // una sesión vieja en el otro storage.
    const storageContrario = recordar ? sessionStorage : localStorage;
    storageContrario.removeItem("sesionActiva");
  }

  // ------------------------------------------------------
  // Manejo del submit del formulario
  // ------------------------------------------------------

  form.addEventListener("submit", (event) => {
    event.preventDefault();
    limpiarTodosLosErrores();

    const email = emailInput.value.trim();
    const password = passwordInput.value;
    const recordar = rememberCheckbox ? rememberCheckbox.checked : false;

    // 1. Validación de formato (frontend)
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

    // 2. Verificación contra los usuarios guardados
    const usuarios = obtenerUsuarios();
    const usuarioEncontrado = buscarUsuarioPorEmail(email, usuarios);

    // Por seguridad, no revelamos si falló el email o la contraseña,
    // solo mostramos un mensaje genérico.
    if (!usuarioEncontrado || usuarioEncontrado.password !== password) {
      mostrarErrorGeneral("Correo electrónico o contraseña incorrectos.");
      return;
    }

    // 3. Login exitoso: guardar sesión y redirigir
    guardarSesion(usuarioEncontrado, recordar);
    window.location.href = REDIRECT_URL;
  });
});