<?php

namespace App\Exports;

use App\Models\Categories;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CategoriesExport implements FromView
{
    public function view(): View
    {
        return view('server.categories.export', [
            'categories' => Categories::all()
        ]);
    }
}
