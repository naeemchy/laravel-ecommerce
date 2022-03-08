@extends('frontend.app')

@section('title')
    Cart
@endsection

@push('css')
    <style>
        .remove-coupon{
            margin-left: 20px;
            background-color: black;
            padding: 5px;
            border-radius: 10px;
            color: white !important; 
        }
    </style>
@endpush

@section('content')
@php  
	$cart_total=Cart::Subtotal();
    $total = (float) str_replace(',', '', $cart_total);
    if(Session::has('coupon')){
        $cart_coupon_total = Session::get('coupon')['balance'];
    }
@endphp
<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>IMAGE</th>
								<th>PRODUCT</th>
								<th class="text-center">PRICE</th>
								<th class="text-center">Update QUANTITY</th>
                                <th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th> 
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody>
                            @foreach($cart as $row)
                                <tr>
                                    <td class="image" data-title="No"><img src="{{ asset('storage/product/'.$row->options->image)}}" alt="#"></td>
                                    <td class="product-des" data-title="Description">
                                        <p class="product-name"><a href="{{ route('cart.product.update', $row->rowId) }}">{{ $row->name }}</a></p>
                                        @if($row->options->color)
                                            <p class="product-des"><b>Color : </b>{{ $row->options->color }}</p>
                                        @endif
                                        @if($row->options->size)
                                            <p class="product-des"><b>Size : </b>{{ $row->options->size }}</p>
                                        @endif
                                    </td>
                                    @if($row->options->buyone_getone == 'buyone-getone')
                                        <td class="price" data-title="Price"><span>{{ $row->price }}Tk</span></td>
                                    @else
                                        <td class="price" data-title="Price"><span>{{ $row->price }}Tk</span></td>
                                    @endif
                                    <td class="qty" data-title="Qty"><!-- Input Order -->
                                        <div class="input-group">
                                            <div class="button minus">
                                                <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[3]">
                                                    <i class="ti-minus"></i>
                                                </button>
                                            </div>
                                            @if($row->options->buyone_getone == 'buyone-getone')
                                                <form method="post" action="{{ route('update.getone.cartitem') }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="product_id" value="{{ $row->id }}">
                                                    <input type="hidden" name="productid" value="{{ $row->rowId }}">
                                                    <input type="hidden" name="product_color" value="{{ $row->options->color }}">
                                                    <input type="hidden" name="product_size" value="{{ $row->options->size }}">
                                                    <input type="number" name="qty" value="{{ $row->qty }}" style="width: 60px;" min="1" max="10">
                                                    <button type="submit" title="Update" class="action"><i class="fa fa-check-square"></i></button>
                                                </form>
                                            @else
                                                <form method="post" action="{{ route('update.cartitem') }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="product_id" value="{{ $row->id }}">
                                                    <input type="hidden" name="productid" value="{{ $row->rowId }}">
                                                    <input type="number" name="qty" value="{{ $row->qty }}" style="width: 60px;" min="1" max="10">
                                                    <button type="submit" title="Update" class="action"><i class="fa fa-check-square"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                        <!--/ End Input Order -->
                                    </td>
                                    @if($row->options->buyone_getone)
                                        <td class="product-des"><p class="badge">{{ $row->options->new_qty }}</p></td>
                                    @else
                                        <td class="product-des"><p class="badge">{{ $row->qty }}</p></td>
                                    @endif

                                    @if($row->options->buyone_getone)
                                        <td class="total-amount" data-title="Total"><span>{{ $row->price * $row->qty }}Tk</span></td>
                                    @else
                                        <td class="total-amount" data-title="Total"><span>{{ $row->price * $row->qty }}Tk</span></td>
                                    @endif
                                    <td data-title="Remove">
                                        <span class="action" onclick="deleteCartProduct({{ $row->id }})">
                                            <i class="ti-trash remove-icon"></i>
                                        </span>
                                        <form id="delete-form-{{ $row->id }}" action="{{ route('cart.product.delete',$row->rowId) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                             @endforeach
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-7 col-md-5 col-12">
								<div class="left">
									@if(Session::has('coupon'))
					      	        @else
                                        <div class="coupon">
                                            <b>Apply Coupon</b>
                                            <form action="{{ route('apply.coupon') }}" method="post">
                                                @csrf
                                                <input type="text" name="coupon" placeholder="Enter Your Coupon" required value="{{ old('coupon', '') }}">
                                                <button type="submit" class="btn">Apply</button>
                                            </form>
                                        </div>
                                    @endif
								</div>
							</div>
							<div class="col-lg-5 col-md-7 col-12">
								<div class="right">
									<ul>
                                        @if(Session::has('coupon'))
                                            {{-- <li>Cart Subtotal<span>{{ Session::get('coupon')['balance'] }}Tk</span></li> --}}
                                            <li>Cart Subtotal<span>{{ Cart::Subtotal() }}Tk</span></li>
                                            <li>Coupon : ({{   Session::get('coupon')['name'] }}) <a class="remove-coupon" href="{{ route('coupon.remove') }}" title="Remove Coupon">x</a> <span> - {{ Session::get('coupon')['discount'] }}Tk </span> </li>
                                        @else
                                            <li>Cart Subtotal<span>{{ Cart::Subtotal() }}Tk</span></li>
                                        @endif
										<li>Shipping Charge:<span>Free</span></li>
										<li>Vat<span>0</span></li>
                                        @if(Session::has('coupon'))
                                            <li class="last">Total<span>{{ $cart_coupon_total }}.00Tk</span></li>
                                        @else
                                            <li class="last">Total<span>{{ $cart_total }}Tk</span></li>
                                        @endif
									</ul>
									<div class="button5">
										<a href="{{ route('checkout') }}" class="btn">Checkout</a>
                                        @if(Session::has('coupon'))
					      	            @else
										    <a href="{{ route('all.product.list') }}" class="btn">Continue shopping</a>
                                        @endif
                                        <a href="{{ route('allcancel.cart.item') }}" class="btn" onclick="return confirm('Are you sure?')">All Cancel</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->
@endsection

@push('js')
<script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
<script type="text/javascript">
    function deleteCartProduct(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }
</script>
@endpush
