<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(100)->create()->each(function($product) {
            $categories = Category::all()->random(rand(1, 3));
            $product->categories()->saveMany($categories);
            $product->image_url = 'https://picsum.photos/300/200?random=' . $product->id;
            $product->save();
        });
    }
}
