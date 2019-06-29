@extends('layouts.master')

@section('page-title')
{{ $smartphone->name }}
@endsection

@section('content')
<div class="container">
    <div class="bread-crumb bgwhite flex-w p-r-15 p-t-30 p-l-15-sm">
        <a href="{{ route('product.index') }}" class="s-text16">
            Products
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <a href="{{ url('/product?brand=') . str_slug($smartphone->brand->name) }}" class="s-text16">
            {{ $smartphone->brand->name }}
            <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
        </a>

        <span class="s-text17">
            {{ $smartphone->name }}
        </span>
    </div>
</div>

<!-- Product Detail -->
<div class="container bgwhite p-t-35 p-b-80">
    <div class="flex-w flex-sb">
        <div class="w-size13 p-t-30 respon5">
            <div class="wrap-slick3 flex-sb flex-w">
                <div class="wrap-slick3-dots"></div>

                @if(count($smartphone->image) > 0)
                <div class="slick3">
                    @foreach($smartphone->image as $image)
                    <div class="item-slick3" data-thumb="{{ Storage::url($image->filename) }}">
                        <div class="wrap-pic-w">
                            <img src="{{ Storage::url($image->filename) }}" alt="IMG-PRODUCT">
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="slick3">
                    <div class="item-slick3" data-thumb="https://www.apple.com/newsroom/images/product/iphone/standard/Apple-iPhone-Xs-combo-gold-09122018_big.jpg.large.jpg">
                        <div class="wrap-pic-w">
                            <img src="https://www.apple.com/newsroom/images/product/iphone/standard/Apple-iPhone-Xs-combo-gold-09122018_big.jpg.large.jpg" alt="IMG-PRODUCT">
                        </div>
                    </div>

                    <div class="item-slick3" data-thumb="https://cdn0.vox-cdn.com/hermano/verge/product/image/8847/jbareham_180917_2948_0400_squ.jpg">
                        <div class="wrap-pic-w">
                            <img src="https://cdn0.vox-cdn.com/hermano/verge/product/image/8847/jbareham_180917_2948_0400_squ.jpg" alt="IMG-PRODUCT">
                        </div>
                    </div>

                    <div class="item-slick3" data-thumb="https://timedotcom.files.wordpress.com/2017/09/iphone-x.jpg">
                        <div class="wrap-pic-w">
                            <img src="https://timedotcom.files.wordpress.com/2017/09/iphone-x.jpg" alt="IMG-PRODUCT">
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="w-size14 p-t-30 respon5">
            <h4 class="product-detail-name m-text16 p-b-13">
                {{ $smartphone->name }}
            </h4>

            <div class="p-b-15 p-t-10">
                <span class="s-text8">
                    <a href="{{ url('/product?brand=') . str_slug($smartphone->brand->name) }}">
                        <h3>{{ $smartphone->brand->name }}</h3>
                    </a>
                </span>
            </div>

            <span class="m-text17 text-danger">
                {{ "Rp. " . number_format($smartphone->price,2,',','.') }},-
            </span>

            <div class="p-t-33 p-b-60">
                <!-- <div class="flex-m flex-w">
                    <div class="s-text15 w-size15">
                        Color
                    </div>

                    <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
                        <select class="selection-1" name="color">
                            <option>Choose an option</option>
                            <option>Gray</option>
                            <option>Red</option>
                            <option>Black</option>
                        </select>
                    </div>
                </div> -->
                <form action="{{ route('bargain-list.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="flex-m flex-w p-t-33 p-b-10">
                        <div class="s-text15 w-size15">
                            Bargain
                        </div>

                        <div class="bo4 of-hidden w-size16">
                            <input type="hidden" name="smartphone_id" value="{{ $smartphone->id }}" readonly>
                            <input class="sizefull s-text15 p-l-22 p-r-22 p-t-15 p-b-15" type="text" name="bid" autocomplete="off" placeholder="Enter Price" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="btn-addcart-product-detail trans-0-4 m-t-10 m-b-10" data-name="{{ $smartphone->name }}" data-id="{{ $smartphone->id }}" store-id="{{ $smartphone->store_id }}">
                                <button type="button" class="flex-c-m sizefull bg1 py-3 bo-rad-23 hov1 btn-block s-text1 trans-0-4">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-addcart-product-detail trans-0-4 m-t-10 m-b-10">
                                <button type="submit" class="flex-c-m sizefull py-3 bg1 bo-rad-23 hov1 s-text1 btn-block trans-0-4">
                                    Bargain
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                    Description
                    <!-- <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i> -->
                    <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                </h5>

                <div class="dropdown-content dis-none p-t-15 p-b-23">
                    <p class="s-text8">
                        {{ $smartphone->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->check() && $smartphone->store->user_id != auth()->user()->id)
<!-- Relate Product -->
<section class="relateproduct bgwhite p-t-45 p-b-138">
    <div class="container">
        <div class="sec-title p-b-60">
            <h3 class="m-text5 t-center">
                Related Products
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">

                @foreach($related_products as $product)
                <div class="item-slick2 p-l-15 p-r-15">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                            <img src="{{ count($product->image) > 0 ? Storage::url($product->image[0]->filename) : 'https://www.apple.com/newsroom/images/product/iphone/standard/Apple-iPhone-Xs-combo-gold-09122018_big.jpg.large.jpg' }}" alt="IMG-PRODUCT">

                            <div class="block2-overlay trans-0-4">
                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
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
                                {{ "Rp. " . number_format($smartphone->price,2,',','.') }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>
@endif
@endsection
