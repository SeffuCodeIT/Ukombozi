@extends("layout.index")
@section("content")

<main class="main">
    <div class="intro-slider-container">
        <div class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{"nav": false}'>
            <div class="intro-slide" style="background-image: url(assets/images/demos/demo-2/downloadable.jpeg);">
                <div class="container intro-content">
                    <h3 class="intro-subtitle">Revolutionary Texts</h3>
                    <!-- End .h3 intro-subtitle -->
                    <h1 class="intro-title">Find books <br>That Challenge You.</h1>
                    <!-- End .intro-title -->

                    <a href="category.html" class="btn btn-primary">
                        <span>Shop Now</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div>
                <!-- End .container intro-content -->
            </div>
            <!-- End .intro-slide -->

            <div class="intro-slide" style="background-image: url(assets/images/demos/demo-2/slider/slide-2.jpg);">
                <div class="container intro-content">
                    <h3 class="intro-subtitle">Deals and Promotions</h3>
                    <!-- End .h3 intro-subtitle -->
                    <h1 class="intro-title">Ypperlig <br>Coffee Table <br><span class="text-primary"><sup>$</sup>49,99</span></h1>
                    <!-- End .intro-title -->

                    <a href="category.html" class="btn btn-primary">
                        <span>Shop Now</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div>
                <!-- End .container intro-content -->
            </div>
            <!-- End .intro-slide -->

            <div class="intro-slide" style="background-image: url(assets/images/demos/demo-2/slider/slide-3.jpg);">
                <div class="container intro-content">
                    <h3 class="intro-subtitle">Living Room</h3>
                    <!-- End .h3 intro-subtitle -->
                    <h1 class="intro-title">
                        Make Your Living Room <br>Work For You.<br>
                        <span class="text-primary">
                                    <sup class="text-white font-weight-light">from</sup><sup>$</sup>9,99
                                </span>
                    </h1>
                    <!-- End .intro-title -->

                    <a href="category.html" class="btn btn-primary">
                        <span>Shop Now</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div>
                <!-- End .container intro-content -->
            </div>
            <!-- End .intro-slide -->
        </div>
        <!-- End .owl-carousel owl-simple -->

        <span class="slider-loader text-white"></span>
        <!-- End .slider-loader -->
    </div>
    <!-- End .intro-slider-container -->

    {{--        <div class="brands-border owl-carousel owl-simple" data-toggle="owl" data-owl-options='{--}}
    {{--                    "nav": false,--}}
    {{--                    "dots": false,--}}
    {{--                    "margin": 0,--}}
    {{--                    "loop": false,--}}
    {{--                    "responsive": {--}}
    {{--                        "0": {--}}
    {{--                            "items":2--}}
    {{--                        },--}}
    {{--                        "420": {--}}
    {{--                            "items":3--}}
    {{--                        },--}}
    {{--                        "600": {--}}
    {{--                            "items":4--}}
    {{--                        },--}}
    {{--                        "900": {--}}
    {{--                            "items":5--}}
    {{--                        },--}}
    {{--                        "1024": {--}}
    {{--                            "items":6--}}
    {{--                        },--}}
    {{--                        "1360": {--}}
    {{--                            "items":7--}}
    {{--                        }--}}
    {{--                    }--}}
    {{--                }'>--}}
    {{--            <a href="#" class="brand">--}}
    {{--                <img src="assets/images/brands/1.png" alt="Brand Name">--}}
    {{--            </a>--}}

    {{--            <a href="#" class="brand">--}}
    {{--                <img src="assets/images/brands/2.png" alt="Brand Name">--}}
    {{--            </a>--}}

    {{--            <a href="#" class="brand">--}}
    {{--                <img src="assets/images/brands/3.png" alt="Brand Name">--}}
    {{--            </a>--}}

    {{--            <a href="#" class="brand">--}}
    {{--                <img src="assets/images/brands/4.png" alt="Brand Name">--}}
    {{--            </a>--}}

    {{--            <a href="#" class="brand">--}}
    {{--                <img src="assets/images/brands/5.png" alt="Brand Name">--}}
    {{--            </a>--}}

    {{--            <a href="#" class="brand">--}}
    {{--                <img src="assets/images/brands/6.png" alt="Brand Name">--}}
    {{--            </a>--}}

    {{--            <a href="#" class="brand">--}}
    {{--                <img src="assets/images/brands/7.png" alt="Brand Name">--}}
    {{--            </a>--}}
    {{--        </div>--}}
    <!-- End .owl-carousel -->

    <div class="mb-3 mb-lg-5"></div>
    <!-- End .mb-3 mb-lg-5 -->

    <div class="banner-group">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-5">
                    <div class="banner banner-large banner-overlay banner-overlay-light">
                        <a href="#">
                            <img src="assets/images/socialist.png" alt="Banner" style="height:600px; filter: brightness(80%);">
                        </a>

                        <div class="banner-content banner-content-top">
                            <h4 class="banner-subtitle text-white">Clearence</h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white">Kenyan Magazines</h3>
                            <!-- End .banner-title -->
                            <div class="banner-text text-white">from Kshs 2000.00</div>
                            <!-- End .banner-text -->
                            <a href="#" class="btn btn-outline-gray banner-link text-white">Shop Now<i class="icon-long-arrow-right"></i></a>
                        </div>
                        <!-- End .banner-content -->
                    </div>
                    <!-- End .banner -->
                </div>
                <!-- End .col-lg-5 -->

                <div class="col-md-6 col-lg-3">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="assets/images/Panafricanism.jpg" alt="Banner"  style="filter: brightness(50%);">
                        </a>

                        <div class="banner-content banner-content-bottom">
                            <h4 class="banner-subtitle text-grey">On Sale</h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white">Progressive African <br>Poetry</h3>
                            <!-- End .banner-title -->
                            <div class="banner-text text-white">from Kshs 1,500.00</div>
                            <!-- End .banner-text -->
                            <a href="#" class="btn btn-outline-white banner-link">Discover Now<i class="icon-long-arrow-right"></i></a>
                        </div>
                        <!-- End .banner-content -->
                    </div>
                    <!-- End .banner -->
                </div>
                <!-- End .col-lg-3 -->

                <div class="col-md-6 col-lg-4">
                    <div class="banner banner-overlay">
                        <a href="#">
                            <img src="assets/images/Bookcover.jpg" alt="Banner" style="filter: brightness(70%); height: 300px;">
                        </a>

                        <div class="banner-content banner-content-top">
                            <h4 class="banner-subtitle text-grey">New Arrivals</h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white">Politics <br>& Government</h3>
                            <!-- End .banner-title -->
                            <a href="#" class="btn btn-outline-white banner-link">Discover Now<i class="icon-long-arrow-right"></i></a>
                        </div>
                        <!-- End .banner-content -->
                    </div>
                    <!-- End .banner -->

                    <div class="banner banner-overlay banner-overlay-light">
                        <a href="#">
                            <img src="assets/images/Mutunga.jpg" alt="Banner" style="height: 300px;">
                        </a>

                        <div class="banner-content banner-content-top">
                            <h4 class="banner-subtitle text-white">On Sale</h4>
                            <!-- End .banner-subtitle -->
                            <h3 class="banner-title text-white">Biographies & AutoBiographies</h3>
                            <!-- End .banner-title -->
                            <div class="banner-text text-white">up to 30% off</div>
                            <!-- End .banner-text -->
                            <a href="#" class="btn btn-outline-gray banner-link text-white">Shop Now<i class="icon-long-arrow-right"></i></a>
                        </div>
                        <!-- End .banner-content -->
                    </div>
                    <!-- End .banner -->
                </div>
                <!-- End .col-lg-4 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .banner-group -->



    <div class="bg-light deal-container pt-5 pb-3 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="deal">
                        <div class="deal-content">
                            <h4>Limited Quantities</h4>
                            <h2>Deal of the Day</h2>

                                <h3 class="product-title"><a href="product.html">Two Paths Ahead for Kenya</a></h3>
                            <!-- End .product-title -->

                            <div class="product-price">
                                <span class="new-price">Kshs 2,000.00</span>
                                <span class="old-price">Was Kshs 3,500.00</span>
                            </div>
                            <!-- End .product-price -->

                            <div class="deal-countdown" data-until="+10h"></div>
                            <!-- End .deal-countdown -->

                            <a href="product.html" class="btn btn-primary">
                                <span>Shop Now</span><i class="icon-long-arrow-right"></i>
                            </a>
                        </div>
                        <!-- End .deal-content -->
                        <div class="deal-image">
                            <a href="product.html">
                                <img src="assets/images/1714372816TwoPathsAhead.jpg" alt="image">
                            </a>
                        </div>
                        <!-- End .deal-image -->
                    </div>
                    <!-- End .deal -->
                </div>
                <!-- End .col-lg-9 -->

                <div class="col-lg-3">
                    <div class="banner-content banner-content-top banner-content-center">
                        <h4 class="banner-subtitle">Best of Shiraz Durrani</h4>
                        <!-- End .banner-subtitle -->
                        <h3 class="banner-title">ANTI-IMPERIALISM STRUGGLE</h3>
                        <!-- End .banner-title -->
                        <div class="banner-text text-primary">Kshs 2,000.00</div>
                        <!-- End .banner-text -->
                        <a href="#" class="btn btn-outline-gray banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                    </div>
                    <div class="banner banner-overlay banner-overlay-light text-center d-none d-lg-block">
                        <a href="#">
                            <img src="assets/images/1714380245peoples.jpg" alt="Banner">
                        </a>


                        <!-- End .banner-content -->
                    </div>
                    <!-- End .banner -->
                </div>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .bg-light -->

    <div class="mb-6"></div>
    <!-- End .mb-6 -->

    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title">Top Selling Products</h2>
            <!-- End .title -->

            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                </li>
            </ul>
        </div>
        <!-- End .heading -->

        <div class="tab-content">
            <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                <div class="products">
                    <div class="row justify-content-center">
                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="assets/images/1714383974Liberating.jpg" alt="Product image" class="product-image">
                                        <img src="assets/images/1714383974Liberating.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div>
                                    <!-- End .product-action-vertical -->
                                </figure>
                                <!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">History</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Liberating Minds</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        Kshs 2,000.00
                                    </div>
                                    <!-- End .product-price -->
                                </div>
                                <!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                                <!-- End .product-action -->
                            </div>
                            <!-- End .product -->
                        </div>
                        <!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="assets/images/1714382865ALifeinTheStruggle.jpg" alt="Product image" class="product-image">
                                        <img src="assets/images/1714382865ALifeinTheStruggle.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div>
                                    <!-- End .product-action-vertical -->
                                </figure>
                                <!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Auto-Biography</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Karimi Nduthu</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        Kshs 2,000.00
                                    </div>
                                    <!-- End .product-price -->

{{--                                    <div class="product-nav product-nav-dots">--}}
{{--                                        <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>--}}
{{--                                        <a href="#" style="background: #927764;"><span class="sr-only">Color name</span></a>--}}
{{--                                    </div>--}}
                                    <!-- End .product-nav -->

                                </div>
                                <!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                                <!-- End .product-action -->
                            </div>
                            <!-- End .product -->
                        </div>
                        <!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-circle label-sale">Sale</span>
                                    <a href="product.html">
                                        <img src="assets/images/1714383437Makhan Singh - A Revolutionary Trade Union Bookcover.jpg" alt="Product image" class="product-image">
                                        <img src="assets/images/1714383437Makhan Singh - A Revolutionary Trade Union Bookcover.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div>
                                    <!-- End .product-action-vertical -->
                                </figure>
                                <!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Kenyan Trade Unions</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Makhan Singh</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        <span class="new-price">Kshs 2,000.00</span>
                                        <span class="old-price">Was Kshs 3,500.00</span>
                                    </div>
                                    <!-- End .product-price -->
                                </div>
                                <!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                                <!-- End .product-action -->
                            </div>
                            <!-- End .product -->
                        </div>
                        <!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="assets/images/FrontCover.jpg" alt="Product image" class="product-image">
                                        <img src="assets/images/FrontCover.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div>
                                    <!-- End .product-action-vertical -->
                                </figure>
                                <!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">History of Resistance</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Threads of Time</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        kshs 2,000.00
                                    </div>
                                    <!-- End .product-price -->

                                    <!-- End .product-nav -->

                                </div>
                                <!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                                <!-- End .product-action -->
                            </div>
                            <!-- End .product -->
                        </div>
                        <!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="assets/images/Mutunga.jpg" alt="Product image" class="product-image">
                                        <img src="assets/images/Mutunga.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div>
                                    <!-- End .product-action-vertical -->
                                </figure>
                                <!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Biography</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Willy Mutunga Undercover</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        Kshs 2,000.00
                                    </div>
                                    <!-- End .product-price -->
                                </div>
                                <!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                                <!-- End .product-action -->
                            </div>
                            <!-- End .product -->
                        </div>
                        <!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-circle label-new">New</span>
                                    <a href="product.html">
                                        <img src="assets/images/Panafricanism.jpg" alt="Product image" class="product-image">
                                        <img src="assets/images/Panafricanism.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div>
                                    <!-- End .product-action-vertical -->
                                </figure>
                                <!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Progressive African Poetry</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Essays on PanAfricanism</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        Kshs 3,000.00
                                    </div>
                                    <!-- End .product-price -->
                                </div>
                                <!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                                <!-- End .product-action -->
                            </div>
                            <!-- End .product -->
                        </div>
                        <!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="assets/images/PioGamaPintoBook Cover.jpg" alt="Product image" class="product-image">
                                        <img src="assets/images/PioGamaPintoBook Cover.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div>
                                    <!-- End .product-action-vertical -->
                                </figure>
                                <!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">AutoBiography</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Pio Gama Pinto</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        Kshs 3,500.00
                                    </div>
                                    <!-- End .product-price -->
                                </div>
                                <!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                                <!-- End .product-action -->
                            </div>
                            <!-- End .product -->
                        </div>
                        <!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="assets/images/COVERjpg_Page1.jpg" alt="Product image" class="product-image">
                                        <img src="assets/images/COVERjpg_Page1.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div>
                                    <!-- End .product-action-vertical -->
                                </figure>
                                <!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">History</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Key Points in The History of Kenya</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        Kshs 1,500.00
                                    </div>
                                    <!-- End .product-price -->
                                </div>
                                <!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                                <!-- End .product-action -->
                            </div>
                            <!-- End .product -->
                        </div>
                        <!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="assets/images/AlbinismCover.jpg" alt="Product image" class="product-image">
                                        <img src="assets/images/AlbinismCover.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div>
                                    <!-- End .product-action-vertical -->
                                </figure>
                                <!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Kids</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Andolo - the talented boy with albinism</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        Kshs 1,000.00
                                    </div>
                                    <!-- End .product-price -->
                                </div>
                                <!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                                <!-- End .product-action -->
                            </div>
                            <!-- End .product -->
                        </div>
                        <!-- End .col-sm-6 col-md-4 col-lg-3 -->

                        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="product.html">
                                        <img src="assets/images/Bookcover.jpg" alt="Product image" class="product-image">
                                        <img src="assets/images/Bookcover.jpg" alt="Product image" class="product-image-hover">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                    </div>
                                    <!-- End .product-action-vertical -->
                                </figure>
                                <!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Neo-Colonial Struggle</a>
                                    </div>
                                    <!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.html">Crimes of Capitalism in Kenya</a></h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        Kshs 1,500.00
                                    </div>
                                    <!-- End .product-price -->
                                </div>
                                <!-- End .product-body -->
                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                                <!-- End .product-action -->
                            </div>
                            <!-- End .product -->
                        </div>
                        <!-- End .col-sm-6 col-md-4 col-lg-3 -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .products -->
            </div>
            </div>
        <!-- End .tab-content -->
    </div>
    <!-- End .container -->

    <div class="container">
        <hr class="mt-1 mb-6">
    </div>
    <!-- End .container -->

    <div class="blog-posts">
        <div class="container">
            <h2 class="title text-center">From Our Blog</h2>
            <!-- End .title-lg text-center -->

            <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
                <article class="entry entry-display">
                    <figure class="entry-media">
                        <a href="single.html">
                            <img src="assets/images/demos/demo-2/blog/post-1.jpg" alt="image desc">
                        </a>
                    </figure>
                    <!-- End .entry-media -->

                    <div class="entry-body text-center">
                        <div class="entry-meta">
                            <a href="#">Nov 22, 2018</a>, 0 Comments
                        </div>
                        <!-- End .entry-meta -->

                        <h3 class="entry-title">
                            <a href="single.html">Sed adipiscing ornare.</a>
                        </h3>
                        <!-- End .entry-title -->

                        <div class="entry-content">
                            <a href="single.html" class="read-more">Continue Reading</a>
                        </div>
                        <!-- End .entry-content -->
                    </div>
                    <!-- End .entry-body -->
                </article>
                <!-- End .entry -->

                <article class="entry entry-display">
                    <figure class="entry-media">
                        <a href="single.html">
                            <img src="assets/images/demos/demo-2/blog/post-2.jpg" alt="image desc">
                        </a>
                    </figure>
                    <!-- End .entry-media -->

                    <div class="entry-body text-center">
                        <div class="entry-meta">
                            <a href="#">Dec 12, 2018</a>, 0 Comments
                        </div>
                        <!-- End .entry-meta -->

                        <h3 class="entry-title">
                            <a href="single.html">Fusce lacinia arcuet nulla.</a>
                        </h3>
                        <!-- End .entry-title -->

                        <div class="entry-content">
                            <a href="single.html" class="read-more">Continue Reading</a>
                        </div>
                        <!-- End .entry-content -->
                    </div>
                    <!-- End .entry-body -->
                </article>
                <!-- End .entry -->

                <article class="entry entry-display">
                    <figure class="entry-media">
                        <a href="single.html">
                            <img src="assets/images/demos/demo-2/blog/post-3.jpg" alt="image desc">
                        </a>
                    </figure>
                    <!-- End .entry-media -->

                    <div class="entry-body text-center">
                        <div class="entry-meta">
                            <a href="#">Dec 19, 2018</a>, 2 Comments
                        </div>
                        <!-- End .entry-meta -->

                        <h3 class="entry-title">
                            <a href="single.html">Quisque volutpat mattis eros.</a>
                        </h3>
                        <!-- End .entry-title -->

                        <div class="entry-content">
                            <a href="single.html" class="read-more">Continue Reading</a>
                        </div>
                        <!-- End .entry-content -->
                    </div>
                    <!-- End .entry-body -->
                </article>
                <!-- End .entry -->
            </div>
            <!-- End .owl-carousel -->

            <div class="more-container text-center mt-2">
                <a href="blog.html" class="btn btn-outline-darker btn-more"><span>View more articles</span><i class="icon-long-arrow-right"></i></a>
            </div>
            <!-- End .more-container -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .blog-posts -->
</main>
<!-- End .main -->


@endsection
