<?php

namespace App\Http\Controllers\Server;

use App\Exports\ProductsExport;
use App\Models\Sizes;
use App\Models\Colors;
use App\Models\Products;
use App\Models\Providers;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Models\ProductDetails;
use App\Imports\ProductsImport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductsRequest;

class ProductsController extends Controller
{

    public function index()
    {
        $listProducts = Products::where('is_deleted', 1)->paginate(10);

        $productImage = ProductImages::all();

        return view('server.products.index', compact('listProducts', 'productImage',));
    }

    public function trash()
    {
        $listProducts = Products::all()->where('is_deleted', 0);

        $productImage = ProductImages::all();

        return view('server.products.trash', compact('listProducts', 'productImage',));
    }

    public function search(Request $req)
    {
        $keyword = $req->input('data');
        $productImage = ProductImages::all();


        $listProducts = Products::where('name', 'like', "%$keyword%")->where('is_deleted', 1)->get();

        return view('server.products.search', compact('listProducts', 'productImage'));
    }

    // public function show($id)
    // {
    //     // $products = Products::find($id);
    //     // $productDetails = ProductDetails::find($id);
    //     // $productImages = ProductImages::find($id);
    //     $products = Products::with(['images', 'productDetails'])->find($id);

    //     $listColors = ProductDetails::where('product_id', $id)->distinct()->get('color_id');
    //     $listSizes = ProductDetails::where('product_id', $id)->distinct()->get('size_id');

    //     return view('server.products.details', compact('products', 'listColors', 'listSizes'));
    // }

    public function show($id)
    {
        $products = Products::with(['images', 'productDetails'])->find($id);

        $listColors = ProductDetails::where('product_id', $id)->distinct()->get('color_id');
        $listSizes = ProductDetails::where('product_id', $id)->distinct()->get('size_id');

        return view('server.products.details', compact('products', 'listColors', 'listSizes'));
    }

    public function quantity(Request $request, $id)
    {
        $color = $request->input('color_id');
        $size = $request->input('size_id');

        $quantity = ProductDetails::where('color_id', $color)
            ->where('size_id', $size)
            ->where('product_id', $id)
            ->value('quantity');

        if ($quantity == null) {
            $quantity = 0;
            return response()->json(['quantity' => $quantity]);
        }

        return response()->json(['quantity' => $quantity]);
    }

    public function create()
    {
        $listColors = Colors::all();
        $listSizes = Sizes::all();

        $listCategories = Categories::all();
        $listProviders = Providers::all();

        return view('server.products.create', compact('listColors', 'listSizes', 'listCategories', 'listProviders'));
    }

    public function store(StoreProductsRequest $req)
    {
        $products = new Products();

        $products->name = $req->name;
        $products->descriptions = $req->descriptions;

        $products->purchase_price = $req->purchase_price;
        $products->selling_price = $req->selling_price;

        $products->categories_id = $req->categories_id;
        $products->providers_id = $req->providers_id;

        $products->is_deleted = 1;
        $products->save();

        if ($req->hasFile('images')) {

            $images = $req->file('images');

            foreach ($images as $image) {
                $file = new ProductImages();

                $imageName = $image->getClientOriginalName();
                $path = $image->storeAs('images/products', $imageName);

                $file->url = $path;
                $file->products_id = $products->id;

                $file->is_deleted = 1;
                $file->save();
            }
        }

        $productDetail = new ProductDetails();

        $productDetail->product_id = $products->id;
        $productDetail->quantity = 30;

        $productDetail->color_id = $req->colors_id;
        $productDetail->size_id = $req->sizes_id;

        $productDetail->is_deleted = 1;
        $productDetail->save();

        return redirect()->route('products.index')->with('alert', 'Thêm sản phẩm thành công');
    }

    // public function edit($id)
    // {
    //     $products = Products::find($id);

    //     $listColors = Colors::all();
    //     $listSizes = Sizes::all();

    //     $listCategories = Categories::all();
    //     $listProviders = Providers::all();

    //     $images = ProductImages::all();

    //     $is_deleted = [
    //         (object) ['id' => 0, 'name' => 'Hết hàng'],
    //         (object) ['id' => 1, 'name' => 'Còn hàng']
    //     ];

    //     return view('server.products.update', compact('products', 'images', 'listColors', 'listSizes', 'listCategories', 'listProviders', 'is_deleted'));
    // }

    // public function update(Request $req, $id)
    // {
    //     $products = Products::find($id);

    //     $products->name = $req->name;
    //     $products->descriptions = $req->descriptions;

    //     $products->purchase_price = $req->purchase_price;
    //     $products->selling_price = $req->selling_price;

    //     $products->categories_id = $req->categories_id;
    //     $products->providers_id = $req->providers_id;

    //     $products->is_deleted = $req->is_deleted;
    //     $products->save();

    //     if ($req->hasFile('images')) {

    //         $images = $req->file('images');

    //         foreach ($images as $image) {
    //             $file = new ProductImages();

    //             $imageName = $image->getClientOriginalName();
    //             $path = $image->storeAs('images/products', $imageName);

    //             $file->url = $path;
    //             $file->products_id = $products->id;

    //             $file->is_deleted = 1;
    //             $file->save();
    //         }
    //     }

    //     $productDetail = ProductDetails::where('products_id', $products->id)->first();

    //     if (!empty($productDetail)) {
    //         $productDetail->quantity = 30;
    //         $productDetail->save();
    //     } else {
    //         $productDetail = new ProductDetails();
    //         $productDetail->products_id = $products->id;
    //         $productDetail->quantity = 30;
    //         $productDetail->save();
    //     }
    //     return redirect()->route('products.index')->with('alert', 'Cập nhật sản phẩm thành công');
    // }

