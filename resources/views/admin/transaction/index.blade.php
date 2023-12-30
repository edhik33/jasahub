@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transaction</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book-open"></i> Transaction</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                    <th scope="col">NAMA CUSTOMER</th>
                                    <th scope="col" style="text-align: center">BUKTI TRANSFER</th>
                                    <th scope="col" style="text-align: center">PRODUCT</th>
                                    <th scope="col">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $no => $checkout)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no +
                                        ($transactions->currentPage()-1) *
                                        $transactions->perPage() }}</th>

                                    <td>{{ $checkout->user->name }}</td>
                                    <td class="text-center"><img src="{{ $checkout->image }}" style="width: 300px"></td>
                                    <td class="text-center">{{ $checkout->product->title }}</td>
                                    <td>{{ "Rp " . number_format($checkout->total_harga, 0, ',', '.') }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


@stop
