<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\CategoriaDeProducto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Exports\ProductosExport;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    public function exportarExcel(Request $request)
{
    // Pasar los filtros actuales al exportador
    $filters = $request->only(['nombre', 'categoria', 'precio_min', 'precio_max']);

    // Exportar productos con los filtros aplicados
    return Excel::download(new ProductosExport($filters), 'productos.xlsx');
}
    
    

public function login(Request $request)
{
    // Validar las credenciales
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Autenticación exitosa...
        return redirect()->route('productos.index')->with('success', 'Inicio de Sesión completado con éxito. ¡Bienvenido!');
    }

    return redirect()->back()->withErrors(['email' => 'Las credenciales son incorrectas.']);
}


public function privada(Request $request)
{
    // Crear una consulta inicial
    $query = Producto::query();

    // Filtro por nombre
    if ($request->has('nombre') && $request->input('nombre') !== '') {
        $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
    }

    // Filtro por categoría
    if ($request->has('categoria') && $request->input('categoria') !== '') {
        $query->where('categoria_id', $request->input('categoria'));
    }

    // Filtro por precio mínimo
    if ($request->has('precio_min') && $request->input('precio_min') !== '') {
        $query->where('precio', '>=', $request->input('precio_min'));
    }

    // Filtro por precio máximo
    if ($request->has('precio_max') && $request->input('precio_max') !== '') {
        $query->where('precio', '<=', $request->input('precio_max'));
    }

    // Obtener los productos con paginación
    $productos = $query->paginate(10);

    // Obtener las categorías para el filtro (si las usas en la vista)
    $categorias = CategoriaDeProducto::all();

    return view('secret', compact('productos', 'categorias'));
}

public function index(Request $request)
{
    $query = Producto::query();

    // Filtro por nombre
    if ($request->has('nombre')) {
        $query->where('nombre', 'like', '%' . $request->input('nombre') . '%');
    }

    // Filtro por categoría
    if ($request->has('categoria') && $request->input('categoria') != '') {
        $query->where('categoria_id', $request->input('categoria'));
    }

    // Filtro por precio
    if ($request->has('precio_min')) {
        $query->where('precio', '>=', $request->input('precio_min'));
    }
    if ($request->has('precio_max')) {
        $query->where('precio', '<=', $request->input('precio_max'));
    }

    // Obtener los productos con paginación
    $productos = $query->paginate(10);

    // Obtener las categorías para el filtro
    $categorias = CategoriaDeProducto::all();

    return view('productos.index', compact('productos', 'categorias'));
}

public function graficos()
{
    // Puedes obtener datos necesarios para los gráficos desde la base de datos
    $productos = Producto::select('nombre', 'stock', 'precio')->get();

    return view('productos.graficos', compact('productos'));
}

public function estadisticas()
{
    // Obtener las categorías con el número de productos asociados
    $categorias_con_producto = CategoriaDeProducto::withCount('productos')->get();
    
    // Obtener los nombres de las categorías
    $categorias_nombres = $categorias_con_producto->pluck('nombre');
    
    // Obtener la cantidad de productos por categoría
    $productos_por_categoria = $categorias_con_producto->pluck('productos_count');

    // Obtener los proveedores con el número de productos asociados
    $proveedores_con_producto = Proveedor::withCount('productos')->get();
    
    // Obtener los nombres de los proveedores
    $proveedores_nombres = $proveedores_con_producto->pluck('nombre');
    
    // Obtener la cantidad de productos por proveedor
    $productos_por_proveedor = $proveedores_con_producto->pluck('productos_count');

    // Pasar los datos a la vista
    return view('productos.estadisticas', compact('categorias_nombres', 'productos_por_categoria', 'proveedores_nombres', 'productos_por_proveedor'));
}




    public function create()
    {
        $proveedores = Proveedor::all(); 

        return view('productos.create', compact('proveedores'));
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id); // Busca el producto por ID
        return view('productos.show', compact('producto')); // Pasa el producto a la vista
    }


    public function buscar(Request $request)
{
    $search = $request->input('search');
    $productos = Producto::where('nombre', 'LIKE', "%{$search}%")->get();

    return view('admin.productos.index', ['productos' => $productos]);
}

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'required|integer',
            'proveedor_id' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        $productoData = $request->except('foto');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $productoData['foto'] = $filename; 
        } else {
            $productoData['foto'] = null; 
        }

        Producto::create($productoData);

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function destroy($id)
{
    $producto = Producto::findOrFail($id);

    if ($producto->foto) {
        unlink(public_path('img/' . $producto->foto)); 
    }

    $producto->delete();

    $productos = Producto::orderBy('id')->get();

    foreach ($productos as $index => $producto) {
        $producto->id = $index + 1; 
        $producto->save(); 
    }

    return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado exitosamente.');
}


public function edit($id)
{
    $producto = Producto::findOrFail($id);
    $proveedores = Proveedor::all(); 
    return view('productos.edit', compact('producto', 'proveedores')); 
}

public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'categoria_id' => 'required|integer',
        'proveedor_id' => 'required|integer',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
    ]);

    $producto = Producto::findOrFail($id);
    $productoData = $request->except('foto'); 

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('img'), $filename);
        $productoData['foto'] = $filename; 
    }

    $producto->update($productoData);

    return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado exitosamente.');
}


}