    public function edit($id)
    {
        $products = Products::find($id);

        $listColors = Colors::all();
        $listSizes = Sizes::all();

        $listCategories = Categories::all();
        $listProviders = Providers::all();

        $images = ProductImages::where('products_id', $id)->get();

        $is_deleted = [
            (object) ['id' => 0, 'name' => 'Hết hàng'],
            (object) ['id' => 1, 'name' => 'Còn hàng']
        ];

        return view('server.products.update', compact('products', 'images', 'listColors', 'listSizes', 'listCategories', 'listProviders', 'is_deleted'));
    }

    // public function update(Request $req, $id)
    // {
    //     $products = Products::find($id);

    //     $products->name = $req->name;
    //     $products->descriptions = $req->descriptions;

    //     $products->purchase_price = $req->purchase_price;
    //     $products->selling_price = $req->selling_price;

    //     $products->categories_id = $req->categories_id;
    //     $products->providers_id = $req->providers_id;

    //     $products->is_deleted = $req->is_deleted;
    //     $products->save();

    //     if ($req->has('delete_images')) {

    //         foreach ($req->delete_images as $imageId) {

    //             $image = ProductImages::find($imageId);

    //             if ($image) {

    //                 Storage::delete($image->url);
    //                 $image->delete();
    //             }
    //         }
    //     }

    //     if ($req->hasFile('images')) {

    //         $images = $req->file('images');

    //         foreach ($images as $image) {
    //             $file = new ProductImages();

    //             $imageName = $image->getClientOriginalName();
    //             $path = $image->storeAs('images/products', $imageName);

    //             $file->url = $path;
    //             $file->products_id = $products->id;

    //             $file->is_deleted = 1;
    //             $file->save();
    //         }
    //     }

    //     $productDetail = ProductDetails::where('products_id', $products->id)->first();

    //     if (!empty($productDetail)) {
    //         $productDetail->quantity = 30;
    //         $productDetail->save();
    //     } else {
    //         $productDetail = new ProductDetails();
    //         $productDetail->products_id = $products->id;
    //         $productDetail->quantity = 30;
    //         $productDetail->save();
    //     }

    //     return redirect()->route('products.index')->with('alert', 'Cập nhật sản phẩm thành công');
    // }

    public function update(Request $req, $id)
    {
        $products = Products::find($id);

        $products->name = $req->name;
        $products->descriptions = $req->descriptions;
        $products->purchase_price = $req->purchase_price;
        $products->selling_price = $req->selling_price;
        $products->categories_id = $req->categories_id;
        $products->providers_id = $req->providers_id;
        $products->is_deleted = $req->is_deleted;
        $products->save();

        if ($req->has('delete_images')) {
            foreach ($req->delete_images as $imageId) {
                $image = ProductImages::find($imageId);
                if ($image) {
                    Storage::delete($image->url);
                    $image->delete();
                }
            }
        }

        if ($req->hasFile('images')) {
            $images = $req->file('images');
            foreach ($images as $image) {
                $file = new ProductImages();
                $imageName = $image->getClientOriginalName();
                $path = $image->storeAs('images/products', $imageName);
                $file->url = $path;
                $file->products_id = $products->id;
                $file->is_deleted = 1;
                $file->save();
            }
        }

        // $productDetail = ProductDetails::where('products_id', $products->id)->first();

        // if (!empty($productDetail)) {
        //     $productDetail->quantity = 30;

        //     $productDetail->colors_id = $req->colors_id;
        //     $productDetail->sizes_id = $req->sizes_id;

        //     $productDetail->save();
        // } else {
        //     $productDetail = new ProductDetails();

        //     $productDetail->products_id = $products->id;
        //     $productDetail->quantity = 30;

        //     $productDetail->colors_id = $req->colors_id;
        //     $productDetail->sizes_id = $req->sizes_id;

        //     $productDetail->save();
        // }

        return redirect()->route('products.index')->with('alert', 'Cập nhật sản phẩm thành công');
    }


    public function destroy($id)
    {
        $products = Products::find($id);

        if (!$products) {
            return redirect()->route('products.index')->with('alert', "Sản phẩm không tồn tại!!");
        }

        if ($products->is_deleted == 0) {
            return redirect()->route('products.index')->with('alert', 'Sản phẩm đã được xóa trước đó rồi!!');
        }

        $products->is_deleted = 0;
        $products->save();

        return redirect()->route('products.index')->with('alert', 'Xóa sản phẩm thành công');
    }

    public function viewPDF()
    {
        $products = Products::all();

        $pdf = Pdf::loadView('server.products.pdf',  compact('products'));

        return $pdf->stream('Sản Phẩm.pdf');
    }

    public function importExcel(Request $re)
    {

        Excel::import(new ProductsImport, $re->file('import_file'));

        return redirect()->route('products.index')->with('alert', "Nhập dữ liệu của sản phẩm thành công");
    }

    public function exportExcel(Request $re)
    {
        if ($re->type == 'xlsx') {

            $files = 'xlsx';
            $format = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($re->type == 'xls') {

            $files = 'xls';
            $format = \Maatwebsite\Excel\Excel::XLS;
        } elseif ($re->type == 'csv') {

            $files = 'csv';
            $format = \Maatwebsite\Excel\Excel::CSV;
        }

        $filename = "Sản Phẩm" . "." . $files;

        return Excel::download(new ProductsExport, $filename, $format);
    }
}
