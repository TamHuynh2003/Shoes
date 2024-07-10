<?php

namespace App\Exports;

use App\Models\Orders;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
{
    public function view(): View
    {
        return view('server.orders.export', [
            'orders' => Orders::all()
        ]);
    }
}
