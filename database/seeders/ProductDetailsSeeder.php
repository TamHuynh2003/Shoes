<?php

namespace Database\Seeders;

use App\Models\ProductDetails;
use Illuminate\Database\Seeder;

class ProductDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 7; $i++) {
            for ($color = 1; $color <= 4; $color++) {
                for ($size = 1; $size <= 4; $size++) {
                    ProductDetails::create([
                        'quantity' => rand(15, 45),
                        'product_id' => $i,
                        'color_id' => $color,
                        'size_id' => $size,
                    ]);
                }
            }
        }
    }
}
