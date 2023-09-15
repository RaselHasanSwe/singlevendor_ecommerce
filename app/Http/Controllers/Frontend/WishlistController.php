<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $data['wishlist'] = [];
        if(Auth::guard('web')->check())
            $data['wishlist'] = Wishlist::where('user_id', Auth::guard('web')->user()->id)
                ->with('products.colors', 'products.sizes')
                ->latest()
                ->get();
        return view('frontend.wishlist.index', $data);
    }

    public function store(Request $request)
    {
        if(!Auth::guard('web')->check())
            return response()->json(['success' => false, 'message' => 'Please Login For Wishlist Product']);

        $wishlist = Wishlist::where('user_id', Auth::guard('web')->user()->id)
            ->where('product_id', $request->product_id)
            ->first();
        $newWishlist = $wishlist ? $wishlist : new Wishlist();
        $newWishlist->user_id = Auth::guard('web')->user()->id;
        $newWishlist->product_id = $request->product_id;
        $newWishlist->save();
        return response()->json(['success' => true, 'message' => 'Product successfully added to wishlist']);

    }

    public function remove(Request $request)
    {
        if(!Auth::guard('web')->check())
            return response()->json(['success' => false, 'message' => 'Please Login For Wishlist Product']);

        Wishlist::where('id', $request->id)->delete();
        return response()->json(['success' => true, 'message' => 'Product Removed From Wishlist']);
    }
}
