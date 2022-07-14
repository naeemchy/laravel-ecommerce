<header class="header shop">
    @php
        $setting = DB::table('site_settings')->first();
        $total=Cart::content()->count();
        $cart=Cart::content()->take(3);
    @endphp
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i>{{ $setting->phone_one }}</li>
                            <li><i class="ti-email"></i>{{ $setting->email_one }}</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-7 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            <li><i class="ti-location-pin"></i>{{ $setting->city }}</li>
                            <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>
                            @guest
                                <li><i class="ti-power-off"></i><a href="{{ route('login') }}">Login</a></li>
                            @else
                                <li><i class="ti-user"></i> <a href="{{ route('user.profile') }}">{{ Auth::user()->name }}</a></li>
                                @if(Auth::user()->role->id == 1)
                                <li><i class="ti-user"></i> <a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                                @endif
                                <li><i class="ti-power-off"></i><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Sign Out
                                </a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <div class="">
                        @if($setting->logo == 'default.png')
                            <div class="logo">
                                <a href="{{ route('user.dashboard') }}"><img src="{{ asset('frontend/images/logo2.png') }}" alt="#"></a>
                            </div>
                        @else
                        <div class="logo">
                            <a href="{{ route('user.dashboard') }}"><img src="{{ asset('storage/logo/'.$setting->logo)}}" alt="Profile Image" style="width: 110px; height:40px"></a> 
                        </div>
                        @endif
                    </div>
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Search here..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <select>
                                <option selected="selected">All Category</option>
                                <option>watch</option>
                                <option>mobile</option>
                                <option>kid’s item</option>
                            </select>
                            <form>
                                <input name="search" placeholder="Search Products Here....." type="search">
                                <button class="btnn"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        <div class="sinlge-bar">
                            <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="sinlge-bar shopping">
                            <a href="#" class="single-icon"><i class="ti-bag"></i> <span
                                    class="total-count">{{ $total }}</span></a>
                            <!-- Shopping Item -->
                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>{{ $total }} Items</span>
                                    <a href="{{ route('show.cart') }}">View Cart</a>
                                </div>
                                <ul class="shopping-list">
                                    @foreach($cart as $row)
                                        <li>
                                            <span class="cart-img" href="#"><img src="{{ asset('storage/product/'.$row->options->image)}}"
                                                    alt="#"></span>
                                            <h4><a href="{{ route('product.view', $row->id) }}">{{ $row->name }}</a></h4>
                                            <p class="quantity"><span class="amount">{{ $row->price }}Tk</span></p>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span>Total</span>
                                        @if(Session::has('coupon'))
                                            <span class="total-amount">{{ Session::get('coupon')['balance'] }}.00Tk</span>
                                        @else
                                            <span class="total-amount">{{ Cart::Subtotal() }}Tk</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--/ End Shopping Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

