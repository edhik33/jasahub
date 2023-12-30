@extends('layouts.frontend')

@section('content')

<div class="site-wrap">


    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-12 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4">
                                <h2 class="text-black h5">Shop All</h2>
                            </div>
                            <div class="d-flex">
                                <div class="dropdown mr-1 ml-md-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">

                        @foreach ($products as $product)
                        <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                            <div class="block-4 text-center border">
                                <figure class="block-4-image">
                                    <a href="{{ route('detail-product.show', $product->slug) }}"><img
                                            src="{{ $product->image}}" alt="Image placeholder" class="img-fluid"></a>
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="{{ route('detail-product.show', $product->slug) }} $product->title }}</a></h3>
                                    <p class=" text-primary font-weight-bold">${{ $product->price }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach


                    </div>
                    {{-- <div class="row" data-aos="fade-up">
                        <div class="col-md-12 text-center">
                            <div class="site-block-27">
                                <ul>
                                    <li><a href="#">&lt;</a></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&gt;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>


            </div>
        </div>
    </div>


    @endsection
