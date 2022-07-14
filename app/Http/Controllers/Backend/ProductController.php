<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('Backend.dashboard.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $brands = Brand::latest()->get();

        return view('Backend.dashboard.product.create', compact('categories', 'subcategories', 'brands'));
    }

    public function getSubCategory($category_id)
    {
        $cat = DB::table('sub_categories')->where("category_id", $category_id)->get();
        return json_encode($cat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|unique:products',
            'product_code' => 'required',
            'product_quantity' => 'required',
            'product_details' => 'required',
            'selling_price' => 'required',
            'image_one' => 'required',
        ]);

        $product = new Product();
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if (isset($image_one)) {
            $currentDate = Carbon::now()->toDateString();
            $imageNameOne = $currentDate . '-' . uniqid() . '.' . $image_one->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('product')) {
                Storage::disk('public')->makeDirectory('product');
            }

            Image::make($image_one)->resize(400, 400)->save('storage/product/' . $imageNameOne);
            $product->image_one = 'storage/product/' . $imageNameOne;

        } else {
            $imageNameOne = "default.png";
        }

        if (isset($image_two)) {
            $currentDate = Carbon::now()->toDateString();
            $imageNameTwo = $currentDate . '-' . uniqid() . '.' . $image_two->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('product')) {
                Storage::disk('public')->makeDirectory('product');
            }

            Image::make($image_two)->resize(400, 400)->save('storage/product/' . $imageNameTwo);
            $product->image_two = 'storage/product/' . $imageNameTwo;

        } else {
            $imageNameTwo = "default.png";
        }

        if (isset($image_three)) {
            $currentDate = Carbon::now()->toDateString();
            $imageNameThree = $currentDate . '-' . uniqid() . '.' . $image_three->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('product')) {
                Storage::disk('public')->makeDirectory('product');
            }

            Image::make($image_three)->resize(400, 400)->save('storage/product/' . $imageNameThree);
            $product->image_three = 'storage/product/' . $imageNameThree;

        } else {
            $imageNameThree = "default.png";
        }

        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_quantity = $request->product_quantity;
        $product->product_details = $request->product_details;
        $product->product_color = $request->product_color;
        $product->product_size = $request->product_size;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->video_link = $request->video_link;
        $product->main_slider = $request->main_slider;
        $product->hot_deal = $request->hot_deal;
        $product->best_rated = $request->best_rated;
        $product->mid_slider = $request->mid_slider;
        $product->hot_new = $request->hot_new;
        $product->trend = $request->trend;
        $product->buyone_getone = $request->buyone_getone;
        $product->today = $request->today;
        $product->status = $request->status;
        $product->image_one = $imageNameOne;
        $product->image_two = $imageNameTwo;
        $product->image_three = $imageNameThree;

        $product->save();
        Toastr::success('Product Successfully Saved :)', 'Success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $brands = Brand::latest()->get();
        $product = Product::findOrFail($id);

        return view('Backend.dashboard.product.edit', compact('product', 'categories', 'subcategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name' => 'required|unique:products,product_name,' . $id,
            'product_code' => 'required',
            'product_quantity' => 'required',
            'product_details' => 'required',
            'selling_price' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        if (isset($image_one)) {
            if (Storage::disk('public')->exists('product/' . $product->image_one)) {
                Storage::disk('public')->delete('product/' . $product->image_one);
            }

            $currentDate = Carbon::now()->toDateString();
            $imageNameOne = $currentDate . '-' . uniqid() . '.' . $image_one->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('product')) {
                Storage::disk('public')->makeDirectory('product');
            }

            Image::make($image_one)->resize(400, 400)->save('storage/product/' . $imageNameOne);
            $product->image_one = 'storage/product/' . $imageNameOne;

        } else {
            $imageNameOne = $product->image_one;
        }

        if (isset($image_two)) {
            if (Storage::disk('public')->exists('product/' . $product->image_two)) {
                Storage::disk('public')->delete('product/' . $product->image_two);
            }

            $currentDate = Carbon::now()->toDateString();
            $imageNameTwo = $currentDate . '-' . uniqid() . '.' . $image_two->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('product')) {
                Storage::disk('public')->makeDirectory('product');
            }

            Image::make($image_two)->resize(400, 400)->save('storage/product/' . $imageNameTwo);
            $product->image_two = 'storage/product/' . $imageNameTwo;

        } else {
            $imageNameTwo = $product->image_two;
        }

        if (isset($image_three)) {
            if (Storage::disk('public')->exists('product/' . $product->image_three)) {
                Storage::disk('public')->delete('product/' . $product->image_three);
            }

            $currentDate = Carbon::now()->toDateString();
            $imageNameThree = $currentDate . '-' . uniqid() . '.' . $image_three->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('product')) {
                Storage::disk('public')->makeDirectory('product');
            }

            Image::make($image_three)->resize(400, 400)->save('storage/product/' . $imageNameThree);
            $product->image_three = 'storage/product/' . $imageNameThree;

        } else {
            $imageNameThree = $product->image_three;
        }

        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_quantity = $request->product_quantity;
        $product->product_details = $request->product_details;
        $product->product_color = $request->product_color;
        $product->product_size = $request->product_size;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->video_link = $request->video_link;
        $product->main_slider = $request->main_slider;
        $product->hot_deal = $request->hot_deal;
        $product->best_rated = $request->best_rated;
        $product->mid_slider = $request->mid_slider;
        $product->hot_new = $request->hot_new;
        $product->trend = $request->trend;
        $product->buyone_getone = $request->buyone_getone;
        $product->today = $request->today;
        $product->status = $request->status;
        $product->image_one = $imageNameOne;
        $product->image_two = $imageNameTwo;
        $product->image_three = $imageNameThree;

        $product->save();
        Toastr::success('Product Successfully Updated :)', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (Storage::disk('public')->exists('product/' . $product->image_one)) {
            Storage::disk('public')->delete('product/' . $product->image_one);
        }

        if (Storage::disk('public')->exists('product/' . $product->image_two)) {
            Storage::disk('public')->delete('product/' . $product->image_two);
        }

        if (Storage::disk('public')->exists('product/' . $product->image_three)) {
            Storage::disk('public')->delete('product/' . $product->image_three);
        }

        $product->delete();
        Toastr::success('Product Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
