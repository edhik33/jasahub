<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        // Tampilkan form login jika request adalah GET
        return view('auth/login');
    }

    public function landingPage()
    {

        $products = Product::all();
        return view('landingPage', compact('products'));
    }

    public function shop()
    {
        return view('components.shop');
    }
    public function view()
    {
        return view('viewproduct');
    }

    public function view2()
    {
        return view('viewproduct');
    }
    public function view3()
    {
        return view('viewproduct');
    }
    public function view4()
    {
        return view('viewproduct');
    }
    public function cart()
    {
        return view('cart');
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function order()
    {
        return view('order');
    }
}
