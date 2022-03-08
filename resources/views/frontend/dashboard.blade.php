@extends('frontend.app')

@section('title','Home')

@push('css')
    <style>
        .load-more{
            margin-top: 50px; 
        }

        .load-more button{
            padding: 10px;
        }

        button {
            outline: none !important;
        }

        .buyone-getone{
            margin-top: 90px; 
        }
        .content b{
            cursor: pointer;
            color: white;
        }

        .content a{
            text-decoration: none !important;
        }        
    </style>
@endpush

@section('content')
<!-- Slider Area -->
	@include('frontend.partial.header-inner')
<!--/ End Slider Area -->
<!-- Start Small Banner  -->
<section class="small-banner section">
    <div class="container-fluid">
        <div class="row">
            @forelse($mid_slider_products as $product)
                <!-- Single Banner  -->
                @if($product->product_quantity >= 1)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-banner mid-slider">
                        <img src="{{ asset('storage/product/'.$product->image_one)}}" alt="#">
                        <div class="content">
                            <p>{{ $product->category->category_name }}</p>
                            <h3><a href="{{ route('product.view',$product->id) }}" style="text">{{ $product->product_name }}</a></h3>
                            <p>{{ $product->brand->brand_name }}</p>
                             <b title="Add to cart" class="addcart" data-id="{{ $product->id }}">Add to cart</b>
                        </div>
                    </div>
                </div>
                @endif
                <!-- /End Single Banner  -->
            @empty 
            @endforelse
        </div>
    </div>
</section>
<!-- End Small Banner -->

<!-- Start Product Area -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Trending Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item mb-2"><a class="nav-link active" href="#">All</a></li>
                            @forelse($categories as $category)
                                <li class="nav-item mb-2 {{ Request::is('filterbycategory*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.product.filterbycategory',$category->id) }}">{{ $category->category_name }}</a></li>
                            @empty 
                            @endforelse
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    
                    <div class="tab-content" id="myTabContent">
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade show active">
                            <div class="tab-single">
                                <div class="row">
                                    @forelse($products as $product)
                                        @if($product->product_quantity >= 1)
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <a href="product-details.html">
                                                        <img class="default-img" src="{{ asset('storage/product/'.$product->image_one)}}"
                                                            alt="#">
                                                        <img class="hover-img" src="{{ asset('storage/product/'.$product->image_two)}}"
                                                            alt="#">
                                                        @php
                                                            $amount=$product->selling_price - $product->discount_price;
                                                            $discount=$amount/$product->selling_price * 100;

                                                            $today=date('d-m-y');
                                                        @endphp
                                                        @if($product->today == $today)
                                                            <div class="d-flex">
                                                                <span class="new">New</span>
                                                                @if($product->discount_price == NULL)
                                                                    <span></span>
                                                                @else
                                                                    <span class="price-dec" style="margin-right:60px;">{{ intval($discount) }}%</span>
                                                                @endif
                                                            </div>
                                                        @elseif($product->discount_price == NULL)
                                                            <span></span>
                                                        @else
                                                            <span class="price-dec">{{ intval($discount) }}%</span>
                                                        @endif
                                                    </a>
                                                    <div class="button-head">
                                                        <div class="product-action">
                                                            <a title="Quick View" href="{{ route('product.view',$product->id) }}"><i
                                                                    class=" ti-eye"></i><span>Quick Shop</span></a>
                                                            {{-- <a title="Wishlist" href="{{ route('add.to.wishlist',$product->id) }}"><i class=" ti-heart "></i><span>Add
                                                                    to Wishlist</span></a> --}}
                                                            <a class="addwishlist" data-id="{{ $product->id }}" title="Wishlist"><i class=" ti-heart "></i><span>Add
                                                                    to Wishlist</span></a>
                                                        </div>
                                                        <div class="product-action-2">
                                                            <a title="Add to cart" class="addcart" data-id="{{ $product->id }}">Add to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="{{ route('product.view',$product->id) }}">{{ $product->product_name }}</a></h3>
                                                    <div class="product-price">
                                                        @if($product->discount_price && $product->selling_price)
                                                            <span class="old">{{ $product->selling_price }}Tk</span>
                                                            <span>{{ $product->discount_price }}Tk</span>
                                                        @else
                                                            <span>{{ $product->selling_price }}Tk</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @empty 
                                        <div class="col-lg-12 col-md-12">
                                            <div class="text-center mb-4">
                                                <strong>No Product Are Available</strong>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                @if($products_count >= 8)
                                    <div class="col-lg-12 col-md-12 load-more">
                                        <div class="text-center mb-4">
                                            <button><a href="{{ route('all.product.list') }}"> View All Products</a></button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!--/ End Single Tab -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Area -->

