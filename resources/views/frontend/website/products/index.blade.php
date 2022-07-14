@extends('frontend.app')

@section('title')
    Products
@endsection

@push('css')
    <style>
        .products{
            padding: 40px 0px 140px 0px;
        }
    </style>
@endpush

@section('content')

<!-- Start Product Area -->
<div class="product-area products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>All Products List</h2>
                </div>
            </div>
        </div>
        <form action="{{ route('all.product.list') }}">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <select class="form-select" name="cat_id">
                        <option value="0"> --All Category Products-- </option>
                        @forelse($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == request()->get('cat_id') ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @empty 
                        @endforelse
                    </select>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <select class="form-select" name="sub_category_id">
                        <option value="0"> --All SubCategory Products-- </option>
                        @forelse($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ $subcategory->id == request()->get('sub_category_id') ? 'selected' : '' }}>{{ $subcategory->subcategory_name }}</option>
                        @empty 
                        @endforelse
                    </select>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <button type="submit" class="btn btn-primary">Enter</button>
                </div>
            </div>
        </form>
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
                                        @endif
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
<!-- Modal -->
<div class="modal fade " id="cartmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Product Short Description</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row">
          <div class="col-md-4">
              <div class="card" style="width: 16rem;">
              <img src="" class="card-img-top" id="pimage" style="height: 240px;">
              <div class="card-body">
               
              </div>
            </div>
          </div>
          <div class="col-md-4 ml-auto">
              <ul class="list-group">
                <li class="list-group-item"> <h5 class="card-title" id="pname"></h5></span></li>
             <li class="list-group-item">Product code: <span id="pcode"> </span></li>
              <li class="list-group-item">Category:  <span id="pcat"> </span></li>
              <li class="list-group-item">SubCategory:  <span id="psubcat"> </span></li>
              <li class="list-group-item">Brand: <span id="pbrand"> </span></li>
              <li class="list-group-item">Stock: <span class="badge " style="background: green; color:white;">Available</span></li> 
            </ul>
          </div>
          <div class="col-md-4 ">
              <form action="" method="post">
                @csrf
                <input type="hidden" name="product_id" id="product_id">
                <div class="form-group" id="colordiv">
                  <label for="">Color</label>
                  <select name="color" class="form-control">
                  </select>
                </div>
                 <div class="form-group" id="sizediv" >
                  <label for="exampleInputEmail1">Size</label>
                  <select name="product_color" class="form-control" id="size">
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Quantity</label>
                  <input type="number" class="form-control" value="1" name="qty">
                </div>
                <button type="submit" class="btn btn-primary">Add To Cart</button>
              </form>
           </div>
         </div>
      </div>  
    </div>
  </div>
</div>

<!--modal end--> 
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
