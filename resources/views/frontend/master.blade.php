<!DOCTYPE html>
<html class="no-js" lang="zxx">

<!-- Mirrored from htmldemo.net/ruby/ruby/index6.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Dec 2024 23:52:41 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">

    <title>LorLahtate - store</title>

    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="{{ asset('ruby/ruby/assets/img/favicon.ico')}}" type="image/x-icon"/>

    <!--== Google Fonts ==-->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Droid+Serif:400,400i,700,700i"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:400,700"/>
    <link rel="stylesheet" type="text/css"  href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i"/>

    <!--=== Bootstrap CSS ===-->
    <link href="{{ asset('ruby/ruby/assets/css/vendor/bootstrap.min.css')}}" rel="stylesheet">
    <!--=== Font-Awesome CSS ===-->
    <link href="{{ asset('ruby/ruby/assets/css/vendor/font-awesome.css')}}" rel="stylesheet">
    <!--=== Plugins CSS ===-->
    <link href="{{ asset('ruby/ruby/assets/css/plugins.css')}}" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="{{ asset('ruby/ruby/assets/css/style.css')}}" rel="stylesheet">

    <!-- Modernizer JS -->
    <script src="{{ asset('ruby/ruby/assets/js/vendor/modernizr-2.8.3.min.js')}}')}}"></script>


    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
</head>
<body>

<!--== Header Area Start ==-->
<header id="header-area" class="header__3">
    <div class="ruby-container">
        <div class="row">
            <!-- Logo Area Start -->
            <div class="col-3 col-lg-1 col-xl-2 m-auto">
                <a href="index.html" class="logo-area">
                    <img src="{{ asset('ruby/ruby/assets/img/lola logo.jpg')}}" alt="Logo" class="img-fluid" width="50px" height="50px" style="border-radius: 20px"/>
                </a>
            </div>
            <!-- Logo Area End -->

            <!-- Navigation Area Start -->
            <div class="col-3 col-lg-9 col-xl-8 m-auto">
                <div class="main-menu-wrap">
                    <nav id="mainmenu">
                        <ul>
                            <li >
                                <a href="{{route('home')}}">Home</a>
                            </li>
                            <li >
                                <a href="{{route('shop')}}">Shop</a>
                            </li>
                            <li >
                                <a href="{{route('cart.index')}}">My Cart</a>
                            </li>
                            <li >
                                <a href="{{route('wishlist.index')}}">Wishlists</a>
                            </li>
                            <li>
                                <a href="{{route('user.dashboard')}}">My Account</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Navigation Area End -->

           <!-- Header Right Meta Start -->
            <div class="col-6 col-lg-2 m-auto">
                <div class="header-right-meta text-end">
                    <ul>
                        <li><a href="#" class="modal-active"><i class="fa fa-search"></i></a></li>
                        <li class="settings"><a href="#"><i class="fa fa-cog"></i></a>
                            <div class="site-settings d-block d-sm-flex">
                                <dl class="my-account">
                                    <dt>My Account</dt>
                                    @auth
                                        <dd><a href="{{ route('user.dashboard') }}">Dashboard</a></dd>
                                        {{-- <dd><a href="{{ route('profile.edit') }}">Profile</a></dd> --}}
                                        <dd>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                    Logout
                                                </a>
                                            </form>
                                        </dd>
                                    @else
                                        <dd><a href="{{ route('login') }}">Login</a></dd>
                                        <dd><a href="{{ route('register') }}">Register</a></dd>
                                    @endauth
                                </dl>
                            </div>
                        </li>
                        <li class="shop-cart">
                            <a href="{{ route('cart.index') }}">
                                <i class="fa fa-shopping-bag"></i>
                                <span class="count">{{ $cartCount ?? 0 }}</span>
                            </a>
                            <div class="mini-cart">
                                <div class="mini-cart-body">
                                    @forelse($cartItems as $item)
                                    <div class="single-cart-item d-flex">
                                        <figure class="product-thumb">
                                            <a href="{{ route('product.show', $item->product->id) }}">
                                                @if($item->product->thumbnail)
                                                <img class="img-fluid"
                                                    src="{{ asset($item->product->thumbnail) }}"
                                                    alt="{{ $item->product->name }}">
                                                @else
                                                <div class="img-placeholder"></div>
                                                @endif
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h2><a href="{{ route('product.show', $item->product->id) }}">
                                                {{ Str::limit($item->product->name, 20) }}
                                            </a></h2>
                                            <div class="cal d-flex align-items-center">
                                                <span class="quantity">{{ $item->quantity }}</span>
                                                <span class="multiplication">X</span>
                                                <span class="price">${{ number_format($item->product->sale_price, 2) }}</span>
                                            </div>
                                        </div>
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-icon">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @empty
                                    <div class="empty-cart-message p-3">
                                        <p>Your cart is empty</p>
                                    </div>
                                    @endforelse
                                </div>
                                @if($cartItems && $cartItems->isNotEmpty())
                                <div class="mini-cart-footer">
                                    <div class="cart-total mb-3">
                                        <strong>Total: ${{ number_format($cartTotal, 2) }}</strong>
                                    </div>
                                    <a href="{{ route('checkout') }}" class="btn-add-to-cart">Checkout</a>
                                </div>
                                @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Header Right Meta End -->
        </div>
    </div>
