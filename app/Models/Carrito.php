<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';
    public $timestamps = false;
    protected $fillable = ['usuario_id', 'producto_id', 'cantidad'];

    public function producto() { return $this->belongsTo(Producto::class); }
}
