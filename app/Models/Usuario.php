<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';
    public $timestamps = false;

    // "rol" NO va aquí: así nadie puede registrarse como admin mandando rol=admin
    protected $fillable = ['nombre', 'correo', 'contrasena'];
    protected $hidden = ['contrasena', 'remember_token'];

    protected function casts(): array
    {
        return ['contrasena' => 'hashed'];   // se encripta sola al guardar
    }

    // Laravel busca una columna "password"; aquí le decimos cuál es la nuestra
    public function getAuthPassword() { return $this->contrasena; }
    public function getAuthPasswordName() { return 'contrasena'; }

    public function esAdmin(): bool { return $this->rol === 'admin'; }
}