</header>
<!--== Header Area End ==-->

<!--== Search Box Area Start ==-->
<div class="body-popup-modal-area">
    <span class="modal-close"><img src="{{ asset('ruby/ruby/assets/img/cancel.png')}}" alt="Close" class="img-fluid"/></span>
    <div class="modal-container d-flex">
        <div class="search-box-area">
            <div class="search-box-form">
                <form action="#" method="post">
                    <input type="search" placeholder="type keyword and hit enter"/>
                    <button class="btn" type="button"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--== Search Box Area End ==-->

@yield('content')



<!-- Footer Area Start -->
<footer id="footer-area">
    <!-- Footer Call to Action Start -->
    <div class="footer-callto-action">
        <div class="ruby-container">
            <div class="callto-action-wrapper">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <!-- Single Call-to Action Start -->
                        <!-- <div class="single-callto-action d-flex">
                            <figure class="callto-thumb">
                                <img src="{{ asset('ruby/ruby/assets/img/air-plane.png')}}" alt="WorldWide Shipping"/>
                            </figure>
                            <div class="callto-info">
                                <h2>Free Shipping Worldwide</h2>
                                <p>On order over $150 - 7 days a week</p>
                            </div>
                        </div> -->
                        <!-- Single Call-to Action End -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <!-- Single Call-to Action Start -->
                        <div class="single-callto-action d-flex">
                            <figure class="callto-thumb">
                                <img src="{{ asset('ruby/ruby/assets/img/support.png')}}" alt="Support"/>
                            </figure>
                            <div class="callto-info">
                                <h2>24/7 CUSTOMER SERVICE</h2>
                                <p>Call us 24/7 at 000 - 123 - 456k</p>
                            </div>
                        </div>
                        <!-- Single Call-to Action End -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <!-- Single Call-to Action Start -->
                        <div class="single-callto-action d-flex">
                            <figure class="callto-thumb">
                                <img src="{{ asset('ruby/ruby/assets/img/money-back.png')}}" alt="Money Back"/>
                            </figure>
                            <div class="callto-info">
                                <h2>MONEY BACK Guarantee!</h2>
                                <p>Send within 30 days</p>
                            </div>
                        </div>
                        <!-- Single Call-to Action End -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <!-- Single Call-to Action Start -->
                        <!-- <div class="single-callto-action d-flex">
                            <figure class="callto-thumb">
                                <img src="{{ asset('ruby/ruby/assets/img/cog.png')}}" alt="Guide"/>
                            </figure>
                            <div class="callto-info">
                                <h2>SHOPPING GUIDE</h2>
                                <p>Quis Eum Iure Reprehenderit</p>
                            </div>
                        </div> -->
                        <!-- Single Call-to Action End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Call to Action End -->

    <!-- Footer Follow Up Area Start -->
    <div class="footer-followup-area">
        <div class="ruby-container">
            <div class="followup-wrapper">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="follow-content-wrap">
                            <a href="index.html" class="logo">
                            <img src="{{ asset('ruby/ruby/assets/img/lola logo.jpg')}}" alt="Logo" class="img-fluid" width="50px" height="50px" style="border-radius: 20px"/>
                            </a>
                            <p>Products you can trust...</p>

                            <div class="footer-social-icons">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-flickr"></i></a>
                            </div>

                            <!-- <a href="#"><img src="{{ asset('ruby/ruby/assets/img/payment.png')}}" alt="Payment Method"/></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Follow Up Area End -->

    <!-- Footer Image Gallery Area Start -->
    <!-- <div class="footer-image-gallery">
        <div class="ruby-container">
            <div class="image-gallery-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="imgage-gallery-carousel owl-carousel">
                            <div class="gallery-item">
                                <a href="#"><img src="{{ asset('ruby/ruby/assets/img/gallery-img-1.jpg')}}" alt="Gallery"/></a>
                            </div>
                            <div class="gallery-item">
                                <a href="#"><img src="{{ asset('ruby/ruby/assets/img/gallery-img-2.jpg')}}" alt="Gallery"/></a>
                            </div>
                            <div class="gallery-item">
                                <a href="#"><img src="{{ asset('ruby/ruby/assets/img/gallery-img-3.jpg')}}" alt="Gallery"/></a>
                            </div>
                            <div class="gallery-item">
                                <a href="#"><img src="{{ asset('ruby/ruby/assets/img/gallery-img-4.jpg')}}" alt="Gallery"/></a>
                            </div>
                            <div class="gallery-item">
                                <a href="#"><img src="{{ asset('ruby/ruby/assets/img/gallery-img-3.jpg')}}" alt="Gallery"/></a>
                            </div>
                            <div class="gallery-item">
                                <a href="#"><img src="{{ asset('ruby/ruby/assets/img/gallery-img-2.jpg')}}" alt="Gallery"/></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Footer Image Gallery Area End -->

    <!-- Copyright Area Start -->
    <div class="copyright-area">
        <div class="ruby-container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="copyright-text">
                        <p>© LolaTeTe, 2021. Developed By  by <a href="http://qudroidsystems.com/" target="_blank">Qudroid Systems</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright Area End -->

