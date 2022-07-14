<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('Backend.dashboard.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.dashboard.brand.create');

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
            'brand_name' => 'required|unique:brands',
        ]);

        $brand = new Brand();
        $image = $request->file('brand_logo');
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('brand')) {
                Storage::disk('public')->makeDirectory('brand');
            }

            Image::make($image)->resize(350, 350)->save('storage/brand/' . $imageName);
            $brand->brand_logo = 'storage/brand/' . $imageName;

        } else {
            $imageName = "default.png";
        }

        $brand->brand_name = $request->brand_name;
        $brand->slug = Str::slug($request->brand_name);
        $brand->brand_logo = $imageName;
        $brand->save();
        Toastr::success('Brand Successfully Saved :)', 'Success');
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
        $brand = Brand::findOrFail($id);
        return view('Backend.dashboard.brand.edit', compact('brand'));
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
            'brand_name' => 'required|unique:brands,brand_name,' . $id,
        ]);

        $brand = Brand::findOrFail($id);
        $image = $request->file('brand_logo');

        if (isset($image)) {
            if (Storage::disk('public')->exists('brand/' . $brand->brand_logo)) {
                Storage::disk('public')->delete('brand/' . $brand->brand_logo);
            }

            $currentDate = Carbon::now()->toDateString();
            $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('brand')) {
                Storage::disk('public')->makeDirectory('brand');
            }

            Image::make($image)->resize(350, 350)->save('storage/brand/' . $imageName);
            $brand->brand_logo = 'storage/brand/' . $imageName;
        } else {
            $imageName = $brand->brand_logo;
        }

        $brand->brand_name = $request->brand_name;
        $brand->slug = Str::slug($request->brand_name);
        $brand->brand_logo = $imageName;
        $brand->save();
        Toastr::success('Brand Successfully Updated :)', 'Success');
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
        $brand = Brand::findOrFail($id);

        $sub_category_product_len = $brand->products->count();

        if ($sub_category_product_len > 0) {
            $products = Product::where('brand_id', $id)->get();

            foreach ($products as $product) {
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
            }
        }

        if (Storage::disk('public')->exists('brand/' . $brand->brand_logo)) {
            Storage::disk('public')->delete('brand/' . $brand->brand_logo);
        }

        $brand->delete();
        Toastr::success('Brand Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
