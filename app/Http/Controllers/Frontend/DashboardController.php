<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $mid_slider_products = Product::where('status', 1)->where('mid_slider', 1)->take(3)->inRandomOrder()->get();

        $trend_products = Product::where('status', 1)->where('trend', 1)->latest()->get();

        $hot_products = Product::where('status', 1)->where('hot_deal', 1)->latest()->get();

        $categories = Category::latest()->get();

        $product_qty_check = Product::where('status', 1)->latest()->get();

        $products = Product::where('status', 1)->limit(8)->latest()->get();
        $products_count = $products->count();

        $buyone_getone_products = Product::where('status', 1)->where('buyone_getone', 1)->latest()->get();

        return view('frontend.dashboard', compact('mid_slider_products', 'categories', 'products', 'trend_products', 'hot_products', 'products_count', 'buyone_getone_products'));
    }

    public function productFilterByCategory($id)
    {
        $products = Product::where('category_id', $id)->where('status', 1)->latest()->get();
        $product = Product::where('category_id', $id)->where('status', 1)->latest()->first();

        return view('frontend.website.categoryproduct.index', compact('products', 'product'));
    }

    public function productFilterBySubCategory($id)
    {
        $products = Product::where('sub_category_id', $id)->where('status', 1)->latest()->get();
        $product = Product::where('sub_category_id', $id)->where('status', 1)->latest()->first();

        return view('frontend.website.subcategoryproduct.index', compact('products', 'product'));
    }

    public function allProductList(Request $request)
    {
        $category_id = $request->input('cat_id');
        $subcategory_id = $request->input('sub_category_id');

        $products = Product::when($category_id, function ($query, $category_id) {
            return $query->where('category_id', $category_id);
        })->when($subcategory_id, function ($query, $subcategory_id) {
            return $query->where('sub_category_id', $subcategory_id);
        })->where('status', 1)->latest()->get();

        $categories = Category::latest()->get();

        $subcategories = SubCategory::latest()->get();

        return view('frontend.website.products.index', compact('products', 'categories', 'subcategories'));
    }
}
