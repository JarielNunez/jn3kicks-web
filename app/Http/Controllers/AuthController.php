<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class AuthController extends Controller
{
    // --- LOGIN & LOGOUT ---
    
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar la solicitud de inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'contrasena' => ['required'],
        ]);

        
        if (Auth::attempt(['correo' => $credentials['correo'], 'password' => $credentials['contrasena']], $request->boolean('recordar'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('correo');
    }

    // Procesar el cierre de sesión
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // --- REGISTRO ---

    // 1. Mostrar la vista del formulario de registro
    public function showRegisterForm()
    {
        return view('registro');
    }

    // 2. Procesar el registro en la base de datos
    public function register(Request $request)
    {
        // Validación de entradas
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,correo'],
            'contrasena' => ['required', 'string', 'min:6', 'confirmed'],
            'terminos' => ['accepted'], // Verifica que acepte términos
        ], [
            'correo.unique' => 'Este correo electrónico ya está registrado.',
            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
            'contrasena.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'terminos.accepted' => 'Debes aceptar los Términos y Condiciones.',
        ]);

        // Crear el usuario (el modelo Usuario aplica el cast 'hashed' automáticamente)
        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => $request->contrasena, // NO usar Hash::make()
            'rol' => 'cliente', // Rol por defecto
        ]);

        // Iniciar sesión automáticamente y regenerar sesión por seguridad
        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect('/')->with('mensaje', '¡Cuenta creada e inicio de sesión exitoso!');
    }

    // OLVIDE CONTRASEÑA


    // Muestra el formulario para buscar la cuenta
public function showFindAccountForm()
{
    return view('recuperar-contrasena');
}

// Procesa la búsqueda de la cuenta por correo
public function findAccount(Request $request)
{
    $request->validate([
        'correo' => ['required', 'email'],
    ], [
        'correo.required' => 'Por favor ingresa tu correo electrónico.',
        'correo.email' => 'Ingresa un formato de correo válido.',
    ]);

    // Verificar si el correo existe en la base de datos
    $usuario = \App\Models\Usuario::where('correo', $request->correo)->first();

    if (!$usuario) {
        return back()->withErrors([
            'correo' => 'No se encontró ninguna cuenta asociada a este correo.',
        ])->withInput();
    }

    // Aquí iría la lógica de envío de correo/reset token si aplica
    return back()->with('mensaje', 'Se han enviado las instrucciones de recuperación a tu correo.');
}
}
