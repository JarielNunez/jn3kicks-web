<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse | JN3 KICKS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet"><meta charset="UTF-8">
    <link rel="stylesheet" href="./CSS/registrar.css">
</head>
<body>
     
 
  <header class="header">
    <div class="inner">
      <a href="index.html" class="logo">JN3 KICKS</a>
    </div>
  </header>
 
  <main>
    <section class="card">
      <h1>Crea tu cuenta</h1>
      <p class="subtitle">Completa tus datos para registrarte en JN3 KICKS</p>
 
      <form id="registerForm" action="registrar.php" method="POST" novalidate>
        <div class="field">
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" autocomplete="name" maxlength="100" required>
          <p class="error-msg" id="nombreError">Ingresa tu nombre.</p>
        </div>
 
        <div class="field">
          <label for="email">Correo Electrónico</label>
          <input type="email" id="email" name="correo" placeholder="tucorreo@ejemplo.com" autocomplete="email" required>
          <p class="error-msg" id="emailError">Ingresa un correo válido.</p>
        </div>
 
        <div class="field">
          <label for="password">Contraseña</label>
          <input type="password" id="password" name="contrasena" placeholder="••••••••" autocomplete="new-password" required>
          <p class="hint">Mínimo 8 caracteres.</p>
          <p class="error-msg" id="passError">La contraseña debe tener al menos 8 caracteres.</p>
        </div>
 
        <div class="field">
          <label for="confirm">Confirmar Contraseña</label>
          <input type="password" id="confirm" placeholder="••••••••" autocomplete="new-password" required>
          <p class="error-msg" id="confirmError">Las contraseñas no coinciden.</p>
        </div>
 
        <label class="checkbox" for="terminos">
          <input type="checkbox" id="terminos" name="terminos" required>
          <span>Acepto los <a href="#">Términos y Condiciones</a> y la <a href="#">Política de Privacidad</a></span>
        </label>
        <p class="error-msg" id="termsError" style="margin-top:-18px; margin-bottom:18px;">Debes aceptar los términos para continuar.</p>
 
        <p class="error-msg" id="formError" style="margin: -8px 0 16px;"></p>
 
        <button type="submit" class="btn">Crear Cuenta</button>
      </form>
 
      <hr class="divider">
 
      <p class="footer-text">¿Ya tienes una cuenta? <a href="login.html">Inicia sesión</a></p>
    </section>
  </main> 

    <script src="js/registrar.js"></script>
  </main>
 
</body>
</html>