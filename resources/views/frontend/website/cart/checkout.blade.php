@extends('frontend.app')

@section('title')
Checkout
@endsection

@push('css')
<style>
    .section {
        padding-top: 20px;
    }
</style>
@endpush

@section('content')
@php
$cart_total=Cart::Subtotal();
$total = (float) str_replace(',', '', $cart_total);
@endphp
<!-- Start Contact -->
	<section id="contact-us" class="contact-us section">
		<div class="container">
				<div class="contact-head">
                    <form class="form" action="{{ route('user.payment.process') }}" id="contact_form" method="post">
                    @csrf
					<div class="row">
						<div class="col-lg-8 col-12">
							<div class="form-main">
								<div class="title">
									<h3>Shipping Address</h3>
								</div>
								
									<div class="row">
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Your Name<span>*</span></label>
												<input name="name" type="text" placeholder="" required>
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Phone<span>*</span></label>
												<input name="phone" type="text" placeholder="" required>
											</div>
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Your Email<span>*</span></label>
												<input name="email" type="email" placeholder="" required>
											</div>	
										</div>
										<div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Your Address<span>*</span></label>
												<input name="address" type="text" placeholder="" required>
											</div>	
										</div>
                                        <div class="col-lg-6 col-12">
											<div class="form-group">
												<label>Your City<span>*</span></label>
												<input name="city" type="text" placeholder="" required>
											</div>	
										</div>
									</div>
								
							</div>
						</div>
						<div class="col-lg-4 col-12">
							<div class="single-head">
								<div class="">
									<ul>
                                        @if(Session::has('coupon'))
                                            {{-- <li>Cart Subtotal<span>{{ Session::get('coupon')['balance'] }}Tk</span></li> --}}
                                            <li><b>Cart Subtotal : </b><span>{{ Cart::Subtotal() }}Tk</span></li>
                                            <li><b>Coupon : </b>({{   Session::get('coupon')['name'] }})<span> - {{ Session::get('coupon')['discount'] }}Tk </span> </li>
                                        @else
                                            <li><b>Cart Subtotal : </b><span>{{ Cart::Subtotal() }}Tk</span></li>
                                        @endif
										<li><b>Shipping Charge : </b><span>Free</span></li>
										<li><b>Vat : </b> <span>0</span></li>
                                        @if(Session::has('coupon'))
                                            <li class="last"><b>Total : </b><span>{{ Session::get('coupon')['balance'] }}.00Tk</span></li>
                                        @else
                                            <li class="last"><b>Total : </b><span>{{ $cart_total }}Tk</span></li>
                                        @endif
									</ul>
                                    <br>
                                    <div class="col-12">
                                        <input type="radio" name="payment" value="stripe"> Stripe <img src="{{ asset('frontend/images/logos_1.png') }}">
                                    </div>
                                    <div class="col-12">
                                        <input type="radio" name="payment" value="paypal"> Paypal <img src="{{ asset('frontend/images/logos_3.png') }}">
                                    </div>
                                    <div class="col-12">
                                        <input type="radio" name="payment" value="visa"> Visa <img src="{{ asset('frontend/images/logos_2.png') }}">
                                    </div>
                                    <br>
									<div class="col-12">
                                        <div class="form-group button">
                                            <button type="submit" class="btn ">Pay Now</button>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
                    </form>
				</div>
			</div>
	</section>
@endsection

@push('js')

@endpush
