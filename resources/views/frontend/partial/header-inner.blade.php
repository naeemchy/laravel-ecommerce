@php
    $categories = App\Models\Category::latest()->get();  
    $subcategories = App\Models\SubCategory::latest()->get();
    $product = App\Models\Product::where('main_slider', 1)->orderBy('updated_at','DESC')->first();   
    $main_slider = App\Models\Product::where('main_slider', 1)->count();  
@endphp

<header class="header shop">
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="all-category">
                            <h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
                            <ul class="main-category">
                                @foreach($categories as $key=>$category)
                                    <li><a href="{{ route('user.product.filterbycategory',$category->id) }}">{{ $category->category_name }}<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="sub-category">
                                            @foreach($subcategories as $key=>$subcategory)
                                                @if($category->id == $subcategory->category_id)
                                                    <li><a href="{{ route('user.product.filterbysubcategory',$subcategory->id) }}">{{ $subcategory->subcategory_name }}</a></li>
                                                @endif    
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-12 d-flex justify-content-end">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li><a href="#">Shop<i class="ti-angle-down"></i><span
                                                        class="new">New</span></a>
                                                <ul class="dropdown">
                                                    <li><a href="cart.html">Cart</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<section class="hero-slider">
    <!-- Single Slider -->
    @if($main_slider > 0)
        <div style="background-image: url({{ asset('storage/product/'.$product->image_one)}});background-repeat: no-repeat;background-position: 100% 0;min-height:500px;">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-9 offset-lg-3 col-12">
                        <div class="text-inner">
                            <div class="row">
                                <div class="col-lg-7 col-12">
                                    <div class="hero-text">
                                        <h4>{{ $product->product_name }}</h4>
                                        <p>{!! \Illuminate\Support\Str::limit($product->product_details,'460') !!}</p>
                                        <p>
                                            @if($product->discount_price && $product->selling_price)
                                                    <del>{{ $product->selling_price }}Tk</del><br>
                                                    {{ $product->discount_price }}Tk 
                                            @else
                                                {{ $product->selling_price }}Tk
                                            @endif
                                        </p>
                                        <div class="button">
                                            <a href="{{ route('product.view',$product->id) }}" class="btn">Shop Now!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif    
    <!--/ End Single Slider -->
</section>
