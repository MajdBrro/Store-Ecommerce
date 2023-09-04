<?php

namespace Database\Seeders;
use App\Models\Category;
// use Illuminate\Database\Seeder;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Product::class, 20)->create();
    }
}