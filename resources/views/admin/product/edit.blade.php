@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Product</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book-open"></i> Edit Product</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('product.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>GAMBAR</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        </div>

                        <div class="form-group">
                            <label>NAMA PRODUCT</label>
                            <input type="text" name="title" value="{{ old('title', $product->title) }}"
                                placeholder="Masukkan Nama Product"
                                class="form-control @error('title') is-invalid @enderror">


                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>PRICE</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                placeholder="Masukan harga produk" value="{{ old('price', $product->price ?? '') }}">
                            @error('price')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>DESCRIPTION</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                placeholder="Masukkan Description Product"
                                rows="10">{!! old('description', $product->description) !!}</textarea>
                            @error('description')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


@stop
