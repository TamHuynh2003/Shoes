<?php

namespace Database\Factories;

use App\Models\Providers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Providers>
 */

class ProvidersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Providers::class;

    protected static $providerIndex = 0;

    public function definition(): array
    {
        $providers = [
            ['name' => 'Nhà Cung Cấp Giày Adidas', 'descriptions' => 'Cung cấp các mặt hàng về giày Adidas'],
            ['name' => 'Nhà Cung Cấp Giày Nike', 'descriptions' => 'Cung cấp các mặt hàng về giày Nike'],
            ['name' => 'Nhà Cung Cấp Giày Vans', 'descriptions' => 'Cung cấp các mặt hàng về giày Vans'],
            ['name' => 'Nhà Cung Cấp Giày Puma', 'descriptions' => 'Cung cấp các mặt hàng về giày Puma'],
            ['name' => 'Nhà Cung Cấp Giày Converse', 'descriptions' => 'Cung cấp các mặt hàng về giày Converse']
        ];

        if (self::$providerIndex >= count($providers)) {
            self::$providerIndex = 0;
        }

        $currentProvider = $providers[self::$providerIndex];
        self::$providerIndex++;

        return [
            'name' => $currentProvider['name'],
            'email' => $this->faker->unique()->userName . '@company.com',
            'phone_number' => '09' . $this->faker->numerify('########'),
            'address' => $this->faker->address,
            'descriptions' => $currentProvider['descriptions'],
        ];
    }

    /**
     * Reset the unique generator for Faker.
     */
    public function resetFaker()
    {
        $this->faker->unique(true);
    }
}
