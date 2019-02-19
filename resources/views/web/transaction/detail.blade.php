@extends('layouts.master')

@section('page-title')
Transaction {{ date('l, d F Y', strtotime($transaction->created_at)) }} - {{ date('H:i', strtotime($transaction->created_at)) }}
@endsection

@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(https://images.unsplash.com/photo-1528399783831-8318d62d10e5?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=f787f39564b0b83c0caa721b9baf4f33&auto=format&fit=crop&w=967&q=80);">
    <h2 class="l-text2 t-center">
        Detail Transaction
    </h2>
</section>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
                <h5 class="mb-2">Transaction {{ date('l, d F Y', strtotime($transaction->created_at)) }} - {{ date('H:i', strtotime($transaction->created_at)) }}</h5>
                <h5 class="mb-2">
                    <strong>Store</strong>: {{ $transaction->store->name }}
                </h5>
                <h5 class="mb-4">
                    <strong>Status</strong>:
                    @if($transaction->isPaid == 1)
                    <span class="badge badge-success">success</span>
                    @else
                    <span class="badge badge-warning">pending</span>
                    @endif
                </h5>

                <table class="table">
                    <thead class="thead-dark bg-dark text-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->detail as $item)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $item->smartphone->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ "Rp. " . number_format($item->price,2,',','.') }},-</td>
                            <td>{{ "Rp. " . number_format($item->price * $item->qty,2,',','.') }},-</td>
                        </tr>
                        @endforeach
                        <tr class="bg-secondary text-light">
                            <th scope="row" colspan="4" class="text-center align-middle">Total</th>
                            <td>{{ "Rp. " . number_format($item->price,2,',','.') }},-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
