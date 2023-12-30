<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->when(request()->q, function ($products) {
            $products = $products->where('title', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'title'         => 'required|unique:products',
            'description'       => 'required',
            'price' => 'required|numeric|between:0,999999.99',

        ]);

        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        $product = Product::create([
            'image'       => $image->hashName(),
            'title'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title'), '-'),
            'description'     => $request->input('description'),
            'price'     => $request->input('price')
        ]);


        if ($product) {
            //redirect dengan pesan sukses
            return redirect()->route('product.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('product.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'title'         => 'nullable',
            'description'       => 'required',
            'price' => 'required|numeric|between:0,999999.99',
        ]);

        if ($request->file('image') == "") {

            $product = Product::findOrFail($product->id);
            $product->update([
                'title'       => $request->input('title'),
                'slug'        => Str::slug($request->input('title'), '-'),
                'description' => $request->input('description'),
                'price'     => $request->input('price')
            ]);
        } else {

            Storage::disk('local')->delete('public/posts/' . $product->image);

            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            $product = Product::findOrFail($product->id);
            $product->update([
                'image'       => $image->hashName(),
                'title'       => $request->input('title'),
                'slug'        => Str::slug($request->input('title'), '-'),
                'description' => $request->input('description'),
                'price'     => $request->input('price')
            ]);
        }


        if ($product) {
            //redirect dengan pesan sukses
            return redirect()->route('product.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('product.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        if ($product) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
