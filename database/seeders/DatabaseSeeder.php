<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([

            BlogsSeeder::class,
            AboutsSeeder::class,

            SizesSeeder::class,
            ColorsSeeder::class,

            RolesSeeder::class,
            GendersSeeder::class,

            UserStatesSeeder::class,
            OrderStatesSeeder::class,

            TypeDiscountsSeeder::class,
            PaymentMethodsSeeder::class,

            CategoriesSeeder::class,
            DiscountsSeeder::class,

            ProvidersSeeder::class,

            ProductsSeeder::class,
            ProductImagesSeeder::class,
            ProductDetailsSeeder::class,

            AdminsSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
