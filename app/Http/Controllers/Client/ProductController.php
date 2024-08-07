<?php

namespace App\Http\Controllers\Client;

use App\Models\Sizes;
use App\Models\Colors;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Models\ProductDetails;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // public function index()
    // {
    //     $listProducts = Products::with('images')->get();
    //     return view('client.products.index', compact('listProducts'));
    // }

    public function index(Request $request)
    {
        if ($request->category_id) {
            $product = Products::where('categories_id', $request->category_id)->with('categories')->get();
        } else {
            $product = Products::with('categories')->get();
        }
        $selected = $request->category_id;
        $categories = Categories::all();
        $colors = Colors::all();
        $sizes = Sizes::all();
        return view('client.products.index', compact('product', 'categories', 'colors', 'sizes', 'selected'));
    }

    public function detail($id)
    {
        $size = Sizes::all();
        $color = Colors::all();
        $product = Products::find($id); // Tìm sản phẩm theo ID
        $products = Products::where('categories_id', $product->categories_id)->with('images')->get(); // Tìm sản phẩm theo ID
        return view('client.product_detail.index', compact('product', 'size', 'color', 'products'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $products = Products::where('name', "LIKE", "%" . $search . "%")->get();
        return view('client.products.search', compact('products', 'search'));
    }
}
