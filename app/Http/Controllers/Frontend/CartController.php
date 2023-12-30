<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:customer');
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $userId = Auth::id();

        $cart = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cart) {
            return redirect()->back()->with('error', 'Produk sudah ada di keranjang');
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
                'subtotal' => $product->price,
            ]);

            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
        }
    }


    public function showCart()
    {
        if (Auth::check() && Auth::user()->role == 'customer') {
            $userId = Auth::id();
            $cartItems = Cart::where('user_id', $userId)->get();

            return view('cart', compact('cartItems'));
        } else {
            return redirect('/')->with('error', 'Anda harus login sebagai customer untuk mengakses halaman ini.');
        }
    }

    public function updateQuantity(Request $request, $itemId)
    {
        $cart = Cart::findOrFail($itemId);
        $cart->quantity = max(1, $request->quantity);
        $cart->subtotal = $cart->quantity * $cart->product->price;
        $cart->save();

        return redirect()->back()->with('success', 'Jumlah item berhasil diperbarui.');
    }


    public function removeItem($itemId)
    {
        Cart::where('id', $itemId)->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
