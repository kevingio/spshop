<header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header">
        <div class="wrap_header">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('app-asset/images/icons/logo.png') }}" alt="IMG-LOGO">
            </a>

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li @if(request()->is('/')) class="sale-noti" @endif>
                            <a href="{{ route('home') }}">Home</a>
                        </li>

                        <li @if(request()->is('product') || request()->is('product/*')) class="sale-noti" @endif>
                            <a href="{{ route('product.index') }}">Products</a>
                        </li>

                        <li @if(request()->is('bargain-list')) class="sale-noti" @endif>
                            <a href="{{ route('bargain-list.index') }}">Bargain List</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">
                @if(auth()->check())
                <a href="#" class="dis-block">
                    <div>
                        <a href="#" class="mr-3 js-show-header-dropdown">{{ auth()->user()->name }}</a>
                        <img src="{{ asset('app-asset/images/icons/icon-header-01.png') }}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <div class="header-cart header-dropdown text-right" style="right: 25%; width: auto; min-width: 200px;">
                            <p class="my-2">
                                <a href="{{ url('/profile') }}">My Profile <i class="fas fa-user ml-2"></i></a>
                            </p>
                            <p class="my-2">
                                <a href="{{ route('transaction.index') }}">My Transactions <i class="fas fa-shopping-bag ml-2"></i></a>
                            </p>
                            <p class="my-2">
                                <a href="{{ route('mystore') }}">My Store <i class="fas fa-store ml-2"></i></a>
                            </p>
                            <p class="my-2">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout <i class="fas fa-power-off ml-2"></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </p>
                        </div>
                    </div>
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-danger">
                    Login
                </a>
                @endif

                <span class="linedivide1"></span>

                <div class="header-wrapicon2">
                    <img src="{{ asset('app-asset/images/icons/icon-header-02.png') }}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{ empty($cart['data']) ? 0 : sizeof($cart['data']) }}</span>

                    @if(!empty($cart['data']))
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            @foreach($cart['data'] as $item)
                            <li class="header-cart-item" data-id="{{ $item->id }}" name-product="{{ $item->name }}">
                                <div class="header-cart-item-img">
                                    <img src="{{ sizeof($item->image) > 0 ? Storage::url($item->image[0]->filename)  : 'https://www.91-img.com/pictures/119660-v10-samsung-galaxy-note-9-mobile-phone-large-1.jpg' }}" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        {{ $item->name }}
                                    </a>

                                    <span class="header-cart-item-info">
                                        {{ $item->qty }} x {{ "Rp. " . number_format($item->price,2,',','.') }}
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <div class="header-cart-total">
                            Total: {{ "Rp. " . number_format($cart['total'],2,',','.') }}
                        </div>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{ url('/cart') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Check Out
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="{{ route('home') }}" class="logo-mobile">
            <img src="{{ asset('app-asset/images/icons/logo.png') }}" alt="IMG-LOGO">
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">

                <div class="header-wrapicon2">
                    <img src="{{ asset('app-asset/images/icons/icon-header-02.png') }}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">{{ empty($cart['data']) ? 0 : sizeof($cart['data']) }}</span>

                    @if(!empty($cart['data']))
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            @foreach($cart['data'] as $item)
                            <li class="header-cart-item" data-id="{{ $item->id }}" name-product="{{ $item->name }}">
                                <div class="header-cart-item-img">
                                    <img src="{{ sizeof($item->image) > 0 ? Storage::url($item->image[0]->filename)  : 'https://www.91-img.com/pictures/119660-v10-samsung-galaxy-note-9-mobile-phone-large-1.jpg' }}" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        {{ $item->name }}
                                    </a>

                                    <span class="header-cart-item-info">
                                        {{ $item->qty }} x {{ "Rp. " . number_format($item->price,2,',','.') }}
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <div class="header-cart-total">
                            Total: {{ "Rp. " . number_format($cart['total'],2,',','.') }}
                        </div>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="{{ url('/cart') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Check Out
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
        <nav class="side-menu">
            <ul class="main-menu">

                <li @if(request()->is('/')) class="item-menu-mobile" @endif>
                    <a href="{{ route('home') }}" @if(!request()->is('/')) class="text-danger" @endif>Home</a>
                </li>

                <li @if(request()->is('product') || request()->is('product/*')) class="item-menu-mobile" @endif>
                    <a href="{{ route('product.index') }}" @if(!request()->is('product') && !request()->is('product/*')) class="text-danger" @endif>Products</a>
                </li>

                <li @if(request()->is('bargain-list')) class="item-menu-mobile" @endif>
                    <a href="{{ route('bargain-list.index') }}" @if(!request()->is('bargain-list')) class="text-danger" @endif>Bargain List</a>
                </li>
            </ul>
        </nav>
    </div>
</header>
