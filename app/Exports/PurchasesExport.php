<?php

namespace App\Exports;

use App\Models\Purchases;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PurchasesExport implements FromView
{
    public function view(): View
    {
        return view('server.purchases.export', [
            'purchases' => Purchases::all()
        ]);
    }
}
