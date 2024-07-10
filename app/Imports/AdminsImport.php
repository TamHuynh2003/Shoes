<?php

namespace App\Imports;

use App\Models\Admins;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AdminsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Admins::create([
                'fullname' => $row[0],
                'email' => $row[1],
                'address' => $row[2],
                'phone_number' => $row[3],
                'username' => $row[4],
                'password' => $row[5],
                'salary' => $row[6],
                'genders_id' => $row[7],
            ]);
        }
    }
}
