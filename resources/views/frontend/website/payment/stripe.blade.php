@extends('frontend.app')

@section('title')
Stripe
@endsection

@push('css')
<style>
    .section {
        padding-top: 20px;
    }

    /**
	 * The CSS shown here will not be introduced in the Quickstart guide, but shows
	 * how you can use CSS to style your Element's container.
	 */
    .StripeElement {
        box-sizing: border-box;

        height: 40px;
        width: 100%;

        padding: 10px 12px;

        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;

        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
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
<!-- Start Contact -->
<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="contact-head">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="form-main">
                        <div class="row">
                            <h3 style="margin-bottom: 20px;">Stripe Payment</h3>
                            <p>Stripe is an Irish-American financial services and software as a service company
                                dual-headquartered in San Francisco, California and Dublin, Ireland. The company
                                primarily offers payment processing software and application programming interfaces for
                                e-commerce websites and mobile applications.</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="single-head">
                        <div class="title">
                            <form action="{{ route('stripe.charge') }}" method="post" id="payment-form">
                                @csrf
                                <div class="form-row">
                                    <label for="card-element">
                                        Credit or debit card
                                    </label>
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
                                </div><br>
                                <input type="hidden" name="shipping" value="0">
                                <input type="hidden" name="vat" value="0">
                                @if(Session::has('coupon'))
                                    <input type="hidden" name="total" value="{{ $cart_coupon_total }}">
                                @else
                                    <input type="hidden" name="total" value="{{ $total }}">
                                @endif
                                <input type="hidden" name="ship_name" value="{{ $data['name'] }}">
                                <input type="hidden" name="ship_email" value="{{ $data['email'] }}">
                                <input type="hidden" name="ship_phone" value="{{ $data['phone'] }}">
                                <input type="hidden" name="ship_address" value="{{ $data['address'] }}">
                                <input type="hidden" name="ship_city" value="{{ $data['city'] }}">
                                <input type="hidden" name="payment_type" value="{{ $data['payment'] }}">
                                <button class="btn btn-info">Pay Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    // Create a Stripe client.
    var stripe = Stripe(
        'pk_test_51IHVeaDZm7bWvNTTFgSB1jWBkiYGLrpdUgvILoSGiIiYK5iRY3A7CntAj9dRMsUgluUDBw2eSQdGpzUzPzg1Xtcc002ID4i3x8'
        );

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }

</script>
@endpush
