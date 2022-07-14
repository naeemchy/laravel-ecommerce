<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class OrderController extends Controller
{
    public function orderPending()
    {
        $orders = Order::where('status', 0)->get();

        return view('Backend.dashboard.order.pending', compact('orders'));
    }

    public function viewOrder($id)
    {
        $order = DB::table('orders')->join('users', 'orders.user_id', 'users.id')->select('users.name', 'users.phone', 'orders.*')->where('orders.id', $id)->first();

        $shipping = DB::table('shippings')->where('order_id', $id)->first();

        $details = DB::table('order_details')->join('products', 'order_details.product_id', 'products.id')->select('products.product_code', 'products.image_one', 'order_details.*')->where('order_details.order_id', $id)->get();

        return view('Backend.dashboard.order.view', compact('order', 'shipping', 'details'));
    }

    public function orderCancel($id)
    {
        DB::table('orders')->where('id', $id)->update(['status' => 4]);

        Toastr::success('Order Cancel :)', 'Success');

        return Redirect()->route('admin.order.pending');
    }

    public function orderAccept($id)
    {
        DB::table('orders')->where('id', $id)->update(['status' => 1]);

        Toastr::success('Order Acceptd :)', 'Success');

        return Redirect()->route('admin.order.pending');
    }

    public function acceptPaymentOrder()
    {
        $orders = Order::where('status', 1)->get();

        return view('Backend.dashboard.order.accept', compact('orders'));
    }

    public function orderDeleveryProgress($id)
    {
        DB::table('orders')->where('id', $id)->update(['status' => 2]);

        Toastr::success('Order Send To delevery :)', 'Success');

        return Redirect()->route('admin.payment.accept');
    }

    public function orderProgress()
    {
        $orders = Order::where('status', 2)->get();

        return view('Backend.dashboard.order.progress', compact('orders'));
    }

    public function deleveryDone($id)
    {
        $product = DB::table('order_details')->where('order_id', $id)->get();

        foreach ($product as $row) {
            DB::table('products')
                ->where('id', $row->product_id)
                ->update(['product_quantity' => DB::raw('product_quantity -' . $row->quantity)]);
        }

        DB::table('orders')->where('id', $id)->update(['status' => 3]);

        Toastr::success('Deleverd Done :)', 'Success');

        return Redirect()->route('admin.order.progress');
    }

    public function SuccessPaymentOrder()
    {
        $orders = Order::where('status', 3)->get();

        return view('Backend.dashboard.order.success', compact('orders'));
    }

    public function CancelPaymentOrder()
    {
        $orders = Order::where('status', 4)->get();

        return view('Backend.dashboard.order.cancel', compact('orders'));
    }

}
