<?php

namespace App\Imports;

use App\Models\Discounts;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class DiscountsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Discounts::create([
                'name' => $row[0],
                'amount' => $row[1],
                'type_discounts_id' => $row[2],
                'start_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['3']),
                'end_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['4']),
            ]);
        }
    }
}
