<?php

namespace App\Http\Controllers\Server;

use App\Models\Purchases;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function dashboard()
    {
        return view('server.dashboards.index');
    }
    public function search(Request $request)
    {
        try {
            $dateStart = $request->dateStart;
            $dateEnd = $request->dateEnd;
            //Doanh thu = tiền tổng các chi tiết đơn hàng, 
            $statistics = DB::table('orders')
                ->where('orders.order_date', '>=', $dateStart)
                ->where('orders.order_date', '<=', $dateEnd)
                ->selectRaw(
                    'SUM((SELECT SUM(ord.quantity * ord.selling_price) FROM order_details as ord WHERE ord.orders_id = orders.id AND orders.status_id = 5 GROUP BY ord.orders_id)) as revenue,
                count(orders.id) as count_order,
                count(IF(status_id = 3, orders.id, null)) as count_cancel_order,
                count(IF(status_id = 2, orders.id, null)) as count_approve_order,
                count(IF(status_id = 4, orders.id, null)) as count_delivering_order,
                count(IF(status_id = 5, orders.id, null)) as count_delivered_order',
                )->first();
            $coutPurchaseOrder = count(Purchases::where('purchase_date', '>=', $dateStart)
                ->where('purchase_date', '<=', $dateEnd)
                ->get());
            $statistics->count_purchase_order  =   $coutPurchaseOrder;

            return response()->json([
                'statistics' => $statistics
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error'
            ], 500);
        }
    }
}
