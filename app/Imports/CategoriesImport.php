<?php

namespace App\Imports;

use App\Models\Categories;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CategoriesImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Categories::create([
                'name' => $row[0],
            ]);
        }
    }
}
