@extends('layouts.app')

@section('titulo', 'Iniciar Sesión - JN3 KICKS')

@section('contenido')
<div class="login-container">
    <h2>Iniciar Sesión</h2>

    {{-- Mostrar errores generales o de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" name="correo" id="correo" value="{{ old('correo') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" required>
        </div>

        <button type="submit" class="btn-login">Ingresar</button>
    </form>

    <div class="auth-links" style="margin-top: 15px; display: flex; justify-content: space-between;">
        <a href="{{ url('/registro') }}">¿No tienes cuenta? Regístrate</a>
        <a href="{{ url('/recuperar-contrasena') }}">¿Olvidaste tu contraseña?</a>
    </div>
</div>
@endsection