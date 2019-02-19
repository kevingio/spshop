@extends('layouts.master')

@section('page-title')
My Cart
@endsection

@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(https://images.unsplash.com/photo-1528399783831-8318d62d10e5?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=f787f39564b0b83c0caa721b9baf4f33&auto=format&fit=crop&w=967&q=80);">
    <h2 class="l-text2 t-center">
        Checkout
    </h2>
</section>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">

        <!-- Total -->
        <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
            <h5 class="m-text20 p-b-24">
                Cart Totals
            </h5>

            <!--  -->
            <div class="flex-w flex-sb-m p-b-12">
                <span class="s-text18 w-size19 w-full-sm">
                    Subtotal:
                </span>

                <span class="m-text21 w-size20 w-full-sm">
                    {{ "Rp. " . number_format($cart['total'],2,',','.') }},-
                </span>
            </div>

            <!--  -->
            <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
                <span class="s-text18 w-size19 w-full-sm">
                    Shipping:
                </span>

                <div class="w-size20 w-full-sm">
                    <p class="s-text8 p-b-23">
                        Free shipping around the world
                    </p>
                </div>
            </div>

            <!--  -->
            <div class="flex-w flex-sb-m p-t-26 p-b-30">
                <span class="m-text22 w-size19 w-full-sm">
                    Total:
                </span>

                <span class="m-text21 w-size20 w-full-sm">
                    {{ "Rp. " . number_format($cart['total'],2,',','.') }},-
                </span>
            </div>

            <h5 class="m-text20 p-b-24">
                Choose Payment
            </h5>

            <!--  -->
            <div class="flex-w flex-sb-m p-b-12">
                <span class="s-text18 w-size19 w-full-sm">
                    Subtotal:
                </span>

                <span class="m-text21 w-size20 w-full-sm">
                    <input type="radio" name="">
                    <span>Transfer</span>
                </span>
            </div>

            <!--  -->
            <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
                <span class="s-text18 w-size19 w-full-sm">
                    Shipping:
                </span>

                <div class="w-size20 w-full-sm">
                    <p class="s-text8 p-b-23">
                        Free shipping around the world
                    </p>
                </div>
            </div>

            <!--  -->
            <div class="flex-w flex-sb-m p-t-26 p-b-30">
                <span class="m-text22 w-size19 w-full-sm">
                    Total:
                </span>

                <span class="m-text21 w-size20 w-full-sm">
                    {{ "Rp. " . number_format($cart['total'],2,',','.') }},-
                </span>
            </div>

            <div class="size15 trans-0-4">
                <!-- Button -->
                <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>
</section>
@endsection
