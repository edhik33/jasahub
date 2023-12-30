@extends('layouts.frontend', ['title' => 'Checkout'])
@section('content')



<div class="container mt-4">
    <h2>Halaman Checkout</h2>
    <div class="card">
        <div class="card-body">

            <form action="/proses-checkout" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label class="form-label" for="customFile">Bukti Transfer:</label>
                    <input type="file" class="form-control" id="image" name="image" />
                </div>

                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        </div>
    </div>
</div>
@endsection
