@extends('layouts.frontend', ['title' => 'Detail product'])

@section('content')

<!-- content -->
<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/products') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
            </ol>
        </nav>
        <div class="row gx-5">
            <aside class="col-lg-6">
                <div class="d-flex justify-content-center mb-3">
                    <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
                        href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp"
                        class="item-thumb">
                        <img src="{{ $product->image }}" alt="Image placeholder" class="img-fluid">
                    </a>

                </div>

            </aside>
            <main class="col-lg-6">

                <div class="ps-lg-3">
                    <h4 class="title text-dark">
                        {{ $product->title }}
                    </h4>
                    <div class="mb-3">

                        <p class="text-primary font-weight-bold h5">Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>

                    </div>

                    <p>
                        Description : <br>
                        {{ $product->description }}
                    </p>

                    <hr />


                    <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning shadow-0">Tambah ke
                        keranjang</a>
                </div>
            </main>
        </div>
    </div>
</section>
<!-- content -->

@endsection
