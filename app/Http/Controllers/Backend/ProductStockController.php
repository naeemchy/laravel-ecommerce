<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProductStockController extends Controller
{
    public function stock()
    {
        $products = Product::latest()->get();
        return view('Backend.dashboard.product.stock', compact('products'));
    }

    public function stockUpdate($id)
    {
        $product = Product::findOrFail($id);

        return view('Backend.dashboard.product.update_stock', compact('product'));
    }

    public function productStockUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'product_quantity' => 'required',
        ]);

        $product = Product::findOrFail($id);

        $product->product_quantity = $request->product_quantity;
        $product->save();

        Toastr::success('Product Stock Successfully Updated :)', 'Success');
        return redirect()->back();
    }
}
