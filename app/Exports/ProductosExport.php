<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductosExport implements FromCollection, WithHeadings
{
    protected $filters;

    // Constructor para pasar los filtros
    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        // Obtén la consulta de productos
        $query = Producto::query();

        // Aplica los filtros si existen
        if ($this->filters['nombre']) {
            $query->where('nombre', 'like', '%' . $this->filters['nombre'] . '%');
        }

        if ($this->filters['categoria']) {
            $query->where('categoria_id', $this->filters['categoria']);
        }

        if ($this->filters['precio_min']) {
            $query->where('precio', '>=', $this->filters['precio_min']);
        }

        if ($this->filters['precio_max']) {
            $query->where('precio', '<=', $this->filters['precio_max']);
        }

        // Devuelve los productos filtrados
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Nombre', 'Descripción', 'Precio', 'Stock', 'Categoría', 'Proveedor', 'Foto'
        ];
    }
}