<!-- Start Midium Banner  -->
<section class="midium-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Discount Up To 50% For Sales Trend Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse($trend_products as $trend_product)
                <!-- Single Banner  -->
                @php
                    $amount=$trend_product->selling_price - $trend_product->discount_price;
                    $discount=$amount/$trend_product->selling_price * 100;
                @endphp
                @if($discount > 49 && $discount < 100 && $trend_product->product_quantity >= 1)
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="single-banner">
                        <img src="{{ asset('storage/product/'.$trend_product->image_one)}}" alt="#">
                        <div class="content">
                            <p>{{ $trend_product->category->category_name }}</p>
                            <h3>{{ $trend_product->product_name }}<br>
                                @if($trend_product->discount_price == NULL)
                                    <span></span>
                                @else
                                    <span>{{ intval($discount) }}% Discount Runing</span>
                                @endif
                            </h3>
                            <a href="{{ route('product.view',$trend_product->id) }}">Shop Now</a>
                        </div>
                    </div>
                </div>
                @endif
                <!-- /End Single Banner  -->
            @empty 
            @endforelse
        </div>
    </div>
</section>
<!-- End Midium Banner -->

<!-- Start Most Popular -->
<div class="product-area most-popular section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Hot Item</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @forelse($hot_products as $hot_product)
                        <!-- Start Single Product -->
                        @if($hot_product->product_quantity >= 1)
                        <div class="single-product">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{ asset('storage/product/'.$hot_product->image_one)}}" alt="#">
                                    <img class="hover-img" src="{{ asset('storage/product/'.$hot_product->image_two)}}" alt="#">
                                    <span class="out-of-stock">Hot</span>
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                        <a title="Quick View" href="{{ route('product.view',$hot_product->id) }}"><i
                                                class=" ti-eye"></i><span>Quick Shop</span></a>
                                        <a title="Wishlist" class="addwishlist" data-id="{{ $hot_product->id }}"><i class=" ti-heart "></i><span>Add to
                                                Wishlist</span></a>
                                    </div>
                                    <div class="product-action-2">
                                        <a title="Add to cart" class="addcart" data-id="{{ $hot_product->id }}">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{ route('product.view',$hot_product->id) }}">{{ $hot_product->product_name }}</a></h3>
                                <div class="product-price">
                                    @if($hot_product->discount_price && $hot_product->selling_price)
                                        <span class="old">{{ $hot_product->selling_price }}Tk</span>
                                        <span>{{ $hot_product->discount_price }}Tk</span>
                                    @else
                                        <span>{{ $hot_product->selling_price }}Tk</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- End Single Product -->
                    @empty 
                    @endforelse 
                </div>
            </div>
        </div>
    </div>
    <div class="container buyone-getone">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Buyone Getone Collection</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="owl-carousel popular-slider">
                    @forelse($buyone_getone_products as $buyone_getone_product)
                        <!-- Start Single Product -->
                        @if($buyone_getone_product->product_quantity >= 1)
                        <div class="single-product">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{ asset('storage/product/'.$buyone_getone_product->image_one)}}" alt="#">
                                    <img class="hover-img" src="{{ asset('storage/product/'.$buyone_getone_product->image_two)}}" alt="#">
                                    @php
                                        $amount=$buyone_getone_product->selling_price - $buyone_getone_product->discount_price;
                                        $discount=$amount/$buyone_getone_product->selling_price * 100;

                                        $today=date('d-m-y');
                                    @endphp
                                    @if($buyone_getone_product->today == $today)
                                        <div class="d-flex">
                                            <span class="new">New</span>
                                            @if($buyone_getone_product->discount_price == NULL)
                                                <span></span>
                                            @else
                                                <span class="out-of-stock" style="margin-right:60px;">{{ intval($discount) }}%</span>
                                            @endif
                                        </div>
                                    @elseif($buyone_getone_product->discount_price == NULL)
                                        <span></span>
                                    @else
                                        <span class="out-of-stock">{{ intval($discount) }}%</span>
                                    @endif
                                </a>
                                <div class="button-head">
                                    <div class="product-action">
                                        <a title="Quick View" href="{{ route('product_buyone_getone.view',$buyone_getone_product->id) }}"><i
                                                class=" ti-eye"></i><span>Quick Shop</span></a>
                                        <a title="Wishlist" class="addwishlist" data-id="{{ $buyone_getone_product->id }}"><i class=" ti-heart "></i><span>Add to
                                                Wishlist</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{ route('product_buyone_getone.view',$buyone_getone_product->id) }}">{{ $buyone_getone_product->product_name }}</a></h3>
                                <div class="product-price">
                                    @if($buyone_getone_product->discount_price && $buyone_getone_product->selling_price)
                                        <span class="old">{{ $buyone_getone_product->selling_price }}Tk</span>
                                        <span>{{ $buyone_getone_product->discount_price }}Tk</span>
                                    @else
                                        <span>{{ $buyone_getone_product->selling_price }}Tk</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- End Single Product -->
                    @empty 
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Most Popular Area -->

