<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function privada()
    {
        $productos = Producto::all();
        return view('secret', ['productos' => $productos]);
    }

    public function index()
    {
        $productos = Producto::all();
        
        return view('productos.index', ['productos' => $productos]);
    }

    public function create()
    {
        $proveedores = Proveedor::all(); 

        return view('productos.create', compact('proveedores'));
    }

    public function show($id)
{
    $producto = Producto::find($id);
    if (!$producto) {
        return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
    }
    return view('productos.show', compact('producto'));
}


    public function buscar(Request $request)
{
    $search = $request->input('search');
    $productos = Producto::where('nombre', 'LIKE', "%{$search}%")->get();

    return view('productos.index', ['productos' => $productos]);
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

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
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

    return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
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

    return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
}


}
