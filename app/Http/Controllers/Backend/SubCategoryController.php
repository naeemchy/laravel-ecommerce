<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::latest()->get();
        return view('Backend.dashboard.sub-category.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('Backend.dashboard.sub-category.create', compact('categories'));
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
            'subcategory_name' => 'required',
        ]);

        if ($request->category_id == "--Select Category--") {
            Toastr::error('Please Choice a Category', 'Error');
            return redirect()->back();
        }

        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_id;
        $subCategory->subcategory_name = $request->subcategory_name;
        $subCategory->slug = Str::slug($request->subcategory_name);
        $subCategory->save();
        Toastr::success('SubCategory Successfully Saved :)', 'Success');
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
        $subcategory = SubCategory::find($id);
        return view('Backend.dashboard.sub-category.edit', compact('subcategory', 'categories'));
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
            'subcategory_name' => 'required',
        ]);

        $subCategory = SubCategory::find($id);
        $subCategory->category_id = $request->category_id;
        $subCategory->subcategory_name = $request->subcategory_name;
        $subCategory->slug = Str::slug($request->subcategory_name);
        $subCategory->save();
        Toastr::success('Sub-Category Successfully Updated :)', 'Success');
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
        $sub_category = SubCategory::findOrFail($id);
        $sub_category_product_len = $sub_category->products->count();

        if ($sub_category_product_len > 0) {
            $products = Product::where('sub_category_id', $id)->get();

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

        $sub_category->delete();

        Toastr::success('Sub-Category Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
