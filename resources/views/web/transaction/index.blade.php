@extends('layouts.master')

@section('page-title')
My Transaction
@endsection

@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(https://images.unsplash.com/photo-1528399783831-8318d62d10e5?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=f787f39564b0b83c0caa721b9baf4f33&auto=format&fit=crop&w=967&q=80);">
    <h2 class="l-text2 t-center">
        My Transaction
    </h2>
</section>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <!-- Cart item -->
        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
                <table class="table-shopping-cart">
                    <tr class="table-head">
                        <th class="column-3 text-center">#</th>
                        <th class="column-4">Store</th>
                        <th class="column-4">Total</th>
                        <th class="column-5">Date</th>
                        <th class="column-5">Time</th>
                        <th class="column-5"></th>
                    </tr>
                    @if(count($transactions) > 0)
                    @foreach($transactions as $transaction)
                    <tr class="table-row">
                        <td class="column-3 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="column-3">{{ $transaction->store->name }}</td>
                        <td class="column-4">{{ "Rp. " . number_format($transaction->total,2,',','.') }},-</td>
                        <td class="column-4">{{ date('l, d F Y',strtotime($transaction->created_at)) }}</td>
                        <td class="column-5">{{ date('H:i',strtotime($transaction->created_at)) }}</td>
                        <td class="column-5">
                            @if($transaction->isPaid == 0)
                            <a href="{{ route('verify.show', [$transaction->id]) }}" class="btn btn-danger">
                                Verify Payment
                            </a>
                            <br>
                            @endif
                            <a href="{{ route('transaction.show', [$transaction->id]) }}" class="btn btn-primary mt-2">
                                <i class="fas fa-info-circle"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center bg-light">No records</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
