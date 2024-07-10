<?php

namespace App\Imports;

use App\Models\Providers;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProvidersImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Providers::create([
                'name' => $row[0],
                'address' => $row[1],
                'email' => $row[2],
                'phone_number' => $row[3],
                'descriptions' => $row[4],
            ]);
        }
    }
}
