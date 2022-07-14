<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Cart;
use DB;
use Illuminate\Http\Request;
use Session;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Payment(Request $request)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['city'] = $request->city;
        $data['payment'] = $request->payment;

        if ($request->payment == 'stripe') {
            //stripe payment pages
            return view('frontend.website.payment.stripe', compact('data'));

        } elseif ($request->payment == 'paypal') {

        } elseif ($request->payment == 'ideal') {

        } else {
            echo "handcash";
        }

    }

    public function stripeCharge(Request $request)
    {
        $total = $request->total;
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51IHVeaDZm7bWvNTTyl2qvoS8gk0Lkq9kL4GALZOtluOutveFiwjBzEc1AaavhfOqyldgDkCe8bLtKcEwjbLtWfOV00TOEJgglf');

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total * 100,
            'currency' => 'usd',
            'description' => 'Eshop ecommerce',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_id'] = $charge->payment_method;
        $data['paying_amount'] = $charge->amount / 100;
        $data['blnc_transection'] = $charge->balance_transaction;
        $data['stripe_order_id'] = $charge->metadata->order_id;
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['payment_type'] = $request->payment_type;
        if (Session::has('coupon')) {
            $data['subtotal'] = Session::get('coupon')['balance'];
        } else {
            $data['subtotal'] = Cart::Subtotal();
        }
        $data['status'] = 0;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $data['status_code'] = mt_rand(100000, 999999);
        $order_id = DB::table('orders')->insertGetId($data);

        // insert shipping details table

        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_city'] = $request->ship_city;
        DB::table('shippings')->insert($shipping);

        //insert data into orderdeatils
        $content = Cart::content();
        $details = array();
        foreach ($content as $row) {
            $details['order_id'] = $order_id;
            $details['product_id'] = $row->id;
            $details['product_name'] = $row->name;
            $details['color'] = $row->options->color;
            $details['size'] = $row->options->size;
            if ($row->options->buyone_getone) {
                $details['quantity'] = $row->options->new_qty;
            } else {
                $details['quantity'] = $row->qty;
            }
            $details['buyone_getone'] = $row->options->buyone_getone;
            $details['singleprice'] = $row->price;
            $details['totalprice'] = $row->qty * $row->price;
            DB::table('order_details')->insert($details);
        }

        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Toastr::success('Successfully Done', 'Success');
        return Redirect()->to('/');
    }
}
