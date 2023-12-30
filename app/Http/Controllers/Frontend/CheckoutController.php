<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:customer');
    }

    public function index()
    {
        if (Auth::check() && Auth::user()->role == 'customer') {
            $user = Auth::user();
            $cartItems = Cart::where('user_id', $user->id)->get();

            return view('checkout', compact('user', 'cartItems'));
        } else {
            return redirect('/')->with('error', 'Anda harus login sebagai customer untuk mengakses halaman ini.');
        }
    }

    public function prosesCheckout(Request $request)
    {
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        $user = Auth::user();
        $totalHarga = Cart::where('user_id', $user->id)->sum('subtotal');

        $image = $request->file('image');
        $image->storeAs('public/checkouts', $image->hashName());

        $cartItems = Cart::where('user_id', Auth::id())->get();

        foreach ($cartItems as $cartItem) {
            Checkout::create([
                'user_id' => $user->id,
                'product_id' => $cartItem->product_id,
                'image' => $image->hashName(),
                'total_harga' => $totalHarga,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('thankyou');
    }
}