</footer>
<!-- Footer Area End -->

<!-- Start All Modal Content -->
<!--== Product Quick View Modal Area Wrap ==-->
<div class="modal fade" id="quickView" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('ruby/ruby/assets/img/cancel.png')}}" alt="Close" class="img-fluid"/></span>
            </button>
            <div class="modal-body">
                <div class="quick-view-content single-product-page-content">
                    <div class="row">
                        <!-- Product Thumbnail Start -->
                        <div class="col-lg-5 col-md-6">
                            <div class="product-thumbnail-wrap">
                                <div class="product-thumb-carousel owl-carousel">
                                    <div class="single-thumb-item">
                                        <a href="single-product.html"><img class="img-fluid"
                                                                           src="{{ asset('ruby/ruby/assets/img/single-pro-thumb.jpg')}}"
                                                                           alt="Product"/></a>
                                    </div>

                                    <div class="single-thumb-item">
                                        <a href="single-product.html"><img class="img-fluid"
                                                                           src="{{ asset('ruby/ruby/assets/img/single-pro-thumb-2.jpg')}}"
                                                                           alt="Product"/></a>
                                    </div>

                                    <div class="single-thumb-item">
                                        <a href="single-product.html"><img class="img-fluid"
                                                                           src="{{ asset('ruby/ruby/assets/img/single-pro-thumb-3.jpg')}}"
                                                                           alt="Product"/></a>
                                    </div>

                                    <div class="single-thumb-item">
                                        <a href="single-product.html"><img class="img-fluid"
                                                                           src="{{ asset('ruby/ruby/assets/img/single-pro-thumb-4.jpg')}}"
                                                                           alt="Product"/></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Thumbnail End -->

                        <!-- Product Details Start -->
                        <div class="col-lg-7 col-md-6 mt-5 mt-md-0">
                            <div class="product-details">
                                <h2><a href="single-product.html">Crown Summit Backpack</a></h2>

                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-half"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>

                                <span class="price">$52.00</span>

                                <div class="product-info-stock-sku">
                                    <span class="product-stock-status">In Stock</span>
                                    <span class="product-sku-status ms-5"><strong>SKU</strong> MH03</span>
                                </div>

                                <p class="products-desc">Ideal for cold-weathered training worked lorem ipsum outdoors,
                                    the Chaz Hoodie promises superior warmth with every wear. Thick material blocks out
                                    the wind as ribbed cuffs and bottom band seal in body heat Lorem ipsum dolor sit
                                    amet, consectetur adipisicing elit. Enim, reprehenderit.</p>
                                <div class="shopping-option-item">
                                    <h4>Color</h4>
                                    <ul class="color-option-select d-flex">
                                        <li class="color-item black">
                                            <div class="color-hvr">
                                                <span class="color-fill"></span>
                                                <span class="color-name">Black</span>
                                            </div>
                                        </li>

                                        <li class="color-item green">
                                            <div class="color-hvr">
                                                <span class="color-fill"></span>
                                                <span class="color-name">green</span>
                                            </div>
                                        </li>

                                        <li class="color-item orange">
                                            <div class="color-hvr">
                                                <span class="color-fill"></span>
                                                <span class="color-name">Orange</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-quantity d-flex align-items-center">
                                    <div class="quantity-field">
                                        <label for="qty">Qty</label>
                                        <input type="number" id="qty" min="1" max="100" value="1"/>
                                    </div>

                                    <a href="cart.html" class="btn btn-add-to-cart">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                        <!-- Product Details End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--== Product Quick View Modal Area End ==-->
<!-- End All Modal Content -->

<!-- Scroll to Top Start -->
<a href="#" class="scrolltotop"><i class="fa fa-angle-up"></i></a>
<!-- Scroll to Top End -->


<!--=======================Javascript============================-->
<!--=== Jquery Min Js ===-->
<script src="{{ asset('ruby/ruby/assets/js/vendor/jquery.min.js')}}"></script>
<!--=== Jquery Migrate Min Js ===-->
<script src="{{ asset('ruby/ruby/assets/js/vendor/jquery-migrate.min.js')}}"></script>
<!--=== Bootstrap Min Js ===-->
<script src="{{ asset('ruby/ruby/assets/js/vendor/bootstrap.min.js')}}"></script>
<!--=== Plugins Min Js ===-->
<script src="{{ asset('ruby/ruby/assets/js/plugins.js')}}"></script>

<!--=== Active Js ===-->
<script src="{{ asset('ruby/ruby/assets/js/active.js')}}"></script>
</body>

</html>
