<!DOCTYPE html>
<html>
<head>
	<title> Product Detail Design Using Bootstrap 4.0 </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            font-family: 'Roboto Condensed', sans-serif;
            background-color: #f5f5f5
        }
        .hedding{
            font-size: 20px;
            color:#ab8181`;
        }
        .main-section{
            position: absolute;
            left:50%;
            right:50%;
            transform: translate(-50%,0%);
        }
        .left-side-product-box img{
            width: 100%;
        }
        .left-side-product-box .sub-img img{
            margin-top:5px;
            width:83px;
            height:100px;
        }
        .right-side-pro-detail span{
            font-size:15px;
        }
        .right-side-pro-detail p{
            font-size:15px;
            color:#a1a1a1;
        }
        .right-side-pro-detail .price-pro{
            color:#E45641;
        }
        .right-side-pro-detail .tag-section{
            font-size:18px;
            color:#5D4C46;
        }
        .pro-box-section .pro-box img{
            width: 100%;
            height:200px;
        }
        .select{
            margin-top: 5px;
            margin-bottom: 15px;
        }
        @media (min-width:360px) and (max-width:640px) {
            .pro-box-section .pro-box img{
                height:auto;
            }
        }
    </style>
</head>
<body>
<div class="container">
	<div class="col-lg-8 border pt-1 p-3 main-section bg-white">
		<div class="row hedding m-0 pl-3 pt-0 pb-3">
			<a class="text-center" href="{{ route('user.dashboard') }}">Eshop</a>
		</div>
        <div class="w-100 text-center">
            <span>{{ session('status') }}</span>
        </div>
		<div class="row m-0">
			<div class="col-lg-4 left-side-product-box pb-3">
				<img src="{{ asset('storage/product/'.$product_details->image_one)}}" class="border p-3">
				<span class="sub-img">
					<img src="{{ asset('storage/product/'.$product_details->image_one)}}" class="border p-2">
					<img src="{{ asset('storage/product/'.$product_details->image_two)}}" class="border p-2">
					<img src="{{ asset('storage/product/'.$product_details->image_three)}}" class="border p-2">
				</span>
			</div>
			<div class="col-lg-8">
				<div class="right-side-pro-detail border p-3 m-0">
					<div class="row">
						<div class="col-lg-12">
							<span>{{ $product_details->category->category_name }}</span>
							<p class="m-0 p-0">{{ $product_details->product_name }}, <span>{{ $product_details->brand->brand_name }}</span></p>
						</div>
						<div class="col-lg-12">
							{{-- <p class="m-0 p-0 price-pro">$30</p> --}}
                            <div class="product-price">
                                @if($product_details->discount_price && $product_details->selling_price)
                                    <span class="price-pro"><del>{{ $product_details->selling_price }}Tk</del></span>
                                    <span>{{ $product_details->discount_price }}Tk</span>
                                @else
                                    <span class="price-pro">{{ $product_details->selling_price }}Tk</span>
                                @endif
                            </div>
                            <hr class="p-0 m-0">
                            <h6 style="margin-top: 6px">Available Stock <b>{{ $product_details->product_quantity }}</b>, Please hurrey up before stock over</h6>
							<hr class="p-0 m-0">
						</div>
						<div class="col-lg-12 pt-2">
							<h5>Product Detail</h5>
							<p>{!! $product_details->product_details !!}</p><hr class="m-0 pt-2 mt-2">
						</div>
                        <form action="{{ url('add/to/cart/from/product/details/'.$product_details->id) }}" method="post">
							@csrf
                            @if($product_details->product_size == NULL)
                            @else
                                <div class="col-lg-12 select">
                                    <select class="form-control w-100" aria-label="Default select example" name="product_size">
                                        @foreach($product_size as $size)
                                            <option value="{{ $size }}">{{ $size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if($product_details->product_color == NULL)
                            @else
                                <div class="col-lg-12 select">
                                    <select class="form-control w-100" aria-label="Default select example" name="product_color">
                                        @foreach($product_color as $color)
                                            <option value="{{ $color }}">{{ $color }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="col-lg-12">
                                <h6>Quantity :</h6>
                                <input type="number" class="form-control w-100" min="1" max="10" value="1" name="qty">
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-6 pb-2 w-100">
                                        <button type="submit" class="btn btn-danger">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>