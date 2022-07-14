<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Cart;
use Illuminate\Http\Request;
use Response;
use Session;

class CartController extends Controller
{
    // product add by ajax from home page
    public function Addcart($id)
    {
        $product = Product::where('id', $id)->first();

        $carts = Cart::content();

        foreach ($carts as $cart) {
            if ($cart->name == $product->product_name) {
                return \Response::json(['error' => 'Product exit in your Cart']);
            }
        }

        $data = array();
        if ($product->discount_price == null) {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->selling_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';
            Cart::add($data);
            return \Response::json(['success' => 'Product Add to your Cart']);
        } else {
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = 1;
            $data['price'] = $product->discount_price;
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size'] = '';

            Cart::add($data);
            return \Response::json(['success' => 'Add to your cart with discount']);
        }
    }

    // product add from single product view page
    public function addCartFromProductDetails(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();

        $carts = Cart::content();

        foreach ($carts as $cart) {
            if ($cart->name == $product->product_name) {
                return back()->with('status', 'Product exit in your Cart');
            }
        }

        $data = array();

        if ($product->product_quantity >= $request->qty) {
            if ($product->discount_price == null) {
                $data['id'] = $id;
                $data['name'] = $product->product_name;
                $data['qty'] = $request->qty;
                $data['price'] = $product->selling_price;
                $data['weight'] = 1;
                $data['options']['image'] = $product->image_one;
                $data['options']['color'] = $request->product_color;
                $data['options']['size'] = $request->product_size;
                Cart::add($data);
                return back()->with('status', 'Add to your cart Successfully');
            } else {
                $data['id'] = $id;
                $data['name'] = $product->product_name;
                $data['qty'] = $request->qty;
                $data['price'] = $product->discount_price;
                $data['weight'] = 1;
                $data['options']['image'] = $product->image_one;
                $data['options']['color'] = $request->product_color;
                $data['options']['size'] = $request->product_size;
                Cart::add($data);
                return back()->with('status', 'Add to your cart Successfully');

            }
        } else {
            return back()->with('status', 'Oppos Product Stock ' . $product->product_quantity . ' now');
        }
    }

    // product add from buyone getone single product view page
    public function addCartFromBuyoneGetoneProductDetails(Request $request, $id)
    {
        $product = Product::where('id', $id)->first();
        $quentity = $request->qty;
        $getone_qty = $quentity + $quentity;

        $carts = Cart::content();

        foreach ($carts as $cart) {
            if ($cart->name == $product->product_name) {
                return back()->with('status', 'Product exit in your Cart');
            }
        }

        $data = array();
        if ($product->product_quantity >= $quentity) {
            if ($product->discount_price == null) {
                $price = $product->selling_price;

                $data['id'] = $id;
                $data['name'] = $product->product_name;
                $data['qty'] = $request->qty;
                $data['options']['new_qty'] = $getone_qty;
                $data['price'] = $product->selling_price;
                $data['weight'] = 1;
                $data['options']['image'] = $product->image_one;
                $data['options']['buyone_getone'] = 'buyone-getone';
                $data['options']['color'] = $request->product_color;
                $data['options']['size'] = $request->product_size;
                Cart::add($data);

                return back()->with('status', 'Add to your cart Successfully');
            } else {
                $price = $product->discount_price;

                $data['id'] = $id;
                $data['name'] = $product->product_name;
                $data['qty'] = $request->qty;
                $data['options']['new_qty'] = $getone_qty;
                $data['price'] = $product->discount_price;
                $data['weight'] = 1;
                $data['options']['image'] = $product->image_one;
                $data['options']['buyone_getone'] = 'buyone-getone';
                $data['options']['color'] = $request->product_color;
                $data['options']['size'] = $request->product_size;
                Cart::add($data);

                return back()->with('status', 'Add to your cart Successfully');
            }
        } else {
            return back()->with('status', 'Oppos Product Stock ' . $product->product_quantity . ' now');
        }
    }

    // view all cart product
    public function check()
    {
        $content = Cart::content();

        return response()->json($content);
    }