<section class="section free-version-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8 offset-md-2 col-xs-12">
                <div class="section-title mb-60">
                    <span class="text-white wow fadeInDown" data-wow-delay=".2s"
                        style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInDown;">Eshop Free Lite
                        version</span>
                    <h2 class="text-white wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Currently You are
                        using free<br> lite Version of Eshop.</h2>
                    <p class="text-white wow fadeInUp" data-wow-delay=".6s"
                        style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">Please, purchase
                        Pepsi is a carbonated soft drink manufactured by PepsiCo. Originally created and developed in 1893 by Caleb Bradham and introduced as Brad's Drink, it was renamed as Pepsi-Cola in 1898, and then shortened to Pepsi in 1961.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Start Shop Home List  -->
<section class="shop-home-list section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>On sale</h1>
                        </div>
                    </div>
                </div>
                <!-- Start Single List  -->
                <div class="single-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="https://via.placeholder.com/115x140" alt="#">
                                <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h4 class="title"><a href="#">Licity jelly leg flat Sandals</a></h4>
                                <p class="price with-discount">$59</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
                <!-- Start Single List  -->
                <div class="single-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="https://via.placeholder.com/115x140" alt="#">
                                <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                <p class="price with-discount">$44</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
                <!-- Start Single List  -->
                <div class="single-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="https://via.placeholder.com/115x140" alt="#">
                                <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                <p class="price with-discount">$89</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>Best Seller</h1>
                        </div>
                    </div>
                </div>
                <!-- Start Single List  -->
                <div class="single-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="https://via.placeholder.com/115x140" alt="#">
                                <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                <p class="price with-discount">$65</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
                <!-- Start Single List  -->
                <div class="single-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="https://via.placeholder.com/115x140" alt="#">
                                <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                <p class="price with-discount">$33</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
                <!-- Start Single List  -->
                <div class="single-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="https://via.placeholder.com/115x140" alt="#">
                                <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                <p class="price with-discount">$77</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="shop-section-title">
                            <h1>Top viewed</h1>
                        </div>
                    </div>
                </div>
                <!-- Start Single List  -->
                <div class="single-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="https://via.placeholder.com/115x140" alt="#">
                                <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                <p class="price with-discount">$22</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
                <!-- Start Single List  -->
                <div class="single-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="https://via.placeholder.com/115x140" alt="#">
                                <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                <p class="price with-discount">$35</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
                <!-- Start Single List  -->
                <div class="single-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="list-image overlay">
                                <img src="https://via.placeholder.com/115x140" alt="#">
                                <a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 no-padding">
                            <div class="content">
                                <h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
                                <p class="price with-discount">$99</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single List  -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Home List  -->

