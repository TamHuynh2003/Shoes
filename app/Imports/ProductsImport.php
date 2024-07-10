<?php

namespace App\Imports;

use App\Models\Products;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Products::create([
                'name' => $row[0],
                'descriptions' => $row[1],
                'purchase_price' => $row[2],
                'selling_price' => $row[3],
                'rating' => $row[4],
                'categories_id' => $row[5],
                'providers_id' => $row[6],
            ]);
        }
    }
}