    // view all cart product from cart page
    public function showCart()
    {
        $cart = Cart::content();

        return view('frontend.website.cart.cart', compact('cart'));
    }

    // update cart from cart page or singel_cart_product_Update page
    public function UpdateCart(Request $request)
    {
        $rowId = $request->productid;

        $product = Product::where('id', $request->product_id)->first();

        $qty = $request->qty;

        if ($product->product_quantity >= $qty) {
            Cart::update($rowId, $qty);
            if ($product) {
                Cart::update($rowId, ['options' => ['color' => $request->product_color, 'size' => $request->product_size, 'image' => $product->image_one]]);
            }
            Toastr::success('Cart Updated', 'Success');
            return redirect()->route('show.cart');
        } else {
            Toastr::error('Oppos Product Stock ' . $product->product_quantity . ' now', 'Error');
            return redirect()->route('show.cart');
        }
    }

    //update getone butone cart product from cart page or singel_cart_product_Update page
    public function UpdateGetoneCart(Request $request)
    {
        $rowId = $request->productid;

        $product = Product::where('id', $request->product_id)->first();

        $quentity = $request->qty;
        $getone_qty = $quentity + $quentity;

        if ($product->product_quantity >= $quentity) {
            Cart::update($rowId, ['qty' => $quentity]);
            Cart::update($rowId, ['options' => ['new_qty' => $getone_qty, 'buyone_getone' => 'buyone-getone', 'color' => $request->product_color, 'size' => $request->product_size, 'image' => $product->image_one]]);
            Toastr::success('Cart Updated From Getone Discount', 'Success');
            return redirect()->route('show.cart');
        } else {
            Toastr::error('Oppos Product Stock ' . $product->product_quantity . ' now', 'Error');
            return redirect()->route('show.cart');
        }
    }

    //singel Cart Product view for Update singely from singel_cart_product_Update page
    public function singelCartProductUpdate($rowId)
    {
        $cart_product = Cart::content()->where('rowId', $rowId)->first();
        $product_id = $cart_product->id;
        $product_details = Product::where('id', $product_id)->first();

        $color = $product_details->product_color;
        $product_color = explode(',', $color);

        $size = $product_details->product_size;
        $product_size = explode(',', $size);

        return view('frontend.website.cart.singel_cart_product_Update', compact('cart_product', 'product_color', 'product_size'));
    }

    // revome siggel product by id from cart
    public function removeCart($rowId)
    {
        Cart::remove($rowId);

        Toastr::success('Cart Product Remove', 'Success');
        return redirect()->back();
    }

    // remove all product from cart
    public function cancelCartItem()
    {
        Cart::destroy();
        session::forget('coupon');
        Toastr::success('All Cart Product Removed', 'Success');
        return redirect()->back();
    }

    // apply coupoun by users
    public function Coupon(Request $request)
    {
        $cart_total = Cart::Subtotal();
        $total = (float) str_replace(',', '', $cart_total);

        if ($total < 999) {
            Toastr::error('Please Buy More Than 1000Tk For apply Coupon', 'Error');
            return redirect()->back();
        }

        $coupon = $request->coupon;
        $check = Coupon::where('coupon', $coupon)->first();
        $cart_total = Cart::Subtotal();
        $total = (float) str_replace(',', '', $cart_total);

        if ($check) {
            session::put('coupon', [
                'name' => $check->coupon,
                'discount' => $check->discount,
                'balance' => $total - $check->discount,
            ]);

            Toastr::success('Successfully Coupon Applied', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Invalid Coupon', 'Error');
            return redirect()->back();
        }
    }

    // remove coupoun by users
    public function CouponRemove()
    {
        session::forget('coupon');
        Toastr::success('Successfully Coupon Removed', 'Success');
        return redirect()->back();
    }

    public function Checkout()
    {
        if (Auth::check()) {
            $cart = Cart::content();
            return view('frontend.website.cart.checkout', compact('cart'));
        } else {
            Toastr::error('At first login your account', 'Error');
            return redirect()->route('login');
        }
    }
}
