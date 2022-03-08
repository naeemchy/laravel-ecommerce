<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\setting\WebsiteSetting;
use App\Models\Site_setting;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class WebsiteSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $setting = DB::table('site_settings')->first();

        return view('Backend.dashboard.site_setting.site_setting', compact('setting'));
    }

    public function updateWebsiteSetting(WebsiteSetting $request)
    {
        $logo = $request->file('logo');
        $user = Site_setting::findOrFail(1);

        if (isset($logo)) {
            if (Storage::disk('public')->exists('logo/' . $user->logo)) {
                Storage::disk('public')->delete('logo/' . $user->logo);
            }

            $currentDate = Carbon::now()->toDateString();
            $imageName = $currentDate . '-' . uniqid() . '.' . $logo->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('logo')) {
                Storage::disk('public')->makeDirectory('logo');
            }
            Image::make($logo)->resize(500, 500)->save('storage/logo/' . $imageName);
            $user->logo = 'storage/logo/' . $imageName;
        } else {
            $imageName = $user->logo;
        }

        $user->email_one = $request->email_one;
        $user->email_two = $request->email_two;
        $user->phone_one = $request->phone_one;
        $user->phone_two = $request->phone_two;
        $user->address_one = $request->address_one;
        $user->address_two = $request->address_two;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->logo = $imageName;
        $user->about = $request->about;
        $user->save();
        Toastr::success('Website Setting Successfully Updated :)', 'Success');
        return redirect()->back();
    }
}
