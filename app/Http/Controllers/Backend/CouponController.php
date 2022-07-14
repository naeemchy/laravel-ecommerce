<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('Backend.dashboard.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.dashboard.coupon.create');
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
            'coupon' => 'required|unique:coupons',
            'discount' => 'required|unique:coupons',
        ]);

        $coupon = new Coupon();
        $coupon->coupon = $request->coupon;
        $coupon->slug = Str::slug($request->coupon);
        $coupon->discount = $request->discount;
        $coupon->save();
        Toastr::success('Coupon Successfully Saved :)', 'Success');
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
        $coupon = Coupon::findOrFail($id);
        return view('Backend.dashboard.coupon.edit', compact('coupon'));
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
            'coupon' => 'required|unique:coupons,coupon,' . $id,
            'discount' => 'required|unique:coupons,discount,' . $id,
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->coupon = $request->coupon;
        $coupon->slug = Str::slug($request->coupon);
        $coupon->discount = $request->discount;
        $coupon->save();
        Toastr::success('Coupon Successfully Updated :)', 'Success');
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
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        Toastr::success('Coupon Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
