@extends('layouts.master')

@section('page-title')
Products
@endsection

@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(https://images.unsplash.com/photo-1520089347164-2638db72ff7b?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=cd44eeaf1f084fe01ef4ffd31c702cf3&auto=format&fit=crop&w=1189&q=80);">
    <h2 class="l-text2 t-center">
        SMARTPHONE
    </h2>
    <p class="m-text13 t-center">
        New Arrivals 2018
    </p>
</section>


<!-- Content page -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <div class="search-product pos-relative bo4 of-hidden mb-4">
                        <form action="{{ route('product.index') }}" method="get">
                            <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search" value="{{ !empty(request()->search) ? request()->search : '' }}" placeholder="Search Products...">
                            @foreach(request()->except('search') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}" readonly>
                            @endforeach
                            <button type="submit" class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                                <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>

                    <h4 class="m-text14 p-b-7">
                        Brands
                    </h4>

                    <ul class="p-b-54">
                        <li class="p-t-4">
                            <a href="{{ route('product.index') }}" class="s-text13 @if(empty(request()->brand)) font-weight-bold active1 @endif">
                                All
                            </a>
                        </li>
                        @foreach($brands as $brand)
                        <li class="p-t-4">
                            <a href="{{ url('/product?brand=') . str_slug($brand->name)  }}" class="s-text13 @if(request()->brand == str_slug($brand->name)) font-weight-bold active1 @endif">
                                {{ $brand->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>

                    <!--  -->
                    <!-- <h4 class="m-text14 p-b-32">
                        Filters
                    </h4>

                    <div class="filter-price p-t-22 p-b-50 bo3">
                        <div class="m-text15 p-b-17">
                            Price
                        </div>

                        <div class="wra-filter-bar">
                            <div id="filter-bar"></div>
                        </div>

                        <div class="flex-sb-m flex-w p-t-16">
                            <div class="w-size11">
                                <button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
                                    Filter
                                </button>
                            </div>

                            <div class="s-text3 p-t-10 p-b-10">
                                Range: $<span id="value-lower">610</span> - $<span id="value-upper">980</span>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <!--  -->
                <div class="flex-sb-m flex-w p-b-35">
                    @if($smartphones->count() > 0)
                    <div class="flex-w">
                        <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                            <form action="{{ route('product.index') }}" method="get">
                                @foreach(request()->except('sort') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}" readonly>
                                @endforeach
                                <select class="selection-2" name="sort" onchange="this.form.submit()">
                                    <option value="asc" @if(request()->sort == 'asc') selected @endif>Price: low to high</option>
                                    <option value="desc" @if(request()->sort == 'desc') selected @endif>Price: high to low</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    @endif

                    <span class="s-text8 p-t-5 p-b-5">
                        @if($smartphones->count() > 0)
                            Showing {{ (($smartphones->currentPage() - 1) * $smartphones->perPage()) + 1 }}–{{ (($smartphones->currentPage() - 1) * $smartphones->perPage()) + $smartphones->count() }} of {{ $smartphones->total() }} results
                        @else
                            No results
                        @endif
                    </span>
                </div>

                <!-- Product -->
                <div class="row">
                    @foreach($smartphones as $smartphone)
                    <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                <img src="{{ count($smartphone->image) > 0 ? Storage::url($smartphone->image[0]->filename) : 'https://www.apple.com/newsroom/images/product/iphone/standard/Apple-iPhone-Xs-combo-gold-09122018_big.jpg.large.jpg' }}" alt="IMG-PRODUCT">

                                <div class="block2-overlay trans-0-4">
                                    <a href="javascript: void(0)" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                        <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                        <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                    </a>

                                    <div class="block2-btn-addcart w-size1 trans-0-4" data-id="{{ $smartphone->id }}" store-id="{{ $smartphone->store_id }}">
                                        <!-- Button -->
                                        <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="block2-txt p-t-20">
                                <a href="{{ route('product.show', [$smartphone->id]) }}" class="block2-name dis-block s-text3 p-b-5">
                                    {{ $smartphone->name }}
                                </a>
                                <a href="{{ url('/product?brand=') . $smartphone->brand->name }}" class="block2-name dis-block s-text3 p-b-5">
                                    {{ $smartphone->brand->name }}
                                </a>

                                <span class="block2-price m-text6 p-r-5">
                                    {{ "Rp. " . number_format($smartphone->price,2,',','.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                @if(count($smartphones) > 0)
                <div class="pagination flex-m flex-w p-t-26">
                    @for($i = 1; $i < $smartphones->lastPage() + 1; $i++)
                        @if(request()->page == $i)
                        <a href="{{ $smartphones->url($i) }}" class="item-pagination flex-c-m trans-0-4 active-pagination">{{ $i }}</a>
                        @else
                        <a href="{{ $smartphones->url($i) }}" class="item-pagination flex-c-m trans-0-4 @if(empty(request()->page) && $i == 1) active-pagination @endif">{{ $i }}</a>
                        @endif
                    @endfor
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