<!-- Start Shop Blog  -->
<section class="shop-blog section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>From Our Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="https://via.placeholder.com/370x300" alt="#">
                    <div class="content">
                        <p class="date">22 July , 2020. Monday</p>
                        <a href="#" class="title">Sed adipiscing ornare.</a>
                        <a href="#" class="more-btn">Continue Reading</a>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="https://via.placeholder.com/370x300" alt="#">
                    <div class="content">
                        <p class="date">22 July, 2020. Monday</p>
                        <a href="#" class="title">Man’s Fashion Winter Sale</a>
                        <a href="#" class="more-btn">Continue Reading</a>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="https://via.placeholder.com/370x300" alt="#">
                    <div class="content">
                        <p class="date">22 July, 2020. Monday</p>
                        <a href="#" class="title">Women Fashion Festive</a>
                        <a href="#" class="more-btn">Continue Reading</a>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Blog  -->

<!-- Start Shop Services Area -->
<section class="shop-services section home">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-rocket"></i>
                    <h4>Free shiping</h4>
                    <p>Orders over $100</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-reload"></i>
                    <h4>Free Return</h4>
                    <p>Within 30 days returns</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-lock"></i>
                    <h4>Sucure Payment</h4>
                    <p>100% secure payment</p>
                </div>
                <!-- End Single Service -->
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Service -->
                <div class="single-service">
                    <i class="ti-tag"></i>
                    <h4>Best Peice</h4>
                    <p>Guaranteed price</p>
                </div>
                <!-- End Single Service -->
            </div>
        </div>
    </div>
</section>
<!-- End Shop Services Area -->

<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Start Newsletter Inner -->
                    <div class="inner">
                        <h4>Newsletter</h4>
                        <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                        <form action="{{ route('user.newsletter.store') }}" method="POST" class="newsletter-inner">
                            @csrf
                            <input name="email" placeholder="Your email address" type="email" value="{{ old('email', '') }}">
                            <button class="btn">Subscribe</button>
                        </form>
                    </div>
                    <!-- End Newsletter Inner -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Newsletter -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close"
                        aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row no-gutters">
                    <div class="col-lg-6 offset-lg-3 col-12">
                        <h4
                            style="margin-top:100px;font-size:14px; font-weight:500; color:#F7941D; display:block; margin-bottom:5px;">
                            Eshop Free Lite</h4>
                        <h3 style="font-size:30px;color:#333;">Currently You are using free lite Version of Eshop.<h3>
                                <p style="display:block; margin-top:20px; color:#888; font-size:14px; font-weight:400;">
                                    Please, purchase full version of the template to get all pages, features and
                                    commercial license</p>
                                <div class="button" style="margin-top:30px;">
                                    <a href="https://wpthemesgrid.com/downloads/eshop-ecommerce-html5-template/"
                                        target="_blank" class="btn" style="color:#fff;">Buy Now!</a>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->
@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.addwishlist').on('click', function(){  
            var id = $(this).data('id');
            if(id) {
                $.ajax({
                    url: "{{  url('/add/to/wishlist/') }}/"+id,
                    type:"GET",
                    dataType:"json",
                     
                    success:function(res) {
                        if($.isEmptyObject(res.error)) {
                            toastr.success(res.success);
                        } else {
                            toastr.error(res.error);
                        }
                    },
                });
            } else {
                 alert('danger');
            }
            e.preventDefault();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
            $('.addcart').on('click', function(){  
              var id = $(this).data('id');
              if(id) {
                 $.ajax({
                     url: "{{  url('/add/to/cart/') }}/"+id,
                     type:"GET",
                     dataType:"json",
                     success:function(res) {
                        if($.isEmptyObject(res.error)) {
                            toastr.success(res.success);
                        } else {
                            toastr.error(res.error);
                        }
                    },                
                 });
            } else {
                 alert('danger');
            }
              e.preventDefault();
        });
    });
</script>
@endpush
