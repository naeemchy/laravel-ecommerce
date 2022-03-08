<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Auth;

class WishlistsController extends Controller
{
    public function AddToWishlist($id)
    {
        $userid = Auth::id();

        $wishlist = new Wishlist();

        $check = Wishlist::where('user_id', $userid)->where('product_id', $id)->first();

        if (Auth::check()) {
            if ($check) {
                return \Response::json(['error' => 'Product exist in your wishlists']);
            } else {
                $wishlist->user_id = $userid;
                $wishlist->product_id = $id;
                $wishlist->save();

                return \Response::json(['success' => 'Product Added on wishlist']);
            }

        } else {
            return \Response::json(['error' => 'At first login your account']);
        }

    }
}
