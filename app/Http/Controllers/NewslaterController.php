<?php

namespace App\Http\Controllers;

use App\Models\Newslater;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewslaterController extends Controller
{
    public function index()
    {
        $newslaters = Newslater::latest()->get();
        return view('Backend.dashboard.newslater.index', compact('newslaters'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:newslaters',
        ]);

        if (!Auth::check()) {
            Toastr::error('At First Login Your Account:)', 'Error');
            return redirect()->back();
        }

        $newslater = new Newslater();
        $newslater->email = $request->email;
        $newslater->save();
        Toastr::success('Newslater Successfully Saved :)', 'Success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $newslater = Newslater::findOrFail($id);
        $newslater->delete();
        Toastr::success('Newslater Successfully Deleted :)', 'Success');
        return redirect()->back();
    }
}
