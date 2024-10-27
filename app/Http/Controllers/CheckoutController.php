<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Asumiendo que tienes el carrito disponible en la sesión
        $cart = session('cart'); // o como estés manejando el carrito
        if (!$cart || empty($cart['items'])) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        // Crear la orden
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $cart['total'], // Asumiendo que tienes el total en la sesión
        ]);

        // Crear los items de la orden
        foreach ($cart['items'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Limpiar el carrito (opcional)
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Pedido realizado con éxito.');
    }
}
