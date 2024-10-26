<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaDeProducto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    protected $table = 'categorias_de_productos';

    /**
     * Relación con productos (una categoría puede tener muchos productos).
     */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}
