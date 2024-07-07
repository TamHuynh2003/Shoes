<?php

namespace App\Exports;

use App\Models\PaymentMethods;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentMethodsExport implements FromView
{
    public function view(): View
    {
        return view('server.payment_methods.export', [
            'payments' => PaymentMethods::all()
        ]);
    }
}
