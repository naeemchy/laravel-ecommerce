<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\setting\WebsiteSetting;
use App\Models\Site_setting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class WebsiteSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $setting = Site_setting::first();

        return view('Backend.dashboard.site_setting.site_setting', compact('setting'));
    }

    public function updateWebsiteSetting(WebsiteSetting $request)
    {
        $setting = Site_setting::findOrFail(1);
        $setting->update($request->except('logo'));
        
        if ($request->hasFile('logo')) {
            $path = $setting->logo;

            if(File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move('backend/images/uploads', $filename);
            $setting->logo = 'backend/images/uploads/' . $filename;
            $setting->update(array('logo' => $setting->logo));
        }

        Toastr::success('Website Setting Successfully Updated :)', 'Success');
        return redirect()->back();
    }
}
