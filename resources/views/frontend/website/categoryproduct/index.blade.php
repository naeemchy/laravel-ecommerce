@extends('frontend.app')

@section('title')
    @if($product)
        {{ $product->category->category_name }}
    @endif
@endsection

@push('css')
    <style>
        
    </style>
@endpush

@section('content')

<!-- Start Product Area -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    @if($product)
                        <h2>{{ $product->category->category_name }}</h2>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">                    
                    <div class="tab-content" id="myTabContent">
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade show active">
                            <div class="tab-single">
                                <div class="row">
                                    @forelse($products as $product)
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
                                                            <a title="Wishlist" class="addwishlist" data-id="{{ $product->id }}"><i class=" ti-heart "></i><span>Add
                                                                    to Wishlist</span></a>
                                                        </div>
                                                        <div class="product-action-2">
                                                            <a title="Add to cart" class="addcart" data-id="{{ $product->id }}">Add to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="{{ route('product.view',$product->id) }}">{{ $product->product_name }}</a></h3>
                                                    <h6>{{ $product->brand->brand_name }}</h6>
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
                                    @empty 
                                        <div class="col-lg-12 col-md-12">
                                            <div class="text-center mb-4">
                                                <strong>No Product Are Available In This Category</strong>
                                            </div><!-- card -->
                                        </div><!-- col-lg-4 col-md-6 -->
                                    @endforelse
                                </div>
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
