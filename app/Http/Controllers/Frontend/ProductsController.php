<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('detail-product', compact('product'));
    }
}
