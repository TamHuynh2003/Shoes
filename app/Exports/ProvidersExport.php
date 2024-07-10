<?php

namespace App\Exports;

use App\Models\Providers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProvidersExport implements FromView
{
    public function view(): View
    {
        return view('server.providers.export', [
            'providers' => Providers::all()
        ]);
    }
}
