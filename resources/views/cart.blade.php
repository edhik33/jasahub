@extends('layouts.frontend', ['title' => 'Cart'])


@section('content')


<div class="container mt-4">
    <h2>Keranjang Belanja</h2>
    <div class="card">
        <div class="card-body">
            @foreach($cartItems as $item)
            <!-- Cart Item -->
            <div class="row mb-4">
                <div class="col-md-5 col-lg-3 col-xl-3">
                    <div class="view zoom overlay">
                        <img class="img-fluid w-100" src="{{ $item->product->image }}"
                            alt="{{ $item->product->title }}">
                    </div>
                </div>
                <div class="col-md-7 col-lg-9 col-xl-9">
                    <div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5>{{ $item->product->title }}</h5>
                                <p class="mb-3 text-muted text-uppercase small">{{ $item->product->description }}</p>
                            </div>
                            {{-- <div class="d-flex align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-primary update-quantity"
                                    data-item-id="{{ $item->id }}" data-quantity="{{ $item->quantity - 1 }}">
                                    <i class="fa-solid fa-minus"></i>
                                </button>

                                <span class="mx-2 quantity">{{ $item->quantity }}</span>

                                <button type="button" class="btn btn-sm btn-outline-primary update-quantity"
                                    data-item-id="{{ $item->id }}" data-quantity="{{ $item->quantity + 1 }}">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div> --}}

                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div>
                                    <button type="button" class="btn btn-sm btn-danger remove-item"
                                        data-item-id="{{ $item->id }}">
                                        <i class="fa-solid fa-trash"></i> Hapus item
                                    </button>
                                </div>

                            </div>
                            <p class="mb-0"><span><strong>Rp. {{ number_format($item->subtotal, 0, ',', '.')
                                        }}</strong></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Cart Item -->
            @endforeach
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('checkout') }}" class="btn btn-primary">Lanjutkan ke Checkout</a>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    $(document).ready(function () {
        $('.update-quantity').click(function() {
            var itemId = $(this).data('item-id');
            var newQuantity = $(this).data('quantity');

            $.ajax({
                url: '/cart/' + itemId + '/update',
                type: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    quantity: newQuantity
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $('.remove-item').click(function() {
            var itemId = $(this).data('item-id');

            $.ajax({
                url: '/cart/' + itemId + '/remove',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    });
</script>


@endsection
