<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductDetails;
use App\Models\WishLists;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = WishLists::where('users_id', auth('users')->user()->id)->with('product')->get();

        return view('client.wishlist.index', compact('wishlist'));
    }

    public function add(Request $request, $id)
    {
        $products = Products::find($id);
        // $product_detail = ProductDetails::where('product_id',$products->id)->where('quantity',">=",$request->quantity)->first();
        $wishlist = new WishLists();
        $wishlist->users_id = auth('users')->user()->id;
        $wishlist->selling_price = $products->selling_price;
        $wishlist->product_id = $products->id;
        $wishlist->save();
        return redirect()->route('home')->with('alert', 'Thêm vào danh sách yêu thích thành công');
    }
    public function delete(Request $request)
    {
        $cart = WishLists::find($request->id);
        $cart->delete();
        return redirect()->route('wishlist');
    }
}
