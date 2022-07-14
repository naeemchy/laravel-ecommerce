<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileBioRequest;
use App\Http\Requests\Profile\ProfileCredentialRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('Backend.dashboard.profile.admin_profile');
    }

    public function UpdateBio(ProfileBioRequest $request)
    {
        $image = $request->file('image');
        $user = User::findOrFail(auth()->user()->id);

        if (isset($image)) {
            if (Storage::disk('public')->exists('profile/' . $user->image)) {
                Storage::disk('public')->delete('profile/' . $user->image);
            }

            $currentDate = Carbon::now()->toDateString();
            $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('profile')) {
                Storage::disk('public')->makeDirectory('profile');
            }
            Image::make($image)->resize(500, 500)->save('storage/profile/' . $imageName);
            $user->image = 'storage/profile/' . $imageName;
        } else {
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();
        Toastr::success('Profile Successfully Updated :)', 'Success');
        return redirect()->back();
    }

    public function updateCredential(ProfileCredentialRequest $request)
    {
        $user = User::find(auth()->user()->id);

        $user->email = $request->email;

        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        Toastr::success('Password Successfully Changed', 'Success');
        Auth::logout();
        return redirect()->back();
    }
}
