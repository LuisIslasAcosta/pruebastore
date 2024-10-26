<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'categoria_id', 'proveedor_id', 'foto'];

    /**
     * Relación con la categoría del producto (cada producto pertenece a una categoría).
     */
    public function categoria()
    {
        return $this->belongsTo(CategoriaDeProducto::class, 'categoria_id');
    }

    /**
     * Relación con el proveedor del producto (cada producto tiene un proveedor).
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
    
}
