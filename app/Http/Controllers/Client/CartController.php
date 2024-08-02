<?php

namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductDetails;
use App\Models\CustomersCarts;

class CartController extends Controller
{
    public function index()
    {
        $cart = CustomersCarts::where('users_id', auth('users')->user()->id)->with('product_detail')->get();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->product_detail->product->selling_price * $item->quantity;
        }
        return view('client.cart.index', compact('cart', 'total'));
    }
    public function add(Request $request, $id)
    {
        if ($request->size == null) {
            return redirect()->route('product_detail', ['id' => $id])->with('alert', 'Không được bỏ trống kích thước');
        }
        if ($request->color == null) {
            return redirect()->route('product_detail', ['id' => $id])->with('alert', 'Không được bỏ trống màu sắc');
        }
        $cart = CustomersCarts::where('users_id', auth('users')->user()->id)->get();
        foreach ($cart as $item) {
            $products = Products::find($id);
            $product_detail = ProductDetails::where('product_id', $products->id)
                ->where('color_id', $request->color)
                ->where('size_id', $request->size)
                ->where('quantity', ">=", $request->quantity)
                ->first();
            if ($product_detail == null) {
                return redirect()->route('product_detail', ['id' => $id])->with('alert', 'Sản phẩm hết hàng');
            }
            if ($item->product_detail_id == $product_detail->id) {
                $item->quantity += $request->quantity;
                $item->save();
                return redirect()->route('cart')->with('alert', 'Cập nhật số lượng sản phẩm thành công');
            }
        }
        $products = Products::find($id);
        $product_detail = ProductDetails::where('product_id', $products->id)
            ->where('color_id', $request->color)
            ->where('size_id', $request->size)
            ->where('quantity', ">=", $request->quantity)
            ->first();
        $cart = new CustomersCarts();
        $cart->quantity = $request->quantity;
        $cart->users_id = auth('users')->user()->id;
        $cart->total_price = $request->quantity * $products->selling_price;
        $cart->product_detail_id = $product_detail->id;
        $cart->save();

        return redirect()->route('product_detail', ['id' => $id])->with('alert', 'Thêm sản phẩm thành công');
    }
    public function update(Request $request, Products $product)
    {
    }
    public function delete(Request $request)
    {
        $cart = CustomersCarts::find($request->id);
        $cart->delete();
        return redirect()->route('cart')->with('alert', 'Xoá sản phẩm thành công');
    }
    public function tangsoluong(Request $request)
    {
        $cart = CustomersCarts::find($request->tang);
        $cart->quantity += 1;
        $cart->save();
        return redirect()->route('cart')->with('alert', 'Tăng số lượng thành công');
    }
    public function giamsoluong(Request $request)
    {
        $cart = CustomersCarts::find($request->giam);
        if ($cart->quantity != 1) {
            $cart->quantity -= 1;
            $cart->save();
            return redirect()->route('cart')->with('alert', 'Giảm số lượng thành công');
        }
        return redirect()->route('cart')->with('alert', 'Không thể giảm số lượng');
    }
}
