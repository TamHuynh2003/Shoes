<?php

namespace App\Http\Controllers\Client;

use App\Models\Orders;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Models\CustomersCarts;
use App\Http\Controllers\Controller;
use App\Models\OrderDetails;

class PaymentController extends Controller
{
    //
    public function index(Request $req)
    {
        $cart = CustomersCarts::where('users_id', auth('users')->user()->id)->with('product_detail')->get();
        $total = 0;

        $address = $req->address;
        $phone = $req->phone;
        $email = $req->email;

        foreach ($cart as $item) {
            $total += $item->product_detail->product->selling_price * $item->quantity;
        }
        return view('client.payment.index', compact('total', 'address', 'phone', 'email'));
    }
    //  public function createPayment(Request $request)
    // {
    //     $vnp_TmnCode = env('VNP_TMN_CODE');
    //     $vnp_HashSecret = env('VNP_HASH_SECRET');
    //     $vnp_Url = env('VNP_URL');
    //     $vnp_Returnurl = env('VNP_RETURN_URL');
    //     $vnp_TxnRef = date("YmdHis"); // Mã giao dịch. Mỗi giao dịch gửi sang VNPAY phải có mã riêng.
    //     $vnp_OrderInfo = "Thanh toán đơn hàng";
    //     $vnp_OrderType = 'billpayment';
    //     $vnp_Amount = $request->amount * 100;
    //     $vnp_Locale = 'vn';
    //     $vnp_BankCode = '';
    //     $vnp_IpAddr = $request()->ip();

    //     $inputData = array(
    //         "vnp_Version" => "2.1.0",
    //         "vnp_TmnCode" => $vnp_TmnCode,
    //         "vnp_Amount" => $vnp_Amount,
    //         "vnp_Command" => "pay",
    //         "vnp_CreateDate" => date('YmdHis'),
    //         "vnp_CurrCode" => "VND",
    //         "vnp_IpAddr" => $vnp_IpAddr,
    //         "vnp_Locale" => $vnp_Locale,
    //         "vnp_OrderInfo" => $vnp_OrderInfo,
    //         "vnp_OrderType" => $vnp_OrderType,
    //         "vnp_ReturnUrl" => $vnp_Returnurl,
    //         "vnp_TxnRef" => $vnp_TxnRef,
    //     );

    //     if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    //         $inputData['vnp_BankCode'] = $vnp_BankCode;
    //     }

    //     ksort($inputData);
    //     $query = "";
    //     $i = 0;
    //     $hashdata = "";
    //     foreach ($inputData as $key => $value) {
    //         if ($i == 1) {
    //             $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    //         } else {
    //             $hashdata .= urlencode($key) . "=" . urlencode($value);
    //             $i = 1;
    //         }
    //         $query .= urlencode($key) . "=" . urlencode($value) . '&';
    //     }

    //     $vnp_Url = $vnp_Url . "?" . $query;
    //     if (isset($vnp_HashSecret)) {
    //         $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
    //         $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
    //     }

    //     return redirect($vnp_Url);
    // }

    public function createPayment(Request $request)
    {

        $carts = CustomersCarts::where('users_id', auth('users')->user()->id)->with('product_detail')->get();
        $order = new Orders();
        $order->order_date =  date("Y-m-d");
        $order->address = $request->address;
        $order->phone_number = $request->phone;
        $order->payment_methods_id = 1;
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

        $ordersID = $order->id;

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/vnpay/return-payment/" . $ordersID;
        $vnp_TmnCode = "S6RMUB02"; //Mã website tại VNPAY 
        $vnp_HashSecret = "3R1YUK6L2EVEHT36KDR7S5K25OTXI7M9"; //Chuỗi bí mật

        // $vnp_TxnRef = '456';
        $vnp_TxnRef = uniqid();
        $vnp_OrderInfo = 'tessthanhtoan';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params
        $inputData = array(
            "vnp_Version" => "2.1.0", //Phiên bản cũ là 2.0.0, 2.0.1 thay đổi sang 2.1.0
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        // return $vnp_Url;
        return redirect()->away($vnp_Url);
    }

    public function returnPayment(Request $request, $id)
    {

        $vnp_HashSecret = '3R1YUK6L2EVEHT36KDR7S5K25OTXI7M9';
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";


        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // dd($vnp_SecureHash, $secureHash);
        // dd($inputData);

        if ($secureHash == $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {

                // Xử lý logic sau khi thanh toán thành công ở đây

                $payments = Payments::create([
                    'transaction_id' => $inputData['vnp_BankTranNo'],
                    'amount' => $inputData['vnp_Amount'],
                    'order_info' => $inputData['vnp_OrderInfo'],
                    'order_type' => $inputData['vnp_CardType'],
                    'response_code' => $inputData['vnp_ResponseCode'],
                    'bank_code' => $inputData['vnp_BankCode'],
                    'vnp_secure_hash' => $secureHash
                ]);

                $order = Orders::find($id);

                $order->update([
                    'payments_id' => $payments->id,
                    'payment_status' => 1
                ]);

                return redirect()->route('thankyou');
            } else {
                // Thanh toán không thành công
                return response()->json(['code' => $inputData['vnp_ResponseCode'], 'message' => 'Payment failed']);
            }
        } else {
            return response()->json(['code' => '97', 'message' => 'Invalid signature']);
        }
    }
}
