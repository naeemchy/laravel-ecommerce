<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('Backend.dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.dashboard.category.create');
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
            'category_name' => 'required|unique:categories',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name);
        $category->save();
        Toastr::success('Category Successfully Saved :)', 'Success');
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
        $category = Category::findOrFail($id);
        return view('Backend.dashboard.category.edit', compact('category'));
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
            'category_name' => 'required|unique:categories,category_name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name);
        $category->save();
        Toastr::success('Category Successfully Updated :)', 'Success');
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
        $category = Category::findOrFail($id);
        $category_product_len = $category->products->count();

        if ($category_product_len > 0) {
            $products = Product::where('category_id', $id)->get();

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

        $category->subcategories()->delete();
        $category->delete();

        Toastr::success('Category Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
