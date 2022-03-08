<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function singelProduct($id)
    {
        $product_details = Product::where('id', $id)->first();

        $color = $product_details->product_color;
        $product_color = explode(',', $color);

        $size = $product_details->product_size;
        $product_size = explode(',', $size);

        return view('frontend.website.products.singel_product_details_view', compact('product_details', 'product_color', 'product_size'));
    }

    public function singelProductBuyoneGetone($id)
    {
        $product_details = Product::where('id', $id)->first();

        $color = $product_details->product_color;
        $product_color = explode(',', $color);

        $size = $product_details->product_size;
        $product_size = explode(',', $size);

        return view('frontend.website.products.singel_product_buyone_getone_details_view', compact('product_details', 'product_color', 'product_size'));
    }
}
