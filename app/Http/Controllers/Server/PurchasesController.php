<?php

namespace App\Http\Controllers\Server;

use App\Models\Sizes;
use App\Models\Colors;
use App\Models\Products;
use App\Models\Providers;
use App\Models\Purchases;
use Illuminate\Http\Request;
use App\Models\ProductDetails;
use App\Models\PurchaseDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $listPurchases = Purchases::where('status_id', 1, 2)->get();
        $listPurchases = Purchases::whereIn('status_id', [1, 2])->get();

        return view('server.purchases.index', compact('listPurchases'));
    }

    public function trash()
    {
        $listPurchases = Purchases::where('status_id', 3)->get();

        return view('server.purchases.trash', compact('listPurchases'));
    }

    public function search(Request $req)
    {
        $keyword = $req->input('data');

        if (empty($keyword)) {
            $listPurchases = Purchases::whereIn('status_id', [1, 2])->get();
        } else {
            $providers = Providers::where('name', 'like', "%$keyword%")
                ->pluck('id')
                ->toArray();

            if (!empty($providers)) {
                $listPurchases = Purchases::whereIn('providers_id', $providers)
                    ->whereIn('status_id', [1, 2])
                    ->get();
            } else {
                $listPurchases = [];
            }
        }

        return view('server.purchases.search', compact('listPurchases'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listProviders = Providers::all();
        $listProducts = Products::all();

        $listColors = Colors::all();
        $listSizes = Sizes::all();

        return view('server.purchases.create', compact('listProviders', 'listProducts', 'listColors', 'listSizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $i = 0;
        $total = 0;

        foreach ($req->totalprice as $totalprice) {
            $total += $totalprice;
        }

        $purchases = new Purchases();

        $purchases->total_price = $total;
        $purchases->purchase_date = $req->purchase_date;

        $purchases->providers_id = $req->providers_id;
        $purchases->admins_id = Auth::user()->id;

        $purchases->save();

        foreach ($req->product_id as $purchase) {

            $purchasesDetail = new PurchaseDetails();

            $purchasesDetail->quantity = $req->quantity[$i];
            $purchasesDetail->purchase_price = $req->purchase_price[$i];

            $purchasesDetail->colors_id = $req->color[$i];
            $purchasesDetail->sizes_id = $req->size[$i];

            $purchasesDetail->purchases_id = $purchases->id;
            $purchasesDetail->products_id = $req->product_id[$i];

            $purchasesDetail->save();
            $i++;
        }

        return redirect()->route('purchases.index')->with('alert', 'Tạo hóa đơn nhập thành công');
    }
    // public function store(Request $req)
    // {
    //     $i = 0;
    //     $total = 0;

    //     foreach ($req->totalprice as $totalprice) {
    //         $total += $totalprice;
    //     }

    //     $purchases = new Purchases();
    //     $purchases->total_price = $total;

    //     $purchases->purchase_date = $req->purchase_date;
    //     $purchases->providers_id = $req->providers_id;

    //     $purchases->admins_id = Auth::user()->id;

    //     $purchases->save();

    //     foreach ($req->products_id as $purchase) {
    //         $purchasesDetail = new PurchaseDetails();

    //         $purchasesDetail->quantity = $req->quantity[$i];
    //         $purchasesDetail->purchase_price = $req->purchase_price[$i];

    //         $purchasesDetail->colors_id = $req->color[$i];
    //         $purchasesDetail->sizes_id = $req->size[$i];

    //         $purchasesDetail->purchases_id = $purchases->id;
    //         $purchasesDetail->products_id = $req->products_id[$i];

    //         $purchasesDetail->save();
    //         $i++;
    //     }

    //     return redirect()->route('purchases.index')->with('alert', 'Tạo hóa đơn nhập thành công');
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $listPurchaseDetails = PurchaseDetails::where('purchases_id', $id)->get();

        return view('server.purchases.details', compact('listPurchaseDetails'));
    }

    // public function verify($id)
    // {
    //     $purchaseDetails = PurchaseDetails::where('purchases_id', $id)->get();

    //     foreach ($purchaseDetails as $detail) {

    //         $productDetails = ProductDetails::where('product_id', $detail->product_id)
    //             ->where('color_id', $detail->color_id)
    //             ->where('size_id', $detail->size_id)
    //             ->get();

    //         if ($productDetails->isEmpty()) {
    //             $productdetail = new ProductDetails();

    //             $productdetail->quantity = $detail->quantity;
    //             $productdetail->product_id = $detail->product_id;

    //             $productdetail->color_id = $detail->color_id;
    //             $productdetail->size_id = $detail->size_id;

    //             $productdetail->save();
    //         } else {
    //             $productDetails[0]->quantity += $detail->quantity;
    //             $productDetails[0]->save();
    //         }
    //     }

    //     $purchases = Purchases::where('id', $id)->get();

    //     $purchases[0]->status_id = 2;
    //     $purchases[0]->save();

    //     return redirect()->route('purchases.index')->with('alert', 'Duyệt hóa đơn nhập thành công');
    // }

    public function verify($id)
    {
        $purchaseDetails = PurchaseDetails::where('purchases_id', $id)->get();

        // dd($purchaseDetails);

        foreach ($purchaseDetails as $detail) {
            // Tìm kiếm chi tiết sản phẩm với product_id, color_id và size_id cụ thể
            $productDetail = ProductDetails::where('product_id', $detail->products_id)
                ->where('color_id', $detail->colors_id)
                ->where('size_id', $detail->sizes_id)
                ->first(); // Sử dụng first() để lấy bản ghi đầu tiên nếu có

            // dd($productDetail, $detail);
            if ($productDetail) {

                // Nếu tìm thấy, chỉ cập nhật quantity
                $productDetail->quantity += $detail->quantity;
            } else {
                // Nếu không tìm thấy, tạo mới
                $productDetail = new ProductDetails();
                $productDetail->product_id = $detail->products_id;
                $productDetail->color_id = $detail->colors_id;
                $productDetail->size_id = $detail->sizes_id;
                $productDetail->quantity = $detail->quantity;
            }

            // Lưu bản ghi vào cơ sở dữ liệu
            $productDetail->save();
        }

        // Cập nhật trạng thái của hóa đơn nhập
        $purchase = Purchases::find($id);
        if ($purchase) {
            $purchase->status_id = 2;
            $purchase->save();
        }

        return redirect()->route('purchases.index')->with('alert', 'Duyệt hóa đơn nhập thành công');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchases $purchases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchases $purchases)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $purchases = Purchases::where('id', $id)->get();

        $purchases[0]->status_id = 3;
        $purchases[0]->save();

        return redirect()->route('purchases.index')->with('alert', 'Xóa hóa đơn nhập thành công');
    }
}
