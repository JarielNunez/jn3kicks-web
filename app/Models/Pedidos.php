<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = 'pedidos';
    public $timestamps = false;
    protected $fillable = ['usuario_id', 'total', 'estado'];

    public function detalles() { return $this->hasMany(PedidoDetalle::class); }
}
