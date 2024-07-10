<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CustomersCarts;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\PaymentMethods;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = CustomersCarts::where('users_id', auth('users')->user()->id)->with('product_detail')->get();
        $paymentMethods = PaymentMethods::all();

        $total = 0;
        foreach ($carts as $item) {
            $total += $item->product_detail->product->selling_price * $item->quantity;
        }
        return view('client.checkout.index', compact('carts', 'paymentMethods', 'total'));
    }
    public function process(Request $request)
    {
        $paymentMethods = PaymentMethods::find($request->payment_method_id);
        // if($paymentMethods->id == 1)
        // {
        //     return "Chưa làm";
        //     // return redirect()->route('vnpay_payment');
        // }
        if ($paymentMethods->id == 1) {
            return redirect()->route('vnpay_payment');
        }
        $carts = CustomersCarts::where('users_id', auth('users')->user()->id)->with('product_detail')->get();
        $order = new Orders();
        $order->order_date =  date("Y-m-d");
        $order->address = $request->address;
        $order->phone_number = $request->phone;
        $order->payment_methods_id = $request->payment_method_id;
        $order->users_id = auth('users')->user()->id;
        $order->admins_id = null;
        $order->shipping_cost = 5;
        $order->status_id = 1;
        $order->save();

        foreach ($carts as $item) {
            $orderDetail = new OrderDetails();
            $orderDetail->orders_id = $order->id;
            $orderDetail->quantity = $item->quantity;
            $orderDetail->selling_price = $item->product_detail->product->selling_price;
            $orderDetail->product_id = $item->product_detail->product->id;
            $orderDetail->colors_id = $item->product_detail->color_id;
            $orderDetail->sizes_id = $item->product_detail->size_id;
            $orderDetail->save();
            $item->delete();
        }

        return redirect()->route('home');
    }
}
