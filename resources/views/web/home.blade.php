@extends('layouts.master')

@section('page-title')
    Home
@endsection

@section('content')
<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">
            <div class="item-slick1 item1-slick1" style="background-image: url(https://images.unsplash.com/photo-1526045612212-70caf35c14df?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=4ed5d2ec699dfadb512407b190af79dc&auto=format&fit=crop&w=1050&q=80);">
                <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                    <span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="fadeInDown">
                        Smartphone Collection
                    </span>

                    <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="fadeInUp">
                        New arrivals
                    </h2>

                    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
                        <!-- Button -->
                        <a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                            Shop Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="item-slick1 item2-slick1" style="background-image: url(https://images.unsplash.com/photo-1524466302651-a98b8b02c497?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=906cfe00a2f43a7fe17b2ad86456e731&auto=format&fit=crop&w=1064&q=80);">
                <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                    <span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rollIn">

                    </span>

                    <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="lightSpeedIn">
                        Smartphone Collection
                    </h2>

                    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
                        <!-- Button -->
                        <a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                            Shop Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="item-slick1 item3-slick1" style="background-image: url(https://images.unsplash.com/photo-1517292987719-0369a794ec0f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=79cbb47c2fa1dab8479b31a61567638a&auto=format&fit=crop&w=967&q=80);">
                <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                    <span class="caption1-slide1 m-text1 t-center animated visible-false m-b-15" data-appear="rotateInDownLeft">
                        Smartphone Collection
                    </span>

                    <h2 class="caption2-slide1 xl-text1 t-center animated visible-false m-b-37" data-appear="rotateInUpRight">
                        Trusted over 100 Million customers
                    </h2>

                    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
                        <!-- Button -->
                        <a href="product.html" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                            Shop Now
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Banner -->
<section class="banner bgwhite p-t-40 p-b-40">
    <div class="container">
        <div class="row">
            @foreach($brands->chunk(2) as $chunk)
            <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                <!-- block1 -->
                @foreach($chunk as $brand)
                <div class="block1 hov-img-zoom pos-relative m-b-30">
                    <img src="{{ $brand->logo }}" alt="IMG-BENNER">

                    <div class="block1-wrapbtn w-size2">
                        <!-- Button -->
                        <a href="{{ url('/product') . '?brand=' . str_slug($brand->name) }}" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                            {{ $brand->name }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- New Product -->
<section class="newproduct bgwhite p-t-45 p-b-105">
    <div class="container">
        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center">
                Featured Products
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">

                @foreach($featured_products as $product)
                <div class="item-slick2 p-l-15 p-r-15">
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                            <img src="{{ count($product->image) > 0 ? Storage::url($product->image[0]->filename) : 'https://www.apple.com/newsroom/images/product/iphone/standard/Apple-iPhone-Xs-combo-gold-09122018_big.jpg.large.jpg' }}" alt="IMG-PRODUCT">

                            <div class="block2-overlay trans-0-4">
                                <a href="javascript: void(0)" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                </a>

                                <div class="block2-btn-addcart w-size1 trans-0-4" data-id="{{ $product->id }}" store-id="{{ $product->store_id }}">
                                    <!-- Button -->
                                    <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="{{ route('product.show', [$product->id]) }}" class="block2-name dis-block s-text3 p-b-5">
                                {{ $product->name }}
                            </a>
                            <a href="{{ url('/product?brand=') . $product->brand->name }}" class="block2-name dis-block s-text3 p-b-5">
                                {{ $product->brand->name }}
                            </a>

                            <span class="block2-price m-text6 p-r-5">
                                {{ "Rp. " . number_format($product->price,2,',','.') }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>
</section>

<!-- Shipping -->
<section class="shipping bgwhite p-t-62 p-b-46">
    <div class="sec-title p-b-52 p-l-15 p-r-15">
        <h3 class="m-text5 t-center">
            OUR SERVICE
        </h3>
    </div>
    <div class="flex-w p-l-15 p-r-15">
        <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
            <h4 class="m-text12 t-center">
                Free Delivery Worldwide
            </h4>
        </div>

        <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
            <h4 class="m-text12 t-center">
                30 Days Return
            </h4>

            <span class="s-text11 t-center">
                Simply return it within 30 days for an exchange.
            </span>
        </div>

        <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
            <h4 class="m-text12 t-center">
                Store Opening
            </h4>

            <span class="s-text11 t-center">
                Shop open 24x7 hours
            </span>
        </div>
    </div>
</section>
@endsection
