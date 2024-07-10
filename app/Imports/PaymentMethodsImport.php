<?php

namespace App\Imports;

use App\Models\PaymentMethods;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PaymentMethodsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            PaymentMethods::create([
                'name' => $row[0],
            ]);
        }
    }
}
