<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // Especificar el nombre correcto de la tabla
    protected $table = 'proveedores';

    protected $fillable = ['nombre', 'telefono', 'email', 'direccion'];

    /**
     * Relación con productos (un proveedor puede suministrar muchos productos).
     */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'proveedor_id');
    }
}