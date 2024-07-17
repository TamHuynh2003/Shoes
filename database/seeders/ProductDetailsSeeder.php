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
        for ($i = 1; $i <= 40; $i++) {
            for ($color = 1; $color <= 5; $color++) {
                for ($size = 1; $size <= 4; $size++) {
                    ProductDetails::create([
                        'quantity' => rand(5, 25),
                        'product_id' => $i,
                        'color_id' => $color,
                        'size_id' => $size,
                    ]);
                }
            }
        }
    }
}
