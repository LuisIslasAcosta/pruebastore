<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items')->where('user_id', Auth::id())->first();
        return view('cart.index', ['cart' => $cart]);
    }

    public function add(Request $request, $productId)
    {
        $product = Producto::findOrFail($productId);
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            if ($cartItem->quantity < $product->stock) {
                $cartItem->increment('quantity');
                $product->decrement('stock');
                return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito.');
            } else {
                return redirect()->route('cart.index')->with('error', 'No hay suficiente stock disponible para este producto.');
            }
        } else {
            if ($product->stock > 0) {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'quantity' => 1,
                    'price' => $product->precio,
                ]);
                $product->decrement('stock');
                return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito.');
            } else {
                return redirect()->route('cart.index')->with('error', 'No hay suficiente stock disponible para este producto.');
            }
        }
    }

    public function remove($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $product = Producto::findOrFail($cartItem->product_id);

        $product->increment('stock', $cartItem->quantity);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }
}
