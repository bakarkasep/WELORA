<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Women
            ['name' => 'White Collar Dress', 'price' => 350000, 'image' => 'whitecollar.jpeg', 'category' => 'women'],
            ['name' => 'Mid Night Mini Dress', 'price' => 350000, 'image' => 'midnightdress.jpeg', 'category' => 'women'],
            ['name' => 'Burgundy Knit Dress', 'price' => 290000, 'image' => 'bergundy.jpeg', 'category' => 'women'],
            
            // Men
            ['name' => 'Casual Blazzer', 'price' => 400000, 'image' => 'casualblazzer.jpeg', 'category' => 'men'],
            ['name' => 'Taupen Button Shirt', 'price' => 250000, 'image' => 'taupen.jpeg', 'category' => 'men'],
            ['name' => 'Collared Sweater', 'price' => 300000, 'image' => 'collared.jpeg', 'category' => 'men'],
            
            // Unisex
            ['name' => 'Unisex Shorts', 'price' => 280000, 'image' => 'unisex 1.png', 'category' => 'unisex'],
            ['name' => 'Unisex Shirt', 'price' => 200000, 'image' => 'unisex 2.png', 'category' => 'unisex'],
            ['name' => 'Unisex Hoodie', 'price' => 250000, 'image' => 'unisex 3.png', 'category' => 'unisex'],
        ];

        DB::table('products')->insert($products);
    }
}