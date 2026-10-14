<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    protected $table = 'pedido_detalle';
    public $timestamps = false;
    protected $fillable = ['pedido_id', 'producto_id', 'cantidad', 'precio_unitario'];

    public function producto() { return $this->belongsTo(Producto::class); }
}
