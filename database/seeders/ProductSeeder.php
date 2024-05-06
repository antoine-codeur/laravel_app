<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 9.99,
            'stock' => 100,
        ]);
    }
}