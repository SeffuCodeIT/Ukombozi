<!DOCTYPE html>
<html lang="en">


<!-- molla/index-1.html  22 Nov 2019 09:55:06 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ukombozi Shop</title>
    <meta name="keywords" content="bookstore bookshop book library pdf magazine">
    <meta name="description" content="Ukombozi Shop">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset("assets/images/icons/apple-touch-icon.png")}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset("assets/images/icons/favicon-32x32.png")}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset("assets/images/icons/favicon-16x16.png")}}">
    <link rel="manifest" href="{{asset("assets/images/icons/site.html")}}">
    <link rel="mask-icon" href="{{asset("assets/images/icons/safari-pinned-tab.svg")}}" color="#666666">
    <link rel="shortcut icon" href="{{asset("assets/images/icons/favicon.ico")}}">
    <meta name="apple-mobile-web-app-title" content="Ukombozi">
    <meta name="application-name" content="Ukombozi">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{secure_asset("assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css")}}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{secure_asset("assets/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{secure_asset("assets/css/plugins/owl-carousel/owl.carousel.css")}}">
    <link rel="stylesheet" href="{{secure_asset("assets/css/plugins/magnific-popup/magnific-popup.css")}}">
    <link rel="stylesheet" href="{{secure_asset("assets/css/plugins/jquery.countdown.css")}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{secure_asset("assets/css/style.css")}}">
    <link rel="stylesheet" href="{{secure_asset("assets/css/skins/skin-demo-2.css")}}">
    <link rel="stylesheet" href="{{secure_asset("assets/css/demos/demo-2.css")}}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        .header-top{
            background-color: black;
        }
    </style>
</head>

<body>
<div class="page-wrapper">
    <header class="header header-2 header-intro-clearance">
        <div class="header-top" style="background-color: #96ab09">
            <div class="container">
{{--                <div class="header-left" >--}}
{{--                    <h1>Special collection already available.--}}
{{--                </div>--}}
                <div class="h3" style="display: inline; color: white;">
                    <p style="font-size: 15px; display: inline; color: white; font-weight: bold">New reads have just dropped.</p><a href="#" style="font-size: 15px;">&nbsp;Read more ...</a>
                </div>
                <!-- End .header-left -->

                <div class="header-right">

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <!-- Teams Dropdown -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="ms-3 relative">
                                <x-dropdown align="right" width="60">
                                    <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </button>
                                </span>
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Team') }}
                                            </div>

                                            <!-- Team Settings -->
                                            <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                {{ __('Team Settings') }}
                                            </x-dropdown-link>

                                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                <x-dropdown-link href="{{ route('teams.create') }}">
                                                    {{ __('Create New Team') }}
                                                </x-dropdown-link>
                                            @endcan

                                            <!-- Team Switcher -->
                                            @if (Auth::user()->allTeams()->count() > 1)
                                                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Switch Teams') }}
                                                </div>

                                                @foreach (Auth::user()->allTeams() as $team)
                                                    <x-switchable-team :team="$team" />
                                                @endforeach
                                            @endif
                                        </div>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @endif

                        <!-- Settings Dropdown -->
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-3 -me-0.5 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400" style="font-size:10px;">
                                        {{ __('Manage Account') }}
                                    </div>

                                    <x-dropdown-link href="{{ route('profile.show') }}" style="font-size:17px;">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link style="font-size:17px;" href="{{ route('logout') }}"
                                                         @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
{{--                    <ul class="top-menu">--}}
{{--                        <li>--}}
{{--                            <a href="#">Log In</a>--}}
{{--                            <ul>--}}
{{--                                <li>--}}
{{--                                    <div class="header-dropdown">--}}
{{--                                        <a href="#">USD</a>--}}
{{--                                        <div class="header-menu">--}}
{{--                                            <ul>--}}
{{--                                                <li><a href="#">Eur</a></li>--}}
{{--                                                <li><a href="#">Usd</a></li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                        <!-- End .header-menu -->--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <div class="header-dropdown">--}}
{{--                                        <a href="#">English</a>--}}
{{--                                        <div class="header-menu">--}}
{{--                                            <ul>--}}
{{--                                                <li><a href="#">English</a></li>--}}
{{--                                                <li><a href="#">French</a></li>--}}
{{--                                                <li><a href="#">Spanish</a></li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                        <!-- End .header-menu -->--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    @if (Route::has('login'))--}}
{{--                                        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 mr-5">--}}
{{--                                            @auth--}}
{{--                                                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ Auth::user()->name }}</a>--}}

{{--                                            @else--}}
{{--                                                <a href="{{ route('login') }}" class="font-semibold text-white hover:text-black dark:text-gray-400 dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>--}}

{{--                                                @if (Route::has('register'))--}}
{{--                                                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
{{--                                                @endif--}}
{{--                                            @endauth--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                    <a href="{{url("/login")}}" data-toggle="modal">Sign in / Sign up</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                    <!-- End .top-menu -->
                </div>
                <!-- End .header-right -->

            </div>
            <!-- End .container -->
        </div>
        <!-- End .header-top -->

        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>

                    <a href="index.html" class="logo">
                        <img src="{{asset("assets/images/demos/demo-2/Ukombozi-Library-logo-2.png")}}" alt="uk Logo" width="105" height="25">
                    </a>
                </div>
                <!-- End .header-left -->

                <div class="header-center">
                    <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                        <form action="#" method="get">
                            <div class="header-search-wrapper search-wrapper-wide">
                                <label for="q" class="sr-only">Search</label>
                                <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
                                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                            </div>
                            <!-- End .header-search-wrapper -->
                        </form>
                    </div>
                    <!-- End .header-search -->
                </div>

                <div class="header-right">
                    <div class="account">
                        <a href="{{ url('/dashboard') }}" title="My account">
                            <div class="icon">
                                <i class="icon-user"></i>
                            </div>
                            <p>Account</p>
                        </a>
                    </div>
                    <!-- End .compare-dropdown -->

                    <div class="wishlist">
                        <a href="wishlist.html" title="Wishlist">
                            <div class="icon">
                                <i class="icon-heart-o"></i>
                                <span class="wishlist-count badge">3</span>
                            </div>
                            <p>Wishlist</p>
                        </a>
                    </div>
                    <!-- End .compare-dropdown -->

                    <?php
                        $user = \Illuminate\Support\Facades\Auth::user();
                        $cartItems = \App\Models\Cart::where('phone', $user->phone)->with('book')->get();
//                    $cartItems = Cart::where('name', $user->name)->with('book')->get();


                    ?>

                    <div class="dropdown cart-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <div class="icon">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count">{{ $cartItems->count() }}</span>
                            </div>
                            <p>Cart</p>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">

                            <div class="dropdown-cart-products">
                                @foreach ($cartItems as $item)
                                <div class="product">
                                    <div class="product-cart-details">
                                        <h4 class="product-title">
                                            <a href="product.html">{{ $item->title }}</a>
                                        </h4>

                                        <span class="cart-product-info">
                                            <span class="cart-product-qty">{{ $item->quantity }}</span> x Kshs {{ number_format($item->price) }}
                                        </span>
                                    </div>
                                    <!-- End .product-cart-details -->

                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="{{ asset('book-pics/'.$item->book->cover_pic) }}" alt="product" style="height: 50px;">
                                        </a>
                                    </figure>
                                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                </div>
                                <!-- End .product -->

                                @endforeach


                                    <div class="dropdown-cart-total">
                                        Total
                                  <span class="cart-total-price">
                                        Kshs {{ number_format($cartItems->sum(function($item) {
                                            return $item->price * $item->quantity;
                                        })) }}
                                    </span>
                                    </div>
                                    <!-- End .dropdown-cart-total -->
                                    <div class="dropdown-cart-action">
                                        <a href="{{url("/showCart")}}" class="btn btn-primary">View Cart</a>
                                        <a href="checkout.html" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                    </div>

                                </div>
                                <!-- End .product -->
                            </div>


                            <!-- End .cart-product -->



                            <!-- End .dropdown-cart-total -->
                        </div>
                        <!-- End .dropdown-menu -->
                    </div>
                    <!-- End .cart-dropdown -->
                </div>
                <!-- End .header-right -->
            </div>
            <!-- End .container -->
        <!-- End .header-middle -->

        <div class="header-bottom sticky-header" >
            <div class="container">
                <div class="header-left">
                    <div class="dropdown category-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                            Browse Categories
                        </a>

                        <div class="dropdown-menu">
                            <nav class="side-nav">
                                <ul class="menu-vertical sf-arrows">
                                    <li class="item-lead"><a href="#">Daily offers</a></li>
                                    <li class="item-lead"><a href="#">Gift Ideas</a></li>
                                    <li><a href="#">Beds</a></li>
                                    <li><a href="#">Lighting</a></li>
                                    <li><a href="#">Sofas & Sleeper sofas</a></li>
                                    <li><a href="#">Storage</a></li>
                                    <li><a href="#">Armchairs & Chaises</a></li>
                                </ul>
                                <!-- End .menu-vertical -->
                            </nav>
                            <!-- End .side-nav -->
                        </div>
                        <!-- End .dropdown-menu -->
                    </div>
                    <!-- End .category-dropdown -->
                </div>
                <!-- End .header-left -->

                <div class="header-center" style="margin-left: 7%;">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li class="megamenu-container active">
                                <a href="{{url('/')}}" class="">Home</a>

                            </li>
                            <li>
                                <a href="{{url('/shop')}}" class="">Shop</a>

                            </li>
                            <li>
                                <a href="{{url('/about')}}" class="">About Us</a>
                            </li>
                            <li>
                                <a href="blog.html" class="">Blog</a>


                            </li>
                            <li>
                                <a href="{{url('/contact')}}" class="">Contacts & FAQs</a>

                            </li>
                            <li>
                                <a href="{{url("/admin")}}" class="">Admin</a>

                            </li>
                        </ul>
                        <!-- End .menu -->
                    </nav>
                    <!-- End .main-nav -->
                </div>
                <!-- End .header-center -->

                <div class="header-right">
                    <i class="la la-lightbulb-o"></i>
                    <p>Clearance<span class="highlight">&nbsp;Up to 15% Off</span></p>
                </div>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .header-bottom -->
    </header>
    <!-- End .header -->

    @yield("content")



    <footer class="footer footer-2">
        <div class="icon-boxes-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rocket"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Track your Order</h3>
                                <!-- End .icon-box-title -->
                                <p>All orders</p>
                            </div>
                            <!-- End .icon-box-content -->
                        </div>
                        <!-- End .icon-box -->
                    </div>
                    <!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rotate-left"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Money Back guarantee</h3>
                                <!-- End .icon-box-title -->
                                <p>within 30 days</p>
                            </div>
                            <!-- End .icon-box-content -->
                        </div>
                        <!-- End .icon-box -->
                    </div>
                    <!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-info-circle"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Get Offers and Discounts</h3>
                                <!-- End .icon-box-title -->
                                <p>Up to 20%</p>
                            </div>
                            <!-- End .icon-box-content -->
                        </div>
                        <!-- End .icon-box -->
                    </div>
                    <!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-life-ring"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Full-Time Support</h3>
                                <!-- End .icon-box-title -->
                                <p>24/7 amazing customer support services</p>
                            </div>
                            <!-- End .icon-box-content -->
                        </div>
                        <!-- End .icon-box -->
                    </div>
                    <!-- End .col-sm-6 col-lg-3 -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .icon-boxes-container -->

        <div class="footer-newsletter bg-image" style="background-image: url({{asset("assets/images/backgrounds/bg-2.jpg")}})">
            <div class="container">
                <div class="heading text-center">
                    <h3 class="title">Get Updates on The Latest releases</h3>
                    <!-- End .title -->
                    <p class="title-desc">straight <span>in your</span> email</p>
                    <!-- End .title-desc -->
                </div>
                <!-- End .heading -->

                <div class="row">
                    <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                        <form action="#">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Enter your Email Address" aria-label="Email Adress" aria-describedby="newsletter-btn" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="newsletter-btn"><span>Subscribe</span><i class="icon-long-arrow-right"></i></button>
                                </div>
                                <!-- .End .input-group-append -->
                            </div>
                            <!-- .End .input-group -->
                        </form>
                    </div>
                    <!-- End .col-sm-10 offset-sm-1 col-lg-6 offset-lg-3 -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .footer-newsletter bg-image -->

        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="widget widget-about">
                            <img src="assets/images/demos/demo-2/Ukombozi-Library-logo-2.png" class="footer-logo" alt="Footer Logo" width="105" height="25">
                            <p>The Ukombozi Library has an initial collection of almost a thousand titles of progressive material, mostly books but also pamphlets, videos, and photographs. </p>

                            <div class="widget-about-info">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4">
                                        <span class="widget-about-title">Got Question? Call us 24/7</span>
                                        <a href="tel:123456789">0723911371</a>
                                    </div>
                                    <!-- End .col-sm-6 -->
                                    <div class="col-sm-6 col-md-8">
                                        <span class="widget-about-title">Payment Method</span>
                                        <figure class="footer-payments">
                                            <img src="assets/images/payments.png" alt="Payment methods" width="272" height="20">
                                        </figure>
                                        <!-- End .footer-payments -->
                                    </div>
                                    <!-- End .col-sm-6 -->
                                </div>
                                <!-- End .row -->
                            </div>
                            <!-- End .widget-about-info -->
                        </div>
                        <!-- End .widget about-widget -->
                    </div>
                    <!-- End .col-sm-12 col-lg-3 -->

                    <div class="col-sm-4 col-lg-2">
                        <div class="widget">
                            <h4 class="widget-title">Information</h4>
                            <!-- End .widget-title -->

                            <ul class="widget-list">
                                <li><a href="about.html">About Ukombozi Shop</a></li>
                                <li><a href="#">How to shop</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                                <li><a href="login.html">Log in</a></li>
                            </ul>
                            <!-- End .widget-list -->
                        </div>
                        <!-- End .widget -->
                    </div>
                    <!-- End .col-sm-4 col-lg-3 -->

                    <div class="col-sm-4 col-lg-2">
                        <div class="widget">
                            <h4 class="widget-title">Customer Service</h4>
                            <!-- End .widget-title -->

                            <ul class="widget-list">
                                <li><a href="#">Payment Methods</a></li>
                                <li><a href="#">Money-back guarantee!</a></li>
{{--                                <li><a href="#">Returns</a></li>--}}
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Terms and conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                            <!-- End .widget-list -->
                        </div>
                        <!-- End .widget -->
                    </div>
                    <!-- End .col-sm-4 col-lg-3 -->

                    <div class="col-sm-4 col-lg-2">
                        <div class="widget">
                            <h4 class="widget-title">My Account</h4>
                            <!-- End .widget-title -->

                            <ul class="widget-list">
                                <li><a href="#">Sign In</a></li>
                                <li><a href="cart.html">View Cart</a></li>
                                <li><a href="#">My Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                            <!-- End .widget-list -->
                        </div>
                        <!-- End .widget -->
                    </div>
                    <!-- End .col-sm-64 col-lg-3 -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .footer-middle -->

        <div class="footer-bottom">
            <div class="container">
                <p class="footer-copyright">Copyright © 2024 Ukombozi Shop. All Rights Reserved.</p>
                <!-- End .footer-copyright -->
                <ul class="footer-menu">
                    <li><a href="#">Terms Of Use</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
                <!-- End .footer-menu -->

                <div class="social-icons social-icons-color">
                    <span class="social-label">Social Media</span>
                    <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                    <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                    <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                    <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                    <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                </div>
                <!-- End .soial-icons -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .footer-bottom -->
    </footer>
    <!-- End .footer -->
</div>
<!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div>
<!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container mobile-menu-light">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search product ..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li class="active">
                            <a href="index.html">Home</a>


                        </li>
                        <li>
                            <a href="category.html">Shop</a>

                        </li>
                        <li>
                            <a href="product.html" class="">About</a>

                        </li>
                        <li>
                            <a href="#">Blog</a>

                        </li>
                        <li>
                            <a href="blog.html">Contacts</a>


                        </li>

                    </ul>
                </nav>
                <!-- End .mobile-nav -->
            </div>
            <!-- .End .tab-pane -->
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-cats-menu">
                        <li><a class="mobile-cats-lead" href="#">Daily offers</a></li>
                        <li><a class="mobile-cats-lead" href="#">Gift Ideas</a></li>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Lighting</a></li>
                        <li><a href="#">Sofas & Sleeper sofas</a></li>
                        <li><a href="#">Storage</a></li>
                        <li><a href="#">Armchairs & Chaises</a></li>
                        <li><a href="#">Decoration </a></li>
                        <li><a href="#">Kitchen Cabinets</a></li>
                        <li><a href="#">Coffee & Tables</a></li>
                        <li><a href="#">Outdoor Furniture </a></li>
                    </ul>
                    <!-- End .mobile-cats-menu -->
                </nav>
                <!-- End .mobile-cats-nav -->
            </div>
            <!-- .End .tab-pane -->
        </div>
        <!-- End .tab-content -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div>
        <!-- End .social-icons -->
    </div>
    <!-- End .mobile-menu-wrapper -->
</div>
<!-- End .mobile-menu-container -->

<!-- Sign in / Register Modal -->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-5">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="singin-email">Username or email address *</label>
                                        <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                    </div>
                                    <!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="singin-password">Password *</label>
                                        <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                    </div>
                                    <!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>LOG IN</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="signin-remember">
                                            <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                        </div>
                                        <!-- End .custom-checkbox -->

                                        <a href="#" class="forgot-link">Forgot Your Password?</a>
                                    </div>
                                    <!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i> Login With Google
                                            </a>
                                        </div>
                                        <!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-f">
                                                <i class="icon-facebook-f"></i> Login With Facebook
                                            </a>
                                        </div>
                                        <!-- End .col-6 -->
                                    </div>
                                    <!-- End .row -->
                                </div>
                                <!-- End .form-choice -->
                            </div>
                            <!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form action="#">
                                    <div class="form-group">
                                        <label for="register-email">Your email address *</label>
                                        <input type="email" class="form-control" id="register-email" name="register-email" required>
                                    </div>
                                    <!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="register-password">Password *</label>
                                        <input type="password" class="form-control" id="register-password" name="register-password" required>
                                    </div>
                                    <!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>SIGN UP</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                            <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                        </div>
                                        <!-- End .custom-checkbox -->
                                    </div>
                                    <!-- End .form-footer -->
                                </form>
                                <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i> Login With Google
                                            </a>
                                        </div>
                                        <!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login  btn-f">
                                                <i class="icon-facebook-f"></i> Login With Facebook
                                            </a>
                                        </div>
                                        <!-- End .col-6 -->
                                    </div>
                                    <!-- End .row -->
                                </div>
                                <!-- End .form-choice -->
                            </div>
                            <!-- .End .tab-pane -->
                        </div>
                        <!-- End .tab-content -->
                    </div>
                    <!-- End .form-tab -->
                </div>
                <!-- End .form-box -->
            </div>
            <!-- End .modal-body -->
        </div>
        <!-- End .modal-content -->
    </div>
    <!-- End .modal-dialog -->
</div>
<!-- End .modal -->

{{--<div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-10">--}}
{{--            <div class="row no-gutters bg-white newsletter-popup-content">--}}
{{--                <div class="col-xl-3-5col col-lg-7 banner-content-wrap">--}}
{{--                    <div class="banner-content text-center">--}}
{{--                        <img src="assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">--}}
{{--                        <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>--}}
{{--                        <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>--}}
{{--                        <form action="#">--}}
{{--                            <div class="input-group input-group-round">--}}
{{--                                <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <button class="btn" type="submit"><span>go</span></button>--}}
{{--                                </div>--}}
{{--                                <!-- .End .input-group-append -->--}}
{{--                            </div>--}}
{{--                            <!-- .End .input-group -->--}}
{{--                        </form>--}}
{{--                        <div class="custom-control custom-checkbox">--}}
{{--                            <input type="checkbox" class="custom-control-input" id="register-policy-2" required>--}}
{{--                            <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>--}}
{{--                        </div>--}}
{{--                        <!-- End .custom-checkbox -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-2-5col col-lg-5 ">--}}
{{--                    <img src="assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Plugins JS File -->
<script src="{{secure_asset("assets/js/jquery.min.js")}}"></script>
<script src="{{secure_asset("assets/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{secure_asset("assets/js/jquery.hoverIntent.min.js")}}"></script>
<script src="{{secure_asset("assets/js/jquery.waypoints.min.js")}}"></script>
<script src="{{secure_asset("assets/js/superfish.min.js")}}"></script>
<script src="{{secure_asset("assets/js/owl.carousel.min.js")}}"></script>
<script src="{{secure_asset("assets/js/jquery.plugin.min.js")}}"></script>
<script src="{{secure_asset("assets/js/jquery.magnific-popup.min.js")}}"></script>
<script src="{{secure_asset("assets/js/jquery.countdown.min.js")}}"></script>
<!-- Main JS File -->
<script src="{{secure_asset("assets/js/main.js")}}"></script>
<script src="{{secure_asset("assets/js/demos/demo-2.js")}}"></script>
@livewireScripts
</body>


</html>
