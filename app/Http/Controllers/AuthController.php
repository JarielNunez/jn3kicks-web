<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Muestra la vista del formulario de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Procesar la solicitud de inicio de sesión
    public function login(Request $request)
    {
        // 1. Validar las entradas del usuario
        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'contrasena' => ['required'],
        ]);

        // 2. Intentar autenticar con las credenciales
        // NOTA: Mapeamos la entrada 'contrasena' a la llave interna 'password' que exige Auth::attempt
        if (Auth::attempt(['correo' => $credentials['correo'], 'password' => $credentials['contrasena']], $request->boolean('recordar'))) {
            // Regenerar la sesión por seguridad
            $request->session()->regenerate();

            // Redirigir a la página principal o a la intención previa
            return redirect()->intended('/');
        }

        // 3. Si falla, regresar con mensaje de error genérico
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
}
