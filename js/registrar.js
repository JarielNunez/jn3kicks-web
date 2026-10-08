const form = document.getElementById('registerForm');
const $ = (id) => document.getElementById(id);
 
function toggle(input, errorEl, invalid) {
  input.classList.toggle('invalid', invalid);
  errorEl.classList.toggle('show', invalid);
  return !invalid;
}
 
form.addEventListener('submit', (e) => {
  e.preventDefault();

  const nombreOk = toggle($('nombre'), $('nombreError'), $('nombre').value.trim() === '');
  const emailOk = toggle($('email'), $('emailError'), !/^\S+@\S+\.\S+$/.test($('email').value));
  const passOk = toggle($('password'), $('passError'), $('password').value.length < 8);
  const confirmOk = toggle($('confirm'), $('confirmError'), $('confirm').value !== $('password').value || !$('confirm').value);
  const termsOk = !($('terminos').checked === false);
  $('termsError').classList.toggle('show', !termsOk);
  if (!(nombreOk && emailOk && passOk && confirmOk && termsOk)) return;
  enviarRegistro();
});
 
function mostrarError(texto) {
  $('formError').textContent = texto;
  $('formError').classList.add('show');
}
 
// Envía nombre, correo y contrasena a registrar.php
async function enviarRegistro() {
  const btn = form.querySelector('.btn');
  $('formError').classList.remove('show');
  btn.disabled = true;
  btn.textContent = 'Creando cuenta...';
  try {
    const resp = await fetch('php/registrar/registrar.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        nombre: $('nombre').value.trim(),
        correo: $('email').value.trim(),
        contrasena: $('password').value,
        terminos: $('terminos').checked
        })
    });
 
    let data = null;
    try { data = await resp.json(); } catch (e) { /* respuesta que no es JSON */ }
    if (resp.ok && data && data.exito) {
      window.location.href = 'login.php';
      return;
    }
    mostrarError(data ? data.mensaje : 'El servidor respondió algo inesperado (código ' + resp.status + '). Revisa la ruta api/auth/registrar.php.');
  } catch (err) {
    console.error('Error al registrar:', err);
    mostrarError('No se pudo conectar con el servidor (' + err.message + ').');
  }
 
  btn.disabled = false;
  btn.textContent = 'Crear Cuenta';
}