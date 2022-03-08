<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            @if(auth()->user()->image == 'default.png')
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxXnHpI68YpU-l9X2o_qPTDDITvEx72nfHpw&usqp=CAU" width="48" height="48" alt="...">
            @else
                <img src="{{ asset('storage/profile/'.auth()->user()->image)}}" width="48" height="48" alt="Profile Image">
            @endif
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{ route('admin.profile') }}"><i class="material-icons">person</i>Profile Setting</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>Sign Out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <span>Admin Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">library_books</i>
                    <span>Categories</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::is('admin/category/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.category.create') }}">Add Category</a>
                    </li>
                    <li class="{{ Request::is('admin/category') ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}">All Category</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/sub-category*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">library_books</i>
                    <span>Sub-Categories</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::is('admin/sub-category/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.sub-category.create') }}">Add Sub-Category</a>
                    </li>
                    <li class="{{ Request::is('admin/sub-category') ? 'active' : '' }}">
                        <a href="{{ route('admin.sub-category.index') }}">All Sub-Category</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/brand*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">library_books</i>
                    <span>Brands</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::is('admin/brand/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.brand.create') }}">Add Brand</a>
                    </li>
                    <li class="{{ Request::is('admin/brand') ? 'active' : '' }}">
                        <a href="{{ route('admin.brand.index') }}">All Brand</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/coupon*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">library_books</i>
                    <span>Coupons</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::is('admin/coupon/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.coupon.create') }}">Add Coupon</a>
                    </li>
                    <li class="{{ Request::is('admin/coupon') ? 'active' : '' }}">
                        <a href="{{ route('admin.coupon.index') }}">All Coupon</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/product*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">library_books</i>
                    <span>Products</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::is('admin/product/create') ? 'active' : '' }}">
                        <a href="{{ route('admin.product.create') }}">Add Product</a>
                    </li>
                    <li class="{{ Request::is('admin/product') ? 'active' : '' }}">
                        <a href="{{ route('admin.product.index') }}">All Product</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/order*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">library_books</i>
                    <span>Orders</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::is('admin/order/pending') ? 'active' : '' }}">
                        <a href="{{ route('admin.order.pending') }}">New Pending Orders</a>
                    </li>
                    <li class="{{ Request::is('admin/order/accept/list') ? 'active' : '' }}">
                        <a href="{{ route('admin.payment.accept') }}">Accept Payment</a>
                    </li>
                    <li class="{{ Request::is('admin/order/progress/list') ? 'active' : '' }}">
                        <a href="{{ route('admin.order.progress') }}">Progress Delevary</a>
                    </li>
                    <li class="{{ Request::is('admin/order/success/list') ? 'active' : '' }}">
                        <a href="{{ route('admin.order.success') }}">Delevary Success</a>
                    </li>
                    <li class="{{ Request::is('admin/order/cancel/list') ? 'active' : '' }}">
                        <a href="{{ route('admin.all.order.cancel') }}">Order Cancel</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/report*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">library_books</i>
                    <span>Reports</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::is('admin/report/today/order') ? 'active' : '' }}">
                        <a href="{{ route('admin.today.order') }}">Today orders</a>
                    </li>
                    <li class="{{ Request::is('admin/report/today/delevered') ? 'active' : '' }}">
                        <a href="{{ route('admin.today.delevered') }}">Today Delevered</a>
                    </li>
                    <li class="{{ Request::is('admin/report/this/month') ? 'active' : '' }}">
                        <a href="{{ route('admin.this.month') }}">This Month</a>
                    </li>
                    <li class="{{ Request::is('admin/report/search') ? 'active' : '' }}">
                        <a href="{{ route('admin.search.report') }}">Search Report</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('admin/stock/product') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">library_books</i>
                    <span>Products Stock</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{ Request::is('admin/stock/product') ? 'active' : '' }}">
                        <a href="{{ route('admin.all.product.stock') }}">All product stock</a>
                    </li>
                </ul>
            </li>
            <li class="header">LABELS</li>
            <li class="{{ Request::is('admin/website/setting') ? 'active' : '' }}">
                <a href="{{ route('admin.website.setting') }}">
                    <i class="material-icons col-red">donut_large</i>
                    <span>Website Settings</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/newslater') ? 'active' : '' }}">
                <a href="{{ route('admin.newslater.index') }}">
                    <i class="material-icons">library_books</i>
                    <span>Newslaters</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2020 - 2021 <a href="javascript:void(0);">Laravel - Ecommerce</a>.
        </div>
        <div class="version">
            <b>Developed By: </b>Md, Naeem Uddin
        </div>
    </div>
    <!-- #Footer -->
</aside>
