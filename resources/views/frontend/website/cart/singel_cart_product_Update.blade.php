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
			<a class="text-center" href="{{ route('show.cart') }}">Cart</a>
		</div>
        <div class="w-100 text-center">
            <span>{{ session('status') }}</span>
        </div>
		<div class="row m-0">
			<div class="col-lg-4 left-side-product-box pb-3">
				<img src="{{ asset('storage/product/'.$cart_product->options->image)}}" class="border p-3">
			</div>
			<div class="col-lg-8">
				<div class="right-side-pro-detail border p-3 m-0">
					<div class="row">
						<div class="col-lg-12">
							<span>{{ $cart_product->name }}</span>
							<p class="m-0 p-0">{{ $cart_product->price }}Tk</p>
						</div>
                        @if($cart_product->options->buyone_getone)
                            <div class="col-lg-12">
                                <b class="m-0 p-0">Buyone Getone Product</b>
                            </div>
                            <form action="{{ route('update.getone.cartitem') }}" method="post">
                                @csrf
                                @method('PUT')
                                @if($product_size == [""])
                                @else
                                <input type="hidden" name="productid" value="{{ $cart_product->rowId }}">
                                <input type="hidden" name="product_id" value="{{ $cart_product->id }}">
                                <div class="col-lg-12 select">
                                    <select class="form-control w-100" aria-label="Default select example" name="product_size">
                                        @foreach($product_size as $size)
                                            <option value="{{ $size }}" @if($cart_product->options->size === $size) selected @endif>{{ $size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                @if($product_color == [""])
                                @else
                                <div class="col-lg-12 select">
                                    <select class="form-control w-100" aria-label="Default select example" name="product_color">
                                        @foreach($product_color as $color)
                                            <option value="{{ $color }}" @if($cart_product->options->color === $color) selected @endif>{{ $color }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                <div class="col-lg-12">
                                    <h6>Quantity :</h6>
                                    <input type="number" class="form-control w-100" min="1" max="10" value="{{ $cart_product->qty }}" name="qty">
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="row">
                                        <div class="col-lg-6 pb-2 w-100">
                                            <button type="submit" class="btn btn-danger">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('update.cartitem') }}" method="post">
                                @csrf
                                @method('PUT')
                                @if($product_size == [""])
                                @else
                                <input type="hidden" name="productid" value="{{ $cart_product->rowId }}">
                                <input type="hidden" name="product_id" value="{{ $cart_product->id }}">
                                <div class="col-lg-12 select">
                                    <select class="form-control w-100" aria-label="Default select example" name="product_size">
                                        @foreach($product_size as $size)
                                            <option value="{{ $size }}" @if($cart_product->options->size === $size) selected @endif>{{ $size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                @if($product_color == [""])
                                @else
                                <div class="col-lg-12 select">
                                    <select class="form-control w-100" aria-label="Default select example" name="product_color">
                                        @foreach($product_color as $color)
                                            <option value="{{ $color }}" @if($cart_product->options->color === $color) selected @endif>{{ $color }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                <div class="col-lg-12">
                                    <h6>Quantity :</h6>
                                    <input type="number" class="form-control w-100" min="1" max="10" value="{{ $cart_product->qty }}" name="qty">
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="row">
                                        <div class="col-lg-6 pb-2 w-100">
                                            <button type="submit" class="btn btn-danger">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>