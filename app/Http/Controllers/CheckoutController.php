<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function remove(Request $request)
    {
        // Verifica si el carrito tiene productos
        $cart = $request->session()->get('cart');

        if ($cart && $cart->items->isNotEmpty()) {
            // Eliminar todos los productos de la tabla 'productos'
            Producto::query()->delete();  // Elimina todos los productos de la base de datos

            // Vaciar el carrito de la sesión
            $request->session()->forget('cart');

            // Redirigir con un mensaje de éxito
            return redirect()->route('productos.privada')->with('success', 'Compra realizada y todos los productos eliminados.');
        }

        return redirect()->route('productos.privada')->with('error', 'No hay productos en el carrito.');
    }

    public function removeAll()
{
    // Eliminar todos los productos del carrito (tabla cart_items)
    CartItem::query()->delete();

    // Si deseas restaurar el stock de los productos eliminados del carrito:
    $cartItems = CartItem::all();  // Obtener todos los productos del carrito

    foreach ($cartItems as $item) {
        $producto = Producto::find($item->product_id);
        if ($producto) {
            // Reponer el stock de los productos eliminados del carrito
            $producto->increment('stock', $item->quantity);
        }
    }

    // Redirigir con mensaje de éxito
    return redirect()->route('productos.privada')->with('success', 'Tus productos te llegaran pronto, gracias por tu compra');
}

}